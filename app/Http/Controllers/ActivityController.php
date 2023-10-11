<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\ActivityDetail;
use App\Models\Employee;
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
        $auth = Auth::user();
        $role = $auth->getRoleNames()[0];

        if ($role == 'operator') {
            $activityWaitingStatus = Activity::where('status', 'waiting')->get();
            $activityOnProgressStatus = Activity::where('status', 'on progress')->get();
            $activityDisagreeStatus = Activity::where('status', 'disagree')->get();
            $activityiFinishStatus = Activity::where('status', 'finish')->first();
            $activityDetail=ActivityDetail::where('activity_id', $activityiFinishStatus->id)->get();

        } elseif ($role == 'user') {
            $employee = Employee::where('user_id', $auth->id)->first();
            $villageId = $employee->village_id;

            $activityWaitingStatus = Activity::where('status', 'waiting')->where('village_id', $villageId)->get();
            $activityOnProgressStatus = Activity::where('status', 'on progress')->where('village_id', $villageId)->get();
            $activityDisagreeStatus = Activity::where('status', 'disagree')->where('village_id', $villageId)->get();
            $activityiFinishStatus = Activity::where('status', 'finish')->where('village_id', $villageId)->first();
            $activityDetail=ActivityDetail::where('activity_id', $activityiFinishStatus->id)->get();
        }

        $countActivityWaitingStatus = $activityWaitingStatus->count();
        $countActivityOnProgressStatus = $activityOnProgressStatus->count();
        $countActivityDisagreeStatus = $activityDisagreeStatus->count();
        $countActivityiFinishStatus = $activityiFinishStatus->count();

        return view('pages.activity.index', [
            'title' => $title,
            'activityWaitingStatus' => $activityWaitingStatus,
            'activityOnProgressStatus' => $activityOnProgressStatus,
            'activityiFinishStatus' => $activityiFinishStatus,
            'countActivityiFinishStatus' => $countActivityiFinishStatus,
            'countActivityWaitingStatus' => $countActivityWaitingStatus,
            'countActivityOnProgressStatus' => $countActivityOnProgressStatus,
            'activityDisagreeStatus' => $activityDisagreeStatus,
            'countActivityDisagreeStatus' => $countActivityDisagreeStatus,
            'activityDetail' => $activityDetail
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Kegiatan';
        $activityCategory = ActivityCategory::all();
        // $village = Village::all();

        return view('pages.activity.form', [
            'title' => $title,
            'activityCategory' => $activityCategory,
            // 'village' => $village,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityRequest $request)
    {
        $auth = Auth::user();
        $employee = Employee::where('user_id', $auth->id)->first();
        if ($auth->getRoleNames()[0] == 'operator') {
            $status = 'on progress';
        } else {
            $status = 'waiting';
        }

        $activity = Activity::create([
            'activity_category_id' => $request->activity_category_id,
            'date' => $request->date,
            'village_id' => $employee->village_id,
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

        return redirect()->route('pengguna.activity.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Activity::where('id', $activity->id)->first();
        $title = 'Kegiatan';
        $activity = Activity::find($id);
        $imageActivity = ImageActivity::where('activity_id', $activity->id)->get();

        $activityDetail = ActivityDetail::where('activity_id', $activity->id)->first();
        $imageActivityDetail = ImageActivityDetail::where('activity_detail_id', $activityDetail->id)->get();

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
        $auth = Auth::user();
        $employee = Employee::where('user_id', $auth->id)->first();

        $data = [
            'activity_category_id' => $request->activity_category_id,
            'date' => $request->date,
            'village_id' => $employee->village_id,
            'address_details' => $request->address_details,
            'describe_point_location' => $request->describe_point_location,
            'name' => $request->name,
            'status' => 'waiting'
        ];

        $activity->update($data);

        if ($request->old) {
            ImageActivity::deleteImageArray($activity->id, $request->old);

            ImageActivity::where('activity_id', $activity->id)
                ->whereNotIn('id', $request->old)->delete();
        }
        if ($request->image) {
            foreach ($request->image as $data) {
                $filename = ImageActivity::saveImage($data);
                ImageActivity::create([
                    'activity_id' => $activity->id,
                    'image' => $filename
                ]);
            }
        }

        return redirect()->route('pengguna.activity.index')->with('success', 'Data Berhasil Diubah');
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

    /**
     * Aksi (get) yang dilakukan oleh operator untuk melakukan konfirmasi persetujuan ketika pengguna membuat jadwal kegiatan kebersihan.
     */
    public function validateWaitingStatus($id)
    {
        $title='Kegiatan';
        $activity=Activity::find($id);
        $imageActivity = ImageActivity::where('activity_id', $activity->id)->get();

        return view('pages.activity.formValidateWaitingStatus', [
            'title' => $title,
            'activity'=> $activity,
            'imageActivity' => $imageActivity
        ]);
    }

    /**
     * Aksi (post) yang dilakukan oleh operator untuk melakukan konfirmasi persetujuan ketika pengguna membuat jadwal kegiatan kebersihan.
     */
    public function formValidateWaitingStatus(Request $request, $id)
    {
        $data = [
            'status' => $request->status,
            'disgree_reason' => $request->disgree_reason
        ];

        Activity::where('id', $id)->update($data);

        return redirect()->route('operator.activities.index')->with('success', 'Berhasil Melakukan Konfirmasi');
    }

    /**
     * Aksi (get) yang dilakukan oleh pengguna untuk upload bukti kegiatan.
     */
    public function getActivityForUpload($id)
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

    /**
     * Aksi (post) yang dilakukan oleh pengguna untuk upload bukti kegiatan.
     */
    public function postActivity(Request $request, $id)
    {
        $activityDetail=ActivityDetail::create([
            'activity_id' => $id,
            'description' => $request->description,
            'status' => 'waiting'
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

        return redirect()->route('pengguna.activity.index')->with('success', 'Data Berhasil Diupload');
    }

    /**
     * Aksi (get) yang dilakukan oleh operator untuk melakukan konfirmasi persetujuan ketika pengguna upload bukti kegiatan.
     */
    public function validateUploadActivityIndex($id)
    {
        $title='Kegiatan';
        $activityDetail=ActivityDetail::find($id);

        return view('pages.activityDetail.validateUploadActivity', [
            'title' => $title,
            'activityDetail' => $activityDetail,
        ]);
    }

    /**
     * Aksi (post) yang dilakukan oleh operator untuk melakukan konfirmasi persetujuan ketika pengguna upload bukti kegiatan.
     */
    public function validateUploadActivityForm(Request $request, $id)
    {
        $data=[
            'status' => $request->status,
            'reason_disagree'=> $request->reason_disagree
        ];

        ActivityDetail::where('activity_id', $id)->update($data);

        return redirect()->route('operator.activities.index')->with('success', 'Berhasil Melakukan Validasi');
    }

    /**
     * Aksi (get) yang dilakukan oleh pengguna untuk melakukan perubahan pada saat upload bukti kegiatan.
     */
    public function uploadActivityEdit($id)
    {
        $title='Kegiatan';
        $activityDetail=ActivityDetail::find($id);

        return view('pages.activityDetail.formEdit', [
            'title' => $title,
            'activityDetail' => $activityDetail,
        ]);
    }

    /**
     * Aksi (post) yang dilakukan oleh pengguna untuk upload bukti kegiatan.
     */
    public function uploadActivityUpdate(Request $request, $id)
    {
        $dataActivityDetail = [
            'description' => $request->description,
            'status' => 'waiting'
        ];
        
        // Retrieve the activityDetail by its ID
        $activityDetail = ActivityDetail::where('id', $id)->first();
        
        if ($activityDetail) {
            // Update the activityDetail
            $activityDetail->update($dataActivityDetail);
        
            $image = $request->image;
            // $video = $request->video;

            $oldFile=[];
            if ($oldFile) {
                ImageActivityDetail::deleteFileArray($activityDetail->id, $oldFile);
                ImageActivityDetail::where('activity_detail_id', $activityDetail->id)->delete();
            }

        
            if ($image) {
                foreach ($image as $dataImage) {
                    $saveImage = ImageActivityDetail::saveFile($dataImage);
        
                    ImageActivityDetail::create([
                        'activity_detail_id' => $activityDetail->id,
                        'file' => $saveImage
                    ]);
                }
            }
        
            // if ($video) {
            //     foreach ($video as $dataVideo) {
            //         $saveVideo = ImageActivityDetail::saveFile($dataVideo);
            //         ImageActivityDetail::create([
            //             'activity_detail_id' => $activityDetail->id,
            //             'file' => $saveVideo
            //         ]);
            //     }
            // }
        }
        
        return redirect()->route('pengguna.activity.index')->with('success', 'Data Berhasil Diupload');
        
    }
}
