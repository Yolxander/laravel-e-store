<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $mightAlsoLike = Product::mightAlsoLike()->get();
 
         return view('cart')->with([
             'mightAlsoLike' => $mightAlsoLike,
             'newTotal' => Cart::subtotal() ,
         ]);
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \App\Models\Product  $product
      * @return \Illuminate\Http\Response
      */
     public function store(Product $product)
     {
         $duplicates = Cart::search(function ($cartItem, $rowId) use ($product) {
             return $cartItem->id === $product->id;
         });
 
         if ($duplicates->isNotEmpty()) {
             return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
         }
 
         Cart::add($product->id, $product->name, 1, $product->price)
             ->associate('App\Models\Product');
 
         return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart!');
     }
 

 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Cart::remove($id);
 
         return back()->with('success_message', 'Item has been removed!');
     }
 
     
     
}
