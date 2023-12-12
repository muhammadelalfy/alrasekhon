<?php

use App\Http\Controllers\PlaygroundController;
use Illuminate\Support\Facades\Route;

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
//Route::get('tr', function (){
//    $ss = \App\Models\CompetitionLevel::where('competition_id',1)->get();
////    $ss = \Illuminate\Support\Facades\DB::table('competition_level')->get();
//    dd($ss);
//});
Route::get('playground', [PlaygroundController::class,'playground']);
//Route::get('change-password', [\App\Http\Controllers\Api\V1\Auth\ResetPasswordController::class,'changePassword'])->name('changePassword');

Route::get('/{any}', function () {
//    dd(app()->getLocale());
    return view('app');
})->where('any', '.*')->name('vueApp')/*->middleware('signed')*/;
