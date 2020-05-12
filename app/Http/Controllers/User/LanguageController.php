<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class LanguageController extends Controller
{
    public function Bangla()
    {
        Session::get('lang');
        session()->forget('lang');
        Session::put('lang','bangla');
        return redirect()->back();
    }


    public function English()
    {
        Session::get('lang');
        session()->forget('lang');
        Session::put('lang','english');
        return redirect()->back();
    }
}
