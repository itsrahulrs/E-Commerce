<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission');
    }

    /**
     * Carted products checkout .
     *
     * @return \Illuminate\Http\Response
     */
    public function getCheckout()
    {
        $items = session()->get('cart');
        if($items == NULL || count($items) == 0)
        {
            return redirect()->back()->with('success', 'No products has been added into cart.');
        }

        return view('Products.checkout');
    }

    /**
     * Checkout & place order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
        ]);

        $order = Orders::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'user_id'           =>  auth()->user()->id,
            'status'            =>  'pending',
            'grand_total'       =>  $request->grand_total,
            'item_count'        =>  $request->item_count,
            'payment_status'    =>  0,
            'payment_method'    =>  null,
            'name'              =>  $request->name,
            'address'           =>  $request->address,
            'city'              =>  $request->city,
            'country'           =>  $request->country,
            'post_code'         =>  $request->postal_code,
            'phone_number'      =>  $request->phone
        ]);

        if ($order) {
            $items = session()->get('cart');
    
            foreach ($items as $key => $value)
            {
                OrderItems::create([
                    'order_id'      =>  $order->id,
                    'product_id'    =>  $key,
                    'quantity'      =>  $value['quantity'],
                    'price'         =>  $value['quantity'] * $value['price']
                ]);
            }
        }
        session()->put('cart', []);
        return redirect('cart')->with('success', 'Your Order has been placed successfully.');
    }
}
