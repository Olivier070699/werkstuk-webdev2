<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Gift;

class GiftsController extends Controller
{
    public function gifts(){
        $gifts = Gift::all();
        return view('gifts', compact('gifts'));
    }
}
