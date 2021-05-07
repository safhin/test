<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageUpload{

    public function postImageUpload($query)
    {
        $image_name = Str::random(20);
        $ext = strtolower($query->getClientOriginalExtension());
        $image_full_name  = $image_name.".".$ext;
        $upload_path = 'image/';
        $image_url = $upload_path.$image_full_name;
        $success = $query->move($upload_path,$image_full_name);

        return $image_url;
    }
}