<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Reservation\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $intent = Auth::user()->createSetupIntent();
        return view('checkout.index',compact('intent'));
    }

    public function store(Request $request){
        $request->validate([
            'card-holder-name' => 'required',
        ]);

        $request->user()->newSubscription(
            'main',env('STRIPE_ID')
        )->create($request->payment_method);
        return redirect()->route('mypage')->with('message', '有料会員に登録されました');
    }

    public function cancel() {
        
        return view('checkout.cancel');
    }

    public function delete() {
        Auth::user()->subscription('main')->delete();
        return redirect()->route('mypage')->with('message', '有料会員を終了しました');
    }

    public function edit() {
        $user= Auth::user();
        $intent = Auth::user()->createSetupIntent();
        return view('checkout.edit',compact('intent','user'));
    }

    public function update(Request $request) {
        $request->validate([
            'card-holder-name' => 'required',
        ]);

        $request->user()
            ->updateDefaultPaymentMethod($request->payment_method);
            return redirect()->route('checkout.edit')->with('message', 'カードを変更しました');
        }
}