<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ConvertCurrencyTrait;

class APIController extends Controller
{

    use ConvertCurrencyTrait;

    public function postConvert(Request $r){

        $cost = $this->convertWithEnvRate($r->credits);

        // $credits = $r->credits;
        // $ratio = env('CREDIT_RATIO');

        // $cost = round($credits * $ratio, 2);


        return[
            'cost' => $cost
        ];
    }
}
