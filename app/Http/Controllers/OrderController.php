<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
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
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::all();

        return view('orders.index', compact('orders'));
    }
    
    /**
     * Display the products added in cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function myOrders()  
    {
        $orders = User::find(auth()->user()->id)->orders;

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified product.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $order =  Orders::findOrFail($id);
        $order_items = Orders::findOrFail($id)->items()->with('product')->get();
        return view('Orders.show', compact(['order','order_items']));
    }

    /**
     * Update the order has been delevered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function completed(string $id)
    {
        $order = Orders::findOrFail($id);

        if($order->status == 'completed')
        {
            return redirect()->back();
        }

        $order->update([
            'status' => 'completed',
        ]);

        return redirect()->back()->with('success', 'Order has been delevered.');
    }
}
