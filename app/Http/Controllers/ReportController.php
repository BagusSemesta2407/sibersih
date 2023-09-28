<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ImageActivity;
use App\Models\Village;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Report';

        $filter = (object)[
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'village_id' => $request->village_id
        ];
        $activity = Activity::filter($filter)
            ->where('status', 'finish')
            ->latest()
            ->get();

        $village = Village::whereHas('activity')->get();

        return view('pages.report.index', [
            'title' => $title,
            'activity' => $activity,
            'village' => $village
        ]);
    }

    public function exportPdf(Request $request)
    {
        $filter = (object)[
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'village_id' => $request->village_id
        ];
        $laporan = Activity::filter($filter)
            ->where('status', 'finish')
            ->latest()
            ->get();

        $pdf = PDF::loadView(
            'pages.report.pdf',
            [
                'laporan' => $laporan,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
            ]
        )->setPaper('A4', 'potrait');

        return $pdf->stream();
    }
}
