<?php

function assetv($path) {
    $file = public_path($path);

    $hash = 'undefined';

    if (file_exists($file)) {
        $hash = filemtime($file);

        if (!$hash) {
            $hash = md5_file($file);
        }
    }

    return asset($path) . "?v=$hash";
}

function user() {
    return Auth::user();
}

function isAdmin() {
    return (user() && user()->type === 'admin');
}
