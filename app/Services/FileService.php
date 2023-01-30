<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    public function storeReturnUrlBase64($base64, $path, $prefix = '')
    {
        if (Str::contains($base64, 'base64')) {
            $image_parts = explode(";base64,", $base64);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
        } else {
            $image_type = 'png';
            $image_base64 = base64_decode($base64);
        }
        $filename        = $prefix . '_' . Str::random(12) . '_' . date('ymdhis') . '.' . $image_type;
        $destinationPath = public_path('/images' . '/' . $path . '/' . $filename);
        if (!File::exists(public_path('/images' . '/' . $path))) {
            File::makeDirectory(public_path('/images' . '/' . $path), 0755, true);
        }
        file_put_contents($destinationPath, $image_base64);
        $url = asset('images' . '/' . $path . '/' . $filename);
        return $url;
        // Storage::put('signin.' . $image_base64, $image_type);

        // $data = $base64;
        // list($type, $data) = explode(';', $data);
        // list(, $data) = explode(',', $data);
        // $data = base64_decode($data);

        // $fileName = time() . '.png';
        // $path = 'images/' . $fileName;

        // Storage::disk('public')->put($path, $data);

        // return asset('storage/' . $path);
    }

    public function storeReturnUrl($file, $path, $prefix = '')
    {
        $filename        = $prefix . '_' . Str::random(12) . '_' . date('ymdhis') . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('/images' . '/' . $path);
        $file->move($destinationPath, $filename);
        $url = asset('images' . '/' . $path . '/' . $filename);
        return $url;
    }

    public function destroyByUrl($file_url)
    {
        $file_url  = str_replace(url('/'), '', $file_url);
        $file_path = public_path($file_url);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
    }
}
