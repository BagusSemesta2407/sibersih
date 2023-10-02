<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\ActivityDetail;
use App\Models\ImageActivity;
use App\Models\ImageActivityDetail;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Kegiatan';
        $activity = Activity::with('village')
        ->orderByRaw("FIELD(status, 'on progress', 'finish') ASC")
        ->get();

        return view('pages.activity.index', [
            'title' => $title,
            'activity' => $activity
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Kegiatan';
        $activityCategory = ActivityCategory::all();
        $village = Village::all();

        return view('pages.activity.form', [
            'title' => $title,
            'activityCategory' => $activityCategory,
            'village' => $village,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityRequest $request)
    {
        // dd($request->all());
        $auth = Auth::user()->getRoleNames()->first();

        if ($auth == 'operator') {
            $status = 'on progress';
        } else {
            $status = 'waiting';
        }

        $activity = Activity::create([
            'activity_category_id' => $request->activity_category_id,
            'date' => $request->date,
            'village_id' => $request->village_id,
            'address_details' => $request->address_details,
            'name' => $request->name,
            'describe_point_location' => $request->describe_point_location,
            'status' => $status
        ]);

        if ($request->image) {
            foreach ($request->image as $data) {
                $filename = ImageActivity::saveImage($data);
                ImageActivity::create([
                    'activity_id' => $activity->id,
                    'image' => $filename
                ]);
            }
        }

        return redirect()->route('operator.activities.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Activity::where('id', $activity->id)->first();
        $title='Kegiatan';
        $activity=Activity::find($id);
        $imageActivity=ImageActivity::where('activity_id', $activity->id)->get();

        $activityDetail=ActivityDetail::where('activity_id', $activity->id)->first();
        $imageActivityDetail=ImageActivityDetail::where('activity_detail_id', $activityDetail->id)->get();

        return view('pages.activity.show', [
            'activity' => $activity,
            'title' => $title,
            'imageActivity' => $imageActivity,
            'activityDetail' => $activityDetail,
            'imageActivityDetail' => $imageActivityDetail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Kegiatan';

        $activity = Activity::find($id);
        $imageActivity = $activity->imageActivity->pluck('image_url', 'id');
        $activityCategory = ActivityCategory::all();
        $village = Village::all();

        return view('pages.activity.form', [
            'title' => $title,
            'activity' => $activity,
            'activityCategory' => $activityCategory,
            'village' => $village,
            'imageActivity' => $imageActivity
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $data = [
            'activity_category_id' => $request->activity_category_id,
            'date' => $request->date,
            'village_id' => $request->village_id,
            'address_details' => $request->address_details,
            'describe_point_location' => $request->describe_point_location,
            'name' => $request->name,
        ];

        $activity->update($data);

        if ($request->old) {
            ImageActivity::deleteImageArray($activity->id, $request->old);

            ImageActivity::where('activity_id', $activity->id)
                ->whereNotIn('id', $request->old)->delete();
        }
        if ($request->image) {
            // Simpan gambar-gambar baru
            foreach ($request->image as $data) {
                $filename = ImageActivity::saveImage($data);
                ImageActivity::create([
                    'activity_id' => $activity->id,
                    'image' => $filename
                ]);
            }
        }

        return redirect()->route('operator.activities.index')->with('success', 'Data Berhasil Diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);

        $imageActivity = [];
        ImageActivity::deleteImageArray($activity->id, $imageActivity);

        $activity->delete();

        ImageActivity::where('activity_id', $activity->id)->delete();

        return response()->json(['success', 'Data Berhasil Dihapus']);
    }
}
