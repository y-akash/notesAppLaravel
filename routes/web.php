<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    if (Auth::check()){
        return redirect("/notes");
    }
    return view('welcome');
});

Route::get("/notes", [NoteController::class, "getNotes"])->middleware("auth");

Route::put("/note", [NoteController::class, "updateNote"])->middleware("auth");

Route::post("/note", [NoteController::class, "storeNote"])->middleware("auth");

Route::delete("/note", [NoteController::class, "deleteNote"])->middleware("auth");



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
