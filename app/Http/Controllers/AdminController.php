<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;

class AdminController extends Controller
{
    //
	public function index(){
		return view('admin');
	}

    public function pickUpPlanSystem(){
        return view('pickUpPlanSystem');
    }
}
