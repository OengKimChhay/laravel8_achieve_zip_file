<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use ZipArchive;

class download extends Controller
{
    function ShowDownload(){
        return view('BtnDownload');
    }
    function ZipDownload(){
        $zip = new ZipArchive;
        $fileName = 'myNewFile.zip';
        if ($zip->open(public_path($fileName),ZipArchive::CREATE) === TRUE){
            $files = File::files(public_path('myFiles'));
            //u must make directory myFiles in public directory and also store file for download
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }            
            $zip->close();
        }   
        return response()->download(public_path($fileName));
    }
}
