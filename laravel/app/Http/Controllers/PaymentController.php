<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    use Traits\ConvertCurrencyTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getStripeForm() {
      return view('payment');  
    }


    public function postStripePayment(Request $r) {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $price = $this->convertWithEnvRate($r->credits);

        $description = "De gebruiker " . Auth::user()->name . " heeft credtis aangekocht";

        $charge = Charge::create([
            'amount' => $price,
            'currency' => 'eur',
            'source' => $r->stripeToken,
            'description' => $description,
        ]);

        if($charge->status == 'succeeded'){
            Auth::user()->credits += $r->credits;
            Auth::user()->save();

            $r->session()->flash('success', 'Je hebt succesvol ' . $r->credits  . ' credits aangekocht');
        }
        else{
            $r->session()->flash('error', 'Aj aj aj');
        }

        return back();
    }

}
