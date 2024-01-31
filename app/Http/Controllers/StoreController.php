<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $categories = Category::all();
        $category = "";
        $category_id = null;
        $name = null;
        $address = null;

        if($request->name !== null) {
            $name = $request->name;
        }

        if($request->address !== null){
            $address = $request->address;
        }

        $stores = Store::where('name', 'like', "%{$name}%")->where('address', 'like', "%{$address}%");


        if($request->category_id !== null) {
            $category_id = $request->category_id;
            $category = Category::find($category_id);
            $stores = $stores->where('category_id', $category_id);
        }

        $total_count = $stores->count();
        $stores = $stores->paginate(5)->withQueryString();
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
        $user = Auth::user();
        
        return view('stores.show', compact('store', 'reviews', 'user'));
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
