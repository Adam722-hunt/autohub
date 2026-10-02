<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Models\AdminSetting;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Report;
use App\Notifications\NewReportSubmittedNotification;
use App\Notifications\VehicleReportNotification;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(StoreReportRequest $request, Vehicle $vehicle)
    {
        if ($request->user()->id === $vehicle->user_id) {
            return response()->json([
                'message' => 'You cannot report your own vehicle'
            ], 403);
        }
        if ($vehicle->status !== 'active') {
            return response()->json([
                'message' => 'Cannot report an inactive vehicle'
            ], 404);
        }
        if ($request->user()->reports()->where('vehicle_id', $vehicle->id)->exists()) {
            return response()->json([
                'message' => 'You have already reported this vehicle'
            ], 409);
        }

        $reportData = $request->validated();

        if ($request->hasFile('evidence')) {
            $reportData['evidence'] = $request->file('evidence')->store('reports/' . $vehicle->id, 'public');
        }

        $report = $request->user()->reports()->create([
            'vehicle_id' => $vehicle->id,
            'reason' => $reportData['reason'],
            'reason_description' => $reportData['reason_description'] ?? null,
            'evidence' => $reportData['evidence'] ?? null,
        ]);
        if (AdminSetting::where('key', 'notify_new_report_submitted')->value('value') == 'true') {
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewReportSubmittedNotification($vehicle, $report));
            }
        }
        if ($vehicle->user->notificationSettings->reports) {
            $vehicle->user->notify(new VehicleReportNotification($report));
        }

        return response()->json([
            'message' => 'Report submitted successfully',
        ], 201);
    }

    public function index(Request $request)
    {

        $reports_count = $request->user()->reports()->count();

        $pending_reports = $request->user()->reports()->where('status', 'pending')->count();

        $reviewed_reports = $request->user()->reports()->where('status', 'reviewed')->count();

        $resolved_reports = $request->user()->reports()->where('status', 'resolved')->count();

        $rejected_reports = $request->user()->reports()->where('status', 'rejected')->count();

        $reports = $request->user()->reports()->when(
            $request->filled('filter'),
            function ($query) use ($request) {
                switch ($request->filter) {
                    case 'pending':

                        $query->where('status', 'pending');

                        break;

                    case 'reviewed':

                        $query->where('status', 'reviewed');

                        break;

                    case 'rejected':

                        $query->where('status', 'rejected');

                        break;

                    case 'resolved':

                        $query->where('status', 'resolved');

                        break;
                }
            }
        )->when(
            $request->filled('search'),
            function ($query) use ($request) {
                $query->whereHas(
                    'vehicle',
                    function ($query) use ($request) {
                        $query->where('title', 'ILIKE', '%' . $request->search . '%');
                    }
                );
            }
        )
            ->with([
                'vehicle' => function ($query) {
                    $query->select('id', 'title', 'price')
                        ->with('primaryImage');
                }
            ])->latest()->get();


        $reports = $reports->map(function ($report) {
            $report->reference = 'RPT-' . str_pad($report->id, 4, '0', STR_PAD_LEFT);
            return $report;
        });

        return response()->json([
            'summary' => [
                'total' => $reports_count,
                'pending' => $pending_reports,
                'rejected' => $rejected_reports,
                'resolved' => $resolved_reports,
                'reviewed' => $reviewed_reports
            ],
            'reports' => $reports,
        ]);
    }
}
