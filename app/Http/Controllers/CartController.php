<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('permission');
    }
    
    /**
     * Display the products added in cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()  
    {
        return view('Products.cart');  
    }

    /**
     * cart the specified product in session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(string $id)
    {
        $product = Products::findOrFail($id);
        $cart = session()->get('cart');  
   
        if(!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "description" => $product->description,
                    "quantity" => 1,
                    "price" => $product->price,
                    "photo" => $product->image
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully.');
        }
   
        if(isset($cart[$id])) {
   
            $cart[$id]['quantity']++;
   
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully.');
   
        }

        $cart[$id] = [
            "name" => $product->name,
            "description" => $product->description,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->photo
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }
    
    /**
     * Update the product added to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
    
                return redirect('cart')->with('success', 'Cart updated successfully.');
            }
        }
        return redirect('cart');
    }
    
    /**
     * Delete the product added to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart(Request $request)
    {
        if($request->id)
        {
            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);

                return redirect('cart')->with('success', 'Product removed from cart.');
            }
        }
        return redirect('cart');
    }
}
