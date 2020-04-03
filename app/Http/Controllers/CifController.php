<?php

namespace App\Http\Controllers;

use App\Cif;
use Illuminate\Http\Request;

class CifController extends Controller
{
    //
    public function hapusCif(){
        
        Cif::truncate();
        return redirect()->back(); 
    }
}
