<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityDetail;
use App\Models\Employee;
use App\Models\ImageActivity;
use App\Models\ImageActivityDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title='Kegiatan';

        $auth=Auth::user();
        $employee=Employee::where('user_id', $auth->id)->first();

        $activity=Activity::where('status', 'on progress')
        ->where('village_id', $employee->village_id)
        ->get();

        return view('pages.activityDetail.index', [
            'activity' =>$activity,
            'title' => $title
        ]);
    }

    public function getActivity($id)
    {
        $title='Kegiatan';

        $activity=Activity::find($id);
        $imageActivity=ImageActivity::where('activity_id', $activity->id)->get();

        return view('pages.activityDetail.form', [
            'title' => $title,
            'activity' => $activity,
            'imageActivity' => $imageActivity
        ]);
    }

    public function postActivityDetail(Request $request, $id)
    {
        // $activity=Activity::where('id', $id)->first();
        $activityDetail=ActivityDetail::create([
            'activity_id' => $id,
            'description' => $request->description
        ]);

        $image=$request->image;
        $video=$request->video;

        if ($image) {
            foreach ($image as $dataImage) {
                $saveImage=ImageActivityDetail::saveFile($dataImage);
                ImageActivityDetail::create([
                    'activity_detail_id' => $activityDetail->id,
                    'file' => $saveImage
                ]);
            }
        }
        if ($video) {
            foreach ($video as $dataVideo) {
                $saveVideo = ImageActivityDetail::saveFile($dataVideo);
                ImageActivityDetail::create([
                    'activity_detail_id' => $activityDetail->id,
                    'file' => $saveVideo
                ]);
            }
        }

        Activity::where('id', $id)->update([
            'status' => 'finish'
        ]);
        
        return redirect()->route('pengguna.index-list-activity')->with('success', 'Data Berhasil Diupload');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivityDetail $activityDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivityDetail $activityDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivityDetail $activityDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivityDetail $activityDetail)
    {
        //
    }
}
