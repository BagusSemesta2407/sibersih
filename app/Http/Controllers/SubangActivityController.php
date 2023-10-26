<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubangActivityRequest;
use App\Models\ActivityCategory;
use App\Models\ImageSubangActivity;
use App\Models\SubangActivity;
use Illuminate\Http\Request;

class SubangActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title='Kegiatan Kantor Kecamatan Subang';
        $subangActivity=SubangActivity::all();

        return view('pages.subangActivity.index', [
            'subangActivity'=> $subangActivity,
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title='Kegiatan Kantor Kecamatan Subang';

        $activityCategory=ActivityCategory::all();

        return view('pages.subangActivity.form', [
            'activityCategory' => $activityCategory,
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubangActivityRequest $request)
    {
        $subangActivity=SubangActivity::create([
            'activity_category_id' => $request->activity_category_id,
            'name' => $request->name,
            'date' => $request->date,
            'address_details'=> $request->address_details,
        ]);

        if ($request->image) {
            foreach ($request->image as $dataImage) {
                $fileImage=ImageSubangActivity::saveFile($dataImage);
                ImageSubangActivity::create([
                    'subang_activity_id' => $subangActivity->id,
                    'file' => $fileImage
                ]);
            }
        }

        return redirect()->route('operator.subang-sub-district-activity.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $title='Kegiatan';
        $subangActivity=SubangActivity::find($id);

        return view('pages.subangActivity.detail', [
            'subangActivity' => $subangActivity,
            'title' => $title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title='Kegiatan Kantor Kecamatan Subang';
        $subangActivity=SubangActivity::find($id);
        $imageSubangActivity=$subangActivity->imageSubangActivity->pluck('file_url', 'id');
        $activityCategory=ActivityCategory::all();

        return view('pages.subangActivity.form', [
            'title' => $title,
            'activityCategory' => $activityCategory,
            'subangActivity' => $subangActivity,
            'imageSubangActivity' => $imageSubangActivity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data=[
            'activity_category_id' => $request->activity_category_id,
            'name' => $request->name,
            'date' => $request->date,
            'address_details'=> $request->address_details,
        ];

        $subangActivity=SubangActivity::where('id', $id)->update($data);

        if ($request->old) {
            ImageSubangActivity::deleteFileArray($subangActivity, $request->old);
            
            ImageSubangActivity::where('subang_activity_id', $subangActivity)
            ->whereNotIn('id', $request->old)->delete();
        }

        if ($request->image) {
            foreach ($request->image as $data) {
                $fileImage=ImageSubangActivity::saveFile($data);
                ImageSubangActivity::create([
                    'subang_activity_id'=>$id,
                    'file'=>$fileImage
                ]);
            }
        }

        return redirect()->route('operator.subang-sub-district-activity.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subangActivity=SubangActivity::find($id);
        $imageSubangActivity=[];
        ImageSubangActivity::deleteFileArray($subangActivity->id, $imageSubangActivity);
        $subangActivity->delete();

        ImageSubangActivity::where('subang_activity_id', $subangActivity->id)->delete();

        return response()->json(['success', 'Data Berhasil Dihapus']);
     }
}
