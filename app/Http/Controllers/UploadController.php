<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Image;

class UploadController extends Controller
{
    ### upload user avatar & news picture

    public function uploadImages(Request $request)
    {

        $file = $request->file('file');
        $size = File::size($file);
        $destinationPath = storage_path() . '/app/public/Uploads/images/';
        @mkdir($destinationPath, 0777);
        $extension = $file->getClientOriginalExtension();
        $filename = str_random(25) . '.' . $extension;
        $allowed = array('gif', 'png', 'jpg', 'Jpeg', 'JPG', 'PNG', 'GIF');
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $upload_success = $request->file('file')->move($destinationPath, $filename);

        if ($upload_success && in_array($ext, $allowed))
        {
            if ($ext == 'pdf')
            {
                
            } else
            {
                @mkdir($destinationPath . 'thumb', 0777);
                $img = Image::make($destinationPath . $filename);
                $img->resize(150, 150);

                $img->save($destinationPath . 'thumb/' . $filename);
                return response()->json(['filename' => $filename, 'size' => $size]);

                @mkdir($destinationPath . 'icon', 0777);
                $img = Image::make($destinationPath . $filename);
                $img->resize(40, 40);

                $img->save($destinationPath . 'icon/' . $filename);
            }
            return response()->json(['filename' => $filename, 'size' => $size]);
        } else if ($upload_success)
        {
            return response()->json(['filename' => $filename, 'size' => $size]);
        } else
        {
            return 'YEP: Problem in file upload';
        }
    }

    public static function uploadPDFfile($file)
    {

        $size = File::size($file);
        $destinationPath = storage_path() . '/app/public/Uploads/additional_pdf/';
        @mkdir($destinationPath, 0777);
        $extension = $file->getClientOriginalExtension();
        $filename = str_random(25) . '.' . $extension;
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $upload_success = $file->move($destinationPath, $filename);
        if ($upload_success)
        {
            $data = [];
            $data['success'] = 'true';
            $data['filename'] = $filename;
            return $data;
        } else
        {
            $data = [];
            $data['success'] = 'false';
            return $data;
        }
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $size = File::size($file);
        $destinationPath = storage_path() . '/app/public/Uploads/pdf_files/';
        @mkdir($destinationPath, 0777);
        $extension = $file->getClientOriginalExtension();
        $filename = str_random(25) . '.' . $extension;
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $upload_success = $request->file('file')->move($destinationPath, $filename);

        if ($upload_success)
        {
            return response()->json(['filename' => $filename, 'size' => $size]);
        } else
        {
            return 'YEP: Problem in file upload';
        }
    }

//    public function upload_document(Request $request)
    //    {
    //        $file = $request->file('photo');
    //        $size = File::size($file);
    //        $destinationPath = public_path() . '/Uploads/' . $request['folder'] . '/';
    //        @mkdir(public_path() . '/Uploads/' . $request['folder'], 0777);
    //
    //        $extension = $file->getClientOriginalExtension();
    //
    //        $filename = str_random(25) . '.' . $extension;
    //        $upload_success = $request->file('photo')->move($destinationPath, $filename);
    //        if ($upload_success)
    //        {
    //            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif' || $extension == 'bmp')
    //            {
    //                @mkdir($destinationPath . 'thumb', 0777);
    //                $img = Image::make($destinationPath . $filename);
    //                $img->resize(150, 150);
    //
    //                $img->save($destinationPath . 'thumb/' . $filename);
    //            }
    //            return response()->json(['filename' => $filename, 'size' => $size, 'name' => $file->getClientOriginalName()]);
    //        }
    //        else
    //        {
    //            return 'YEP: Problem in file upload';
    //        }
    //    }
    #### delete User avatar

    public function deleteUpload($folder, $image)
    {
        $filename = $image;
        $path_final_dir = public_path() . '/../../Uploads/' . $folder . '/';

        $thumb_path = 'thumb/';

        if (File::delete($path_final_dir . $filename))
        {
            if (File::delete($path_final_dir . $thumb_path . $filename))
            {
                
            }
            return 1;
        } else
        {
            return 0;
        }
    }

}
