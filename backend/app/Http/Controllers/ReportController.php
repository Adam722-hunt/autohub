<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Models\Report;
use App\Models\Vehicle;
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
            $reportData['evidence'] = $request->file('evidence')->
                store('reports/' . $vehicle->id, 'public');
        }

        $report = $request->user()->reports()->create([
            'vehicle_id' => $vehicle->id,
            'reason' => $reportData['reason'],
            'reason_description' => $reportData['reason_description'] ?? null,
            'evidence' => $reportData['evidence'] ?? null,
        ]);

        return response()->json([
            'message' => 'Report submitted successfully',
            'report' => $report,
        ], 201);
    }

    public function index(Request $request)
    {
        $reports = $request->user()->reports()->with(['vehicle'])->latest()->get();

        return response()->json([
            'reports' => $reports
        ]);
    }

    public function show(Request $request, Report $report)
    {
        if ($report->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }
        $report->load('vehicle');

        return response()->json([
            'userReport' => $report
        ]);
    }

}