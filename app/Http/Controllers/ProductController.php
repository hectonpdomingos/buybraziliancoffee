<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $products = Product::all();
         return $products->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
          
       
          
        $attributes = ['producer_id' => Auth::user()->id];

       $attributes += $this->validate(request(),[ 
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string',   
            'weight' => 'required',
            'coffeetype' => 'required|string',   
            'ean' => 'required|string',   
            'product_code' => 'required|string',   
            'price' => 'required',
            'stock' => 'required',                  
            'about_coffee' => 'required|string',   
       ]);
         
       if ($request->hasFile('photo')) {
           $image = $request->file('photo');
           $namePhoto = Auth::user()->id . '-'. time().'.'.$image->getClientOriginalExtension();
           $destinationPath = public_path('/images');
           $image->move($destinationPath, $namePhoto);
           //$this->save();
           
            // $name = request('name');
            // $weight = request('weight');
            // $coffeetype = request('coffeetype');
            // $ean = request('ean');
            // $product_code = request('product_code');
            // $producer_id = Auth::user()->id;
            // $price = request('price');
            // $stock = request('stock');
            // $about_coffee = request('about_coffee');
     
            products::create($attributes);
       }
       // return response()->json([$request->all()]);
      // dd_dump($attributes);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
