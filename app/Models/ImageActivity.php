<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ImageActivity extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    /**
     * Get the activity that owns the ImageActivity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    /**
     * Save image.
     *
     * @param  $request
     * @return string
     */
    public static function saveImage($file)
    {
        // $filenames = [];

        if ($file) {
            // foreach ($request->file('image') as $file) {
                $ext = $file->getClientOriginalExtension();
                $filename = date('YmdHis') . uniqid() . '.' . $ext;
                $file->storeAs('public/image/activity/imageLokasi', $filename);
                // $filenames[] = $filename;
            // }
        }

        return $filename;
    }

    /**
     * Get the image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/public/image/activity/imageLokasi/' . $this->image);
        }

        return null;
    }

    /**
     * Delete image.
     *
     * @param  $id
     * @return void
     */
    public static function deleteImage($id)
    {
        $imageActivity = ImageActivity::firstWhere('id', $id);
        if ($imageActivity !== null && $imageActivity->image !== null) {
            $path = 'public/image/activity/imageLokasi/' . $imageActivity->image;
            if (Storage::exists($path)) {
                Storage::delete('public/image/activity/imageLokasi/' . $imageActivity->image);
            }
        }
    }

    public static function deleteImageArray(int $activityId, array $arrayId)
    {
        $imageActivity = ImageActivity::where('activity_id', $activityId)
        ->whereNotIn('id', $arrayId)->get();
        if (isset($imageActivity)) {
            foreach ($imageActivity as $image) {
                $path = 'public/image/activity/imageLokasi/' . $image->image;
                if (Storage::exists($path)) {
                    Storage::delete('public/image/activity/imageLokasi/' . $image->image);
                }
            }
        }
    }
}
