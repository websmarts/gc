<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;




class MembersImportController extends Controller
{
    
    public function index()
    {
        return view('import-members');
    }

    public function import(Request $request)
    {
        if ($request->hasFile('spreadsheet') && $request->file('spreadsheet')->isValid() ) {

            $path = $request->spreadsheet->path();

            $collection = (new FastExcel)->import($path);

            dd($collection);

            // loop through

            // exclude invalid rows

            // extract and transform valid rows into contacts within membership groups

            // split up obvious records into multiple contacts eg a & B smith into A Smith and B Smith records

            // loop through membership groups and
            // create membership of appropriate type
            // and add contacts linked to each membership
            

            // redirect to a page that displays the groups contacts/memberships
            

        }

        dd('request does not have valid file ');
    }
      
}
