<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datetime;
use App\Models\Store;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $store_id = $request->store_id;
        $user_name = Auth::user()->name;

        return view('reservations.create', compact('store_id', 'user_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number_of_people' => 'required|integer'  ,
            'date' => 'required|date' ,
            'time' => 'required|integer|between:0,24' 
        ]);

        $date_time = new DateTime($request->input('date').' '. $request->input('time').':00:00');
        
        if (new DateTime() > $date_time) {
            return back()->withInput($request->input())->withErrors(['message' => '現在より過去の予約日時は指定できません。']);
        }

        $store = Store::find($request->store_id);
        if($store->opening_time > $date_time->format('H:i:s') || $store->closing_time < $date_time->format('H:i:s')){
            return back()->withInput($request->input())->withErrors(['message' => '営業時間外です。']);
        }

        foreach(explode(',',$store->holiday) as $holiday){
            if(array_search($holiday,Store::DAY_OF_WEEK) == $date_time->format('w')){
                return back()->withInput($request->input())->withErrors(['message' => '定休日です。']);
            }
        }

        $reservation = new Reservation();
        $reservation->user_id = Auth::user()->id;
        $reservation->number_of_people = $request->input('number_of_people');
        $reservation->date_time = $request->input('date').' '.$request->input('time').':00:00';
        $reservation->store_id = $request->input('store_id');
        $reservation->save();

        return redirect()->route('stores.show', $reservation->store_id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return to_route('mypage.reservations');
    }
}
