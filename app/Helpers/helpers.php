<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

if (!function_exists('generateThumbnail')) {
    function generateThumbnail($image, $imageName, $destinationPath, $width, $height, $position)
    {
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $img = Image::read($image->path());
        $img->cover($width, $height, $position);
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $imageName);
    }
}

if (!function_exists('handleImageUpload')) {
    function handleImageUpload($image, $destinationPath, $width, $height, $position = 'top')
    {
        $fileExtension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        $fileName = Carbon::now()->timestamp . '.' . $fileExtension;

        generateThumbnail($image, $fileName, public_path($destinationPath), $width, $height, $position);

        return $fileName;
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage($imagePath, $image)
    {
        $oldImagePath = public_path($imagePath . $image);

        if (File::exists($oldImagePath) && $image) {
            File::delete($oldImagePath);
        }
    }
}
