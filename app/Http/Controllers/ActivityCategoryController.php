<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityCategoryRequest;
use App\Models\ActivityCategory;
use Illuminate\Http\Request;

class ActivityCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Kategori Kegiatan';

        $activityCategory=ActivityCategory::all();

        return view('pages.activityCategory.index', [
            'title' => $title,
            'activityCategory' => $activityCategory
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Kategori Kegiatan';
        return view('pages.activityCategory.form', [
            'title' => $title
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityCategoryRequest $request)
    {
        ActivityCategory::create([
            'name' =>$request->name,
        ]);

        return redirect()->route('operator.activity-categories.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivityCategory $activityCategory)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title= 'Kategori Kegiatan';
        $activityCategory=ActivityCategory::find($id);

        return view('pages.activityCategory.form', [
            'activityCategory' => $activityCategory,
            'title'=> $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityCategoryRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
        ];

        ActivityCategory::where('id', $id)->update($data);

        return redirect()->route('operator.activity-categories.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $activityCategory=ActivityCategory::find($id);

        $activityCategory->delete();

        return response()->json(['success', 'Data Berhasil Dihapus']);
    }
}
