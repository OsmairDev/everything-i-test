<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return ['oi'];
});

Route::get('/403', function () {

    abort_if(true, 403);

    return ['oi'];
});

Route::get('/products', function () {
    return view('products', [
        'products' => Product::all()
    ]);
});

Route::post('/products', function () {
    Product::query()->create(request()->only('title'));
    return response()->json('', 201);
})->name('product.store');

Route::put('/products/{product}', function(Product $product){
    $product->title = request()->get('title');
    $product->save();
})->name('product.update');

Route::delete('/product/{product}', function (Product $product){
    $product->forceDelete();
})->name('product.destroy');

Route::delete('/product/{product}/soft-delete', function (Product $product){
    $product->delete();
})->name('product.soft-delete');
