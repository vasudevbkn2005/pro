<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\AuthenticateSession;
// use App\Models\Category;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::resource('product',ProductController::class);
    Route::delete('category/mdel',[CategoryController::class,'mdel']);
    Route::resource('category', CategoryController::class);
    Route::get('category/updatedisplay/{display}/{id}',[CategoryController::class,'updatedisplay']);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
