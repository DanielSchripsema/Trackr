<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\package;

class APIController extends Controller
{

    function insert(Request $request)
    {
        $package = new Package();
        $package->status=$request->status;
        return $package->save();
    }






}
