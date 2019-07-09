<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use File;

class MainController extends Controller {

    public function home() {
        return view('home', [
            'carousel' => \App\Carousel::ordered()->get()
        ]);
    }

    public function upload(Request $request) {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'Une erreur s\'est produite lors de l\'envoi de l\'image.'], 406);
        }

        if (!in_array($request->file('file')->getClientOriginalExtension(), ['jpg', 'jpeg', 'png'])) {
            return response()->json(['error' => 'Seuls les formats suivants sont acceptés : JPG, JPEG, PNG.'], 406);
        }

        if ($request->file('file')->getSize() > 1024 * 5100) {
            return response()->json(['error' => 'L\'image fournie est trop volumineuse (5 Mo max).'], 406);
        }

        return response()->json(['path' => basename($request->file('file')->store('uploads'))]);
    }

    public function uploaded($filename) {
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
