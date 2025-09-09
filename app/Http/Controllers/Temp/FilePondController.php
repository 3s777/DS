<?php

namespace App\Http\Controllers\Temp;

use App\Http\Controllers\Controller;
use FilePondFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilePondController extends Controller
{
    public function upload(FilePondFormRequest $request)
    {
        $filepondField = config('filepond.key');

        $file = is_array($request->file($filepondField))
            ? Arr::first($request->file($filepondField))
            : $request->file($filepondField);

        $folderName = config('filepond.temp_folder').'/'.now()->format('d-m-Y').'/'.Str::random(10);

        return Crypt::encrypt($file->store($folderName));
    }

    public function delete(Request $request)
    {
        $filePath = Crypt::decrypt($request->getContent());

        //        throw(new \Exception($u));

        Storage::delete($filePath);
    }
}
