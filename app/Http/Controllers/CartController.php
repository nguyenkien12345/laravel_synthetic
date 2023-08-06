<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.cart');
    }

    public function showCheckOut()
    {
        return view('cart.checkout');
    }
}
