<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        if($request->name !== null) {
            $stores = Store::where('name', 'like', "%{$request->name}%")->get();
        } elseif($request->category !== null) {

        } else {

        }
        //dd($request->name);
        //dd($stores);
        if($request->category !== null) {
            $stores = Store::where('category_id', $request->category);
            $total_count = Store::where('category_id', $request->category)->count();
            $category = Category::find($request->category);
        } else {
            $stores = Store::all();
            $total_count = "";
            $category = null;
        }

        $categories = Category::all();
        return view('stores.index', compact('stores', 'categories', 'total_count'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Store();
        $store->name = $request->input('name');
        $store->description = $request->input('discription');
        $store->price = $request->input('price');
        $store->time = $request->input('time');
        $store->postal_code = $request->input('postal_code');
        $store->address = $request->input('address');
        $store->save();

        return to_route('stores.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $reviews = $store->reviews()->get();
        
        return view('stores.show', compact('store', 'reviews'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $categories = Category::all();
        return view('stores.edit', compact('store', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $store->name = $request->input('name');
        $store->description = $request->input('discription');
        $store->price = $request->input('price');
        $store->time = $request->input('time');
        $store->postal_code = $request->input('postal_code');
        $store->address = $request->input('address');
        $store->category_id = $request->input('cactegory_id');
        $store->update();

        return to_route('stores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return to_route('stores.index');
    }
}
