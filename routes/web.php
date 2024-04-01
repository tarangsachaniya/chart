<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\SportsController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::view('/', 'sports');
Route::get('/store',[SportsController::class,'storeData']);
Route::get('/barchart', [DataController::class,'getBarChartData']);
Route::get('/piechart', [DataController::class,'getPieChart']);
Route::get('/linechart', [DataController::class,'getLineChart']);
Route::get('/polarchart', [DataController::class,'getPolarChart']);
Route::get('/mixedchart', [DataController::class,'getMixedChart']);
Route::get('/bubblechart', [DataController::class,'getBubbleChart']);
Route::get('/post/year',[SportsController::class,'getPostByYear']);
Route::view('/post','yearwise');
Route::get('/second',[SportsController::class,'getPostBySport']);
Route::get('/author',[SportsController::class,'getPostByauthor']);
Route::get('/charts',[DataController::class,'getdata']);
