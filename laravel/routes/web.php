<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('default2.index');
});

Route::get('/page/{pageId}/', function ($pageId) {
    return [
        'success' => true,
        'page' => $pageId,
        'docs' => \App\Models\DocumentModel::all()->take(12)->toArray(),
    ];
});
