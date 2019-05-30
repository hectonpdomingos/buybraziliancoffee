<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\{Stripe, Charge, Customer};


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(request()->all());
       
        // Stripe::setApiKey(config('services.stripe.secret'));

        // $products = [ 'name' => 'Café MG','qty' => 3, 'price'  => 2099, 
        // 'total' => 3198
        // ];

        // $customer = Customer::create([
        //     'email' => request('stripeEmail'),
        //     'source' => request('stripeToken')
        //  ]);

        //  Charge::create([
        //      'customer' =>$customer->id,
        //      "currency" => "usd",
        //      "description" => "Café 3 corações",
        //      'amount' => 2500,
        //      'currency' => 'usd'

        //  ]);

        //  return redirect('home')->with('status', 'Thanks for buy our products! Our warehouse will get your order and send to you the best coffee! ;)');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
