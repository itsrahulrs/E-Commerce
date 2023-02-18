<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [
                'index', 'show'
            ]
        ]);
        $this->middleware('permission', [
            'except' => [
                'index', 'show'
            ]
        ]);
    }

    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all()->where('status',1);

        return view('Products.index', compact('products'));
    }

    /**
     * Display a listing of the products that not approved.
     *
     * @return \Illuminate\Http\Response
     */
    public function newProducts()
    {
        $products = Products::all()->where('status',0);

        return view('Products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Products.create');
    }

    /**
     * Store a newly created product in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
        ]);
        
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move('images', $imageName);

        Products::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'price' => $request->price,
            'status' => 0,
        ]);

        return redirect()->back()->with('success', 'Product successfully stored.');
    }

    /**
     * Display the specified product.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        return view('Products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        return view('Products.edit', compact('product'));
    }

    /**
     * Update the specified product in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $imageName = $product->image;

        if(isset($request->image))
        {
            unlink("images/".$product->image);

            $imageName = time().'.'.$request->image->extension();  
            $request->image->move('images', $imageName);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'price' => $request->price,
            'status' => 0,
        ]);

        return redirect()->back()->with('success', 'Product successfully updated.');
    }

    /**
     * Approve the specified product in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve(string $id)
    {
        $product = Products::findOrFail($id);

        if($product->status == 1)
        {
            return redirect()->back();
        }

        $product->update([
            'status' => 1,
        ]);

        return redirect()->back()->with('success', 'Product approved successfully.');
    }

    /**
     * Remove the specified product from database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        unlink("images/".$product->image);
        $product->delete();

        return redirect()->back()->with('success', 'Product successfully deleted.');
    }
}
