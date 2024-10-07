<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeCliente extends Controller
{
    public function index(){

        return view('home_cliente');
    }
}
