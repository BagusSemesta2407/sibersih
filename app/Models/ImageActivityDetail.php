<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ImageActivityDetail extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    /**
     * Get the activityDetail that owns the ImageActivityDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activityDetail(): BelongsTo
    {
        return $this->belongsTo(ActivityDetail::class);
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['file_url'];

    /**
     * Save image.
     *
     * @param  $request
     * @return string
     */
    public static function saveFile($file)
    {
        // $filenames = [];

        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . uniqid() . '.' . $ext;
            $file->storeAs('public/file/activityDetails', $filename);
            return $filename;
        }

        return null;
    }

    /**
     * Get the image.
     *
     * @return string
     */
    public function getFileUrlAttribute()
    {
        if ($this->file) {
            return asset('storage/public/file/activityDetails/' . $this->file);
        }

        return null;
    }

    public static function deleteFileArray(int $activityDetailId, $arrayId)
    {   
        $imageActivityDetail = ImageActivityDetail::where('activity_detail_id', $activityDetailId)
        ->whereIn('id', $arrayId)->get();
        if (isset($imageActivityDetail)) {
            foreach ($imageActivityDetail as $file) {
                $path = 'public/file/activityDetails/' . $file->file;
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }
            }
        }
    }
}
