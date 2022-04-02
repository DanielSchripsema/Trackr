<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Address;

class APIController extends Controller
{

    function insert(Request $request)
    {
        //sender check if exist
        if($this->checkIfExist($request->sender) == false){
           // return['status'=>'sender does not exist'];
        }


    //in adressen zoeken naar de verzender zijn adress
        $this->makeAddress($request->SenderCountry, $request->SenderStreetName, $request->SenderHouseNumber,
        $request->SenderPostalCode, $request->SenderCity);
//        $sender = $request->sender;
//        $recipient = $request->recipient;
//        echo $recipient;
//        echo $sender;
        $package = new Package();
<<<<<<< Updated upstream
        $package->sender=$request->sender;
        $package->recipient=$request->recipient;

=======

//        $package->sender=$request->sender;
//        $package->recipient=$request->recipient;

//        echo($request->SenderCountry);
//        echo($request->SenderStreetName);
//        echo($request->SenderHouseNumber);
//        echo($request->SenderPostalCode);
//        echo($request->SenderCity);

//        echo($request->RecipientCountry);
//        echo($request->RecipientStreetName);
//        echo($request->RecipientHouseNumber);
//        echo($request->RecipientPostalCode);
//        echo($request->RecipientCity);

>>>>>>> Stashed changes



        //reciever
        if($this->checkIfExist($request->recipient)){
            $acc = $this->getUser($request->recipient);
            $package->recipient_id = $acc;

        }




        //dd($package);
//        if($address->save()){
//            return['status'=>'data has been inserted'];
//        }else{
//            return['status'=>'Oh something went wrong, the data was unable to insert'];
//        }
//        if($package->save()){
//            return['status'=>'data has been inserted'];
//        }else{
//            return['status'=>'Oh something went wrong, the data was unable to insert'];
//        }

    }

    public function makeAddress($country, $StreetName, $HouseNumber, $PostalCode, $City){
        $address = new Address();
        $address->country =
//        echo($request->SenderCountry);
//        echo($request->SenderStreetName);
//        echo($request->SenderHouseNumber);
//        echo($request->SenderPostalCode);
//        echo($request->SenderCity);

        //kijken of verzender al een adres heeft

        //check voor user en dan toevoegen aan address en uiteindelijk aan package mee geven
        //als sender niet bestaat stoppen
    }

    public function getUser($email){
        return DB::table('users')->select('id')->where('email', $email)->first();
    }

    public function checkIfExist($email){
        if($email != null){

            $user = DB::table('users')->where('email', $email)->first();

            if ($user === null) {
                return false;
            }else{
                return true;
            }
        }
    }




}
