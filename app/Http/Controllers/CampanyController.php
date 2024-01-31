<?php

namespace App\Http\Controllers;

use App\Models\Campany;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campany = Campany::find(1);
        
        return view('campany.index', compact('campany'));
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
     * @param  \App\Models\Campany  $campany
     * @return \Illuminate\Http\Response
     */
    public function show(Campany $campany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campany  $campany
     * @return \Illuminate\Http\Response
     */
    public function edit(Campany $campany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campany  $campany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campany $campany)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campany  $campany
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campany $campany)
    {
        //
    }
}
