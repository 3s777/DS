<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilePondFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilePondController extends Controller
{
    public function process(FilePondFormRequest $request): string
    {
//        abort(422, 'No files were uploaded.');

        $files = $request->allFiles();

        if (empty($files)) {
            abort(422, 'No files were uploaded.');
        }

        if (count($files) > 1) {
            abort(422, 'Only 1 file can be uploaded at a time.');
        }

        $requestKey = array_key_first($files);

//        $file = is_array($request->input($requestKey))
//            ? $request->file($requestKey)[0]
//            : $request->file($requestKey);

        return $requestKey;
    }
}
