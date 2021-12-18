<?php

namespace App\Http\Controllers;

use App\Models\Texted;
use Illuminate\Http\Request;

class InfoController extends Controller
{
   public function index()
   {
       $textes = Texted::all();
       return view('info', ['textes'=>$textes]);
   }
}
