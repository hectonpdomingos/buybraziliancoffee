<?php
namespace App;
use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;
//use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Mphpodel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DB;
use Auth;


class FormProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('FormProduct');
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
          
        $attributes = ['producer_id' => Auth::user()->id];

       //$attributes += $this->validate(request(),[ 
        $attributes += request()->validate([
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
          // $this->save();
           
            $name = request('name');
            $weight = request('weight');
            $coffeetype = request('coffeetype');
            $ean = request('ean');
            $product_code = request('product_code');
            $producer_id = Auth::user()->id;
            $price = request('price');
            $stock = request('stock');
            $about_coffee = request('about_coffee');
     
            //product::create($attributes);
         DB::table('products')->insertGetId(
         ['name' => $name, 'coffeetype' => $coffeetype, 'photo' => $namePhoto, 'product_code' => $product_code,
          'ean' => $ean, 'producer_id' => $producer_id,'weight' => $weight, 'price' => $price, 'stock' => $stock,
          'cost' => 0 ,'about_coffee' => $about_coffee, 'created_at' => now()]);
       }

         
       

       // return response()->json([$request->all()]);
      // dd_dump($attributes);
       
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
        //
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
