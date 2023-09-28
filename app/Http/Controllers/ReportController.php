<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityDetail;
use App\Models\ImageActivity;
use App\Models\ImageActivityDetail;
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

        $imageLaporanArray = [];

        foreach ($laporan as  $value) {
            $imageLaporan = ImageActivity::with('activity')
                ->where('activity_id', $value->id)->get();
            $imageLaporanArray[$value->id] = $imageLaporan;
        }

        $activityDetailArray = [];

        foreach ($laporan as $activityDetails) {
            $activityDetail=ActivityDetail::where('activity_id', $activityDetails->id)->first();
            $activityDetailArray[$activityDetails->id]=$activityDetail;
        }

        $imageActivityDetailArray=[];
        foreach ($activityDetailArray as $activityId => $activityDetail) {
            $imageActivityDetails = ImageActivityDetail::with('activityDetail')
                ->where('activity_detail_id', $activityDetail->id)
                ->get();
            $imageActivityDetailArray[$activityId] = $imageActivityDetails;
        }

        $pdf = PDF::loadView(
            'pages.report.pdf',
            [
                'laporan' => $laporan,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
                'imageLaporanArray' => $imageLaporanArray,
                'activityDetailArray' => $activityDetailArray,
                'imageActivityDetailArray' => $imageActivityDetailArray
            ]
        )->setPaper('A4', 'potrait');

        return $pdf->stream();
    }
}
