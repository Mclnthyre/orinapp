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

// ATENÇÃO: rota temporária para setup. Remova assim que terminar.
Route::get('/_setup_routine_{TOKEN}', function () {
    // troque o TOKEN abaixo por uma string secreta sua (ex: 9f3aX7)
    $expected = 'COLOQUE_AQUI_SEU_TOKEN_SECRET';
    $uri = request()->path();
    if (! str_contains($uri, $expected)) {
        abort(403);
    }

    // Rodar comandos do Artisan
    \Artisan::call('key:generate', ['--force' => true]);
    \Artisan::call('storage:link');
    \Artisan::call('migrate', ['--force' => true]);
    \Artisan::call('db:seed', ['--force' => true]);

    return response('Setup completo', 200);
});


