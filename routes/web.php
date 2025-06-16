<?php

use Illuminate\Support\Facades\Route;
use OsiSet\ShopifyLaravel\Facades\Shopify;

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

Route::get('/install-app', function() {
    return redirect()->route('shopify.api.install');
});

Route::get('/get-products', function() {

    try {
        $products = Shopify::products()->get();
        return response()->json($products);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});




// routes/web.php (TEMPORAL para limpiar caché)
Route::get('/clear-all-cache', function() {
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return "Todas las cachés limpiadas!";
});

//test s