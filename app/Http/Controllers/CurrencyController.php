<?php

namespace App\Http\Controllers;

use App\Models\BillingFrequency;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $currencies=Currency::all();

        return   view('currency.index')->with('currencies',$currencies);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $frequency=Currency::create([
            'name'=>$name
        ]);

        if ($frequency){
            return  redirect()->route('currency.index')->with('success','Currency created successfully');
        }
        return  redirect()->route('currency.index')->with('error','Currency not created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $currency->name=$name;

        if ($currency->save()){
            return  redirect()->route('currency.index')->with('success','Updated successfully');
        }
        return  redirect()->route('currency.index')->with('error','Currency  not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Currency $currency)
    {
        if ($currency->delete()){
            return  redirect()->route('currency.index')->with('success','Currency deleted successfully');

        }
        return  redirect()->route('currency.index')->with('error','Currency not deleted');
    }
}
