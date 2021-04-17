<?php


namespace App\Services;


class UploadImageService
{
    // upload image function
    public static function upload($image,$dir){
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        \Storage::disk('local')->putFileAs($dir, $image, $imageName);
        return $dir.'/'.$imageName;
    }
}
