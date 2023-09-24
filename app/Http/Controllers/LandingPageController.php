<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityDetail;
use App\Models\ImageActivityDetail;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function home()
    {
        $village = Village::with('activity')->get();

        # code...
        $countActivity = Activity::where('status', 'finish')
            ->groupBy('village_id')
            ->orderBy('village_id', "desc")
            ->count();

        $activity = Activity::with(['imageActivity', 'activityDetail'])
            ->where('status', 'finish')->get();

        $imageAcitvityDetail = ImageActivityDetail::all();

        $activityDetail = ActivityDetail::with('activity', 'imageActivityDetail')->get();

        return view('landingPage.index', [
            'village' => $village,
            'activity' => $activity,
            'imageAcitvityDetail' => $imageAcitvityDetail,
            'activityDetail' => $activityDetail,
            'countActivity' => $countActivity
        ]);
    }

    public function getActivity($id)
    {
        $village = Village::find($id);

        if (!$village) {
            // Tambahkan penanganan jika desa tidak ditemukan
            return null;
        }

        // Cari aktivitas terbaru yang memiliki status 'finish' di desa yang dipilih
        $activity = Activity::where('status', 'finish')
            ->where('village_id', $village->id)
            ->latest()
            ->first();

        return $activity;
    }
}
