<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\SavedSearch;
use Illuminate\Http\Request;
use App\Http\Resources\VehicleResource;
use App\Notifications\ReportRejectNotification;
use App\Notifications\ReportResolveNotification;
use App\Notifications\ReportReviewedNotification;
use App\Notifications\VehicleApproveNotification;
use App\Notifications\VehicleRejectNotification;
use App\Notifications\SavedSearchNotification;

class AdminController extends Controller
{
    public function overview()
    {
        $activeUsers = User::where('status', 'active')->where('role', 'user')->count();

        $activeListings = Vehicle::where('status', 'active')->count();

        $pendingListings = Vehicle::where('status', 'pending')->count();

        $pendingReports = Report::where('status', 'pending')->count();

        $blockedUsers = User::where('status', 'blocked')->where('role', 'user')->select([
            'id',
            'username',
            'email',
            'phone',
            'created_at'
        ])->take(10)->get();

        return response()->json([
            'activeUsers' => $activeUsers,
            'activeListings' => $activeListings,
            'pendingListings' => $pendingListings,
            'pendingReports' => $pendingReports,
            'blockedUsers' => $blockedUsers
        ]);
    }

    public function users(request $request)
    {
        $query = User::where('role', 'user')->select([
            'id',
            'username',
            'email',
            'phone',
            'created_at',
            'status'
        ])->withCount(['vehicles as total_listings']);

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('username', 'ILIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'ILIKE', '%' . $request->search . '%')
                    ->orWhere('phone', 'ILIKE', '%' . $request->search . '%');
            });
        });

        $query->when($request->filled('status'), function ($query) use ($request) {
            $query->where('status', $request->status);
        });
        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return response()->json([
            'users' => $users
        ]);
    }

    public function blockUser(User $user)
    {
        if ($user->role !== 'user') {
            return response()->json([
                'message' => 'You can not block admin account'
            ], 403);
        }
        if ($user->status !== 'active') {
            return response()->json([
                'message' => 'User already blocked'
            ], 400);
        }
        $user->update([
            'status' => 'blocked',
            'blocked_at' => now(),
        ]);
        $user->tokens()->delete();
        return response()->json([
            'message' => 'user blocked successfully',
        ]);
    }

    public function unblockUser(User $user)
    {

        if ($user->role !== 'user') {
            return response()->json([
                'message' => 'You can not unblock admin account'
            ], 403);
        }

        if ($user->status !== 'blocked') {
            return response()->json([
                'message' => 'Account already active'
            ], 400);
        }

        $user->update([
            'status' => 'active',
            'blocked_at' => null,
        ]);

        return response()->json([
            'message' => 'Account unblocked successfully'
        ], 200);
    }

    public function deleteUser(User $user)
    {

        if ($user->role !== 'user') {
            return response()->json([
                'message' => 'You cannot delete admin acount'
            ], 403);
        }

        $user->tokens()->delete();
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }

    public function listings(Request $request)
    {
        $query = Vehicle::select([
            'id',
            'user_id',
            'title',
            'price',
            'updated_at',
            'status'
        ])->with(['primaryImage:id,vehicle_id,image', 'user:id,username'])->withCount('vehicleViews');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'ILIKE', '%' . $request->search . '%');
                $query->orWherehas('user', function ($query) use ($request) {
                    $query->where('username', 'ILIKE', '%' . $request->search .  '%');
                });
            });
        });

        $query->when($request->filled('status'), function ($query) use ($request) {
            $query->where('status', $request->status);
        });

        $listings = $query->orderBy('updated_at', 'desc')->paginate(15);

        return response()->json([
            'listings' => $listings,
        ], 200);
    }

    public function visitListing(Vehicle $vehicle)
    {
        $vehicle->load([
            'user',
            'brand',
            'model',
            'vehicleType',
            'vehicleGen',
            'fuelType',
            'transmissionType',
            'driveTrainType',
            'bodyType',
            'engineLayout',
            'engineCyl',
            'aspirationType',
            'condition',
            'color',
            'currency',
            'country',
            'city',
            'images',
            'features',
            'vehicleViews'
        ]);
        return response()->json([
            'vehicle' => new VehicleResource($vehicle)
        ]);
    }

    public function approveListing(Vehicle $vehicle)
    {
        if ($vehicle->status === 'active') {
            return response()->json([
                'message' => 'Vehicle already active'
            ], 409);
        }
        $vehicle->update([
            'status' => 'active'
        ]);
        if ($vehicle->user->notificationSettings->listings) {
            $vehicle->user->notify(new VehicleApproveNotification($vehicle));
        }

        $saved_searches = SavedSearch::all();

        foreach ($saved_searches as $saved_search) {
            if ($saved_search->matchesVehicle($vehicle) && $saved_search->user->notificationSettings->matching_listings) {
                $saved_search->user->notify(new SavedSearchNotification($vehicle, $saved_search));
            }
        }

        return response()->json([
            'message' => 'Vehicle approved successfully'
        ], 200);
    }

    public function rejectListing(Vehicle $vehicle)
    {
        if ($vehicle->status === 'rejected') {
            return response()->json([
                'message' => 'Vehicle already rejected'
            ], 409);
        }
        $vehicle->update([
            'status' => 'rejected'
        ]);
        if ($vehicle->user->notificationSettings->listings) {
            $vehicle->user->notify(new VehicleRejectNotification($vehicle));
        }

        return response()->json([
            'message' => 'Vehicle rejected successfully'
        ], 200);
    }

    public function deleteListing(Vehicle $vehicle)
    {
        $vehicle->delete();
        return response()->json([
            'message' => 'Vehicle deleted successfully'
        ]);
    }

    public function reports(Request $request)
    {

        $query = Report::select([
            'id',
            'user_id',
            'vehicle_id',
            'reason',
            'reason_description',
            'evidence',
            'status',
            'updated_at',
        ])->with(['user:id,username', 'vehicle:id,title', 'vehicle.primaryImage:id,vehicle_id,image']);

        $query->when($request->filled('filter'), function ($query) use ($request) {
            $query->where('status', $request->filter);
        });

        $reports = $query->orderBy('updated_at', 'desc')->paginate(15);
        $reports = $reports->map(function ($report) {
            $report->reference = 'RPT-' . str_pad($report->id, 4, '0', STR_PAD_LEFT);
            return $report;
        });

        return response()->json([
            'reports' => $reports,
        ], 200);
    }

    public function reviewReport(Report $report)
    {
        if ($report->status === 'resolved') {
            return response()->json([
                'message' => 'Report has already been resolved'
            ], 409);
        }

        if ($report->status === 'reviewed') {
            return response()->json([
                'message' => 'Report already reviewed'
            ], 409);
        }

        $report->update([
            'status' => 'reviewed'
        ]);
        if ($report->user->notificationSettings->reports) {

            $report->user->notify(new ReportReviewedNotification($report));
        }

        return response()->json([
            'message' => 'Report marked as reviewed successfully'
        ], 200);
    }

    public function resolveReport(Report $report)
    {
        if ($report->status === 'resolved') {
            return response()->json([
                'message' => 'Report has already been resolved'
            ], 409);
        }


        $report->update([
            'status' => 'resolved'
        ]);
        if ($report->user->notificationSettings->reports) {

            $report->user->notify(new ReportResolveNotification($report));
        }


        return response()->json([
            'message' => 'Report marked as resolved successfully'
        ], 200);
    }

    public function rejectReport(Report $report)
    {
        if ($report->status === 'resolved') {
            return response()->json([
                'message' => 'Report has already been resolved'
            ], 409);
        }

        if ($report->status === 'rejected') {
            return response()->json([
                'message' => 'Report already rejected'
            ], 409);
        }

        $report->update([
            'status' => 'rejected'
        ]);
        if ($report->user->notificationSettings->reports) {

            $report->user->notify(new ReportRejectNotification($report));
        }

        return response()->json([
            'message' => 'Report marked as rejected successfully'
        ], 200);
    }

    public function verifyUser(User $user)
    {
        if ($user->verified === true) {
            return response()->json([
                'message' => 'User already verified'
            ], 409);
        }
        $user->update([
            'verified' => true,
        ]);
        return response()->json([
            'message' => 'User set as verified successfully'
        ], 200);
    }

    public function unverifyUser(User $user)
    {
        if ($user->verified === false) {
            return response()->json([
                'message' => 'User already unverified'
            ], 409);
        }
        $user->update([
            'verified' => false,
        ]);
        return response()->json([
            'message' => 'User set as unverified successfully'
        ], 200);
    }
}
