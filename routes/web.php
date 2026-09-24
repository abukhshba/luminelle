<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['ar', 'en'], strict: true)) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('locale.switch')->middleware('web');
