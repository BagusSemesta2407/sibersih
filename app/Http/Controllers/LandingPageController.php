<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityDetail;
use App\Models\ImageActivity;
use App\Models\ImageActivityDetail;
use App\Models\ImageSubangActivity;
use App\Models\SubangActivity;
use App\Models\Village;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function home()
    {
        $village = Village::with('activity')->get();

        # code...
        $countVillages = DB::table('villages')
            ->select(
                'villages.id',
                'villages.name',
                DB::raw('COUNT(activities.id) as activity_count')
            )
            ->leftJoin('activities', function ($join) {
                $join->on('villages.id', '=', 'activities.village_id')
                    ->where('activities.status', '=', 'finish');
            })
            ->groupBy('villages.id', 'villages.name') // tambahkan 'villages.name' ke dalam GROUP BY
            ->get();


        $rankCountVillages = $countVillages->sortByDesc('activity_count');

        $activity = Activity::with(['imageActivity', 'activityDetail'])
            ->where('status', 'finish')->get();
        $scheduleActivity=Activity::where('status', 'on progress')->get();

        $imageAcitvityDetail = ImageActivityDetail::all();

        $activityDetail = ActivityDetail::with('activity', 'imageActivityDetail')->latest()->take(1)->get();

        $imageSubangActivity=ImageSubangActivity::get();
        $subangActivity=SubangActivity::latest()->take(1)->get();
        return view('landingPage.index', [
            'village' => $village,
            'activity' => $activity,
            'imageAcitvityDetail' => $imageAcitvityDetail,
            'activityDetail' => $activityDetail,
            'rankCountVillages' => $rankCountVillages,
            'scheduleActivity' => $scheduleActivity,
            'imageSubangActivity' => $imageSubangActivity,
            'subangActivity' => $subangActivity
        ]);
    }

    public function scheduleActivityDetail($id)
    {
        $scheduleActivity=Activity::find($id);
        $imageScheduleActivity=ImageActivity::where('activity_id', $scheduleActivity->id)->get();

        return view('landingPage.scheduleActivityDetail', [
            'scheduleActivity' => $scheduleActivity,
            'imageScheduleActivity' => $imageScheduleActivity
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

    public function indexActivity(Request $request)
    {
        $filter = (object) [
            'village_id' => $request->village_id
        ];

        $activityDetail = ActivityDetail::with('activity', 'imageActivityDetail')
            ->filter($filter)
            ->latest()->paginate(5);
        
        $village=Village::whereHas('activity.activityDetail')->get();

        return view('landingPage.activity.index', [
            'activityDetail' => $activityDetail,
            'village' => $village,
        ]);
    }

    public function indexAxticityDetail($id)
    {
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e){
            abort(404);
        }
        
        $activityDetail = ActivityDetail::find($id);
        $imageActivityDetail = ImageActivityDetail::where('activity_detail_id', $activityDetail->id)->get();

        $activity = Activity::whereHas('activityDetail', function ($q) use ($activityDetail) {
            $q->where('activity_id', $activityDetail->activity_id);
        })->first();

        $imageActivity = ImageActivity::where('activity_id', $activity->id)->get();

        return view('landingPage.activity.detail', [
            'activityDetail' => $activityDetail,
            'imageActivityDetail' => $imageActivityDetail,
            'activity' => $activity,
            'imageActivity' => $imageActivity
        ]);
    }

    public function subangActivityIndex()
    {
        $subangActivity=SubangActivity::with('imageSubangActivity')->latest()->paginate(5);

        return view('landingPage.subangActivity.index', [
            'subangActivity' => $subangActivity
        ]);
    }

    public function subangActivityDetail($id)
    {
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e){
            abort(404);
        }
        
        $subangActivityDetail=SubangActivity::find($id);

        return view('landingPage.subangActivity.detail', [
            'subangActivityDetail'=>$subangActivityDetail
        ]);
    }
}
