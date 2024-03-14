<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilePondFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class FilePondController extends Controller
{
    public function process(FilePondFormRequest $request)
    {
//        abort(422, 'No files were uploaded.');

//        $files = $request->allFiles();
//        if (empty($files)) {
//            abort(422, 'No files were uploaded.');
//        }
//
//        if (count($files) > 1) {
//            abort(422, 'Only 1 file can be uploaded at a time.');
//        }
//        $file = $request->file('thumbnail');


        $file = is_array($request->file('thumbnail'))
            ? Arr::first($request->file('thumbnail'))
            : $request->file('thumbnail');

        return $file->store('tmp/'.now()->timestamp.'-'.Str::random(20));
    }
}
