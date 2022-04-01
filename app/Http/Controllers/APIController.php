<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\package;

class APIController extends Controller
{

    function insert(Request $request)
    {
//        $sender = $request->sender;
//        $recipient = $request->recipient;
//        echo $recipient;
//        echo $sender;
        $package = new Package();
        $package->sender=$request->sender;
        $package->recipient=$request->recipient;


        if($package->save()){
            return['status'=>'data has been inserted'];
        }else{
            return['status'=>'Oh something went wrong, the data was unable to insert'];
        }
    }






}
