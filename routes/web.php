<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/artigos', function () {
    return view('artigos');
});

Route::get('/cantigas', function () {
    return view('cantigas');
});

Route::get('/videos', function () {
    return view('videos');
});

Route::get('/servicos', function () {
    return view('servicos');
});

Route::get('/manifest.webmanifest', function () {
    return response()->file(public_path('manifest.webmanifest'), [
        'Content-Type' => 'application/manifest+json'
    ]);
});

Route::get('/manifest.php', function () {
    return response()->file(public_path('manifest.php'), [
        'Content-Type' => 'application/php'
    ]);
});

