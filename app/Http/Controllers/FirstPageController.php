<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Hospital;
use Illuminate\Http\Request;

class FirstPageController extends Controller
{
    public function view(){
       $faqs = Faq::all();
       $hospitals = Hospital::all();
       return view("welcome1",compact("faqs","hospitals"));

    }
}
