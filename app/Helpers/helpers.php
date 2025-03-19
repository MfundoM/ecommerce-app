<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

if (!function_exists('generateThumbnail')) {
    function generateThumbnail($image, $imageName, $destinationPath, $coverWidth, $coverHeight, $resizeWidth, $resizeHeight, $position)
    {
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $img = Image::read($image->path());
        $img->cover($coverWidth, $coverHeight, $position);
        $img->resize($resizeWidth, $resizeHeight, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $imageName);
    }
}

if (!function_exists('handleImageUpload')) {
    function handleImageUpload($image, $destinationPath, $coverWidth = 124, $coverHeight = 124, $resizeWidth = 124, $resizeHeight = 124, $position = 'top')
    {
        $fileExtension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        $fileName = Carbon::now()->timestamp . '-' . Str::random(10) . '.' . $fileExtension;

        generateThumbnail($image, $fileName, public_path($destinationPath), $coverWidth, $coverHeight, $resizeWidth, $resizeHeight, $position);

        return $fileName;
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage($imagePath, $image)
    {
        $oldImagePath = public_path($imagePath . '/' . $image);

        if (File::exists($oldImagePath) && $image) {
            File::delete($oldImagePath);
        }
    }
}
