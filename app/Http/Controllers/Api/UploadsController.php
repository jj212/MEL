<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadsController extends Controller
{
    public function imageUpload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $image = $request->file('upload');
            $name = 'photo_'.time().'.'.$image->getClientOriginalExtension();
            $base_path = public_path().'/ckfinder/images';
            $path_origin = 'http://'.$_SERVER['HTTP_HOST'].'/ckfinder/images' . $name;

            if(!File::exists($base_path)) {
                File::makeDirectory($base_path, $mode = 0777, true, true);
            }
            $image->move($base_path, $name);

            return response()->json(['status'=>true,'message'=>'Saved successfully', 'default'=> $path_origin], 200);
        }


        return response()->json(['status'=>true,'message'=>'Upload failed'], 400);
    }
}
