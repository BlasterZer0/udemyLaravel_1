<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;

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

Route::middleware('auth')->group(function (){
    Route::get('products', function () {
        //$products = Product::all();
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    })->name('products.index');
    
    Route::get('products/create', function(){
        return view('products.create');
    })->name('products.create');
    
    Route::post('products', function(Request $request){
        //$request->all();
        $newProduct = new Product;
        $newProduct->description = $request->input('description');
        $newProduct->price = $request->input('price');
        $newProduct->save();
    
        return redirect()->route('products.index')->with('info', 'Producto creado exitosamente');
    })->name('products.store');
    
    Route::delete('products/{id}', function($id){
        //return $id;
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('info', 'Producto eliminado exitosamente');
    })->name('products.destroy');
    
    Route::get('products/{id}/edit', function($id){
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    })->name('products.edit');
    
    Route::put('/products/{id}', function(Request $request, $id){
        //return $request->all();
        $product = Product::findOrFail($id);
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();
        return redirect()->route('products.index')->with('info', 'Producto actualizado exitosamente');
    })->name('products.update');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
