<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ImageSubangActivity extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    /**
     * Get the subangActivity that owns the ImageSubangActivity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subangActivity(): BelongsTo
    {
        return $this->belongsTo(SubangActivity::class);
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

        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . uniqid() . '.' . $ext;
            $file->storeAs('public/file/activity/subangActivity/', $filename);
        }

        return $filename;
    }

    /**
     * Get the image.
     *
     * @return string
     */
    public function getFileUrlAttribute()
    {
        if ($this->file) {
            return asset('storage/public/file/activity/subangActivity/' . $this->file);
        }

        return null;
    }

    public static function deleteFileArray(int $subangActivityId, array $arrayId)
    {
        $imageSubangActivity = ImageSubangActivity::where('subang_activity_id', $subangActivityId)
        ->whereNotIn('id', $arrayId)->get();
        if (isset($imageSubangActivity)) {
            foreach ($imageSubangActivity as $file) {
                $path = 'public/file/activity/subangActivity/' . $file->file;
                if (Storage::exists($path)) {
                    Storage::delete('public/file/activity/subangActivity/' . $file->file);
                }
            }
        }
    }
}
