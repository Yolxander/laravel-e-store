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
 
         return view('layouts.cart')->with([
             'mightAlsoLike' => $mightAlsoLike,
             'newSubtotal' => Cart::subtotal(),
             
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
 
    //  /**
    //   * Update the specified resource in storage.
    //   *
    //   * @param  \Illuminate\Http\Request  $request
    //   * @param  int  $id
    //   * @return \Illuminate\Http\Response
    //   */
    //  public function update(Request $request, $id)
    //  {
    //      $validator = Validator::make($request->all(), [
    //          'quantity' => 'required|numeric|between:1,5'
    //      ]);
 
    //      if ($validator->fails()) {
    //          session()->flash('errors', collect(['Quantity must be between 1 and 5.']));
    //          return response()->json(['success' => false], 400);
    //      }
 
    //      if ($request->quantity > $request->productQuantity) {
    //          session()->flash('errors', collect(['We currently do not have enough items in stock.']));
    //          return response()->json(['success' => false], 400);
    //      }
 
    //      Cart::update($id, $request->quantity);
    //      session()->flash('success_message', 'Quantity was updated successfully!');
    //      return response()->json(['success' => true]);
    //  }
 
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
