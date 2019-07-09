<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use File;

class UploadController extends Controller {

    public function upload(Request $request) {
        $path = null;

        if ($request->hasFile('file')) {
            $path = basename($request->file('file')->store('uploads'));
        }

        return response()->json(['path' => $path]);
    }

    public function get($filename) {
        $path = storage_path('app/uploads/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);

        return Response::make($file, 200)
                        ->header('Access-Control-Allow-Origin', request()->getSchemeAndHttpHost())
                        ->header("Content-Type", File::mimeType($path))
                        ->header('Content-Length', strlen($file));
    }

}
