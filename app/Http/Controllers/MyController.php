<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\dataimport;
use Maatwebsite\Excel\Facades\Excel;


class MyController extends Controller
{
    //
    public function importExportView()
    {
       return view('import');
    }

    public function import()
    {
        $cif = new dataimport();
        $cif->sheets(1);
        Excel::import($cif,request()->file('file'));
        return back();
    }

    public function hapusCif()
    {
       return view('import');
    }

}

