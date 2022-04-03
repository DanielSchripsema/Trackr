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
        $package = new Package();
        //sender check if exist
        if($this->checkIfExist($request->sender) == false){
           return['status'=>'sender does not exist'];
        }else{
            $acc = $this->getUser($request->sender);
            $package->sender_id = $acc->id;
            $package->sender_address_id = $this->getAddress($acc->id);
        }
        if($request->recipient != null){
            if($this->checkIfExist($request->recipient) == true){
                $acc = $this->getUser($request->recipient);
                $package->recipient_id = $acc->id;
                $package->recipient_address_id = $this->makeAddress($acc->id, $request->RecipientCountry, $request->RecipientStreetName, $request->RecipientHouseNumber, $request->RecipientPostalCode, $request->RecipientCity);

            }
        }
        $package->recipient_address_id = $this->makeAddress($acc->id, $request->RecipientCountry, $request->RecipientStreetName, $request->RecipientHouseNumber, $request->RecipientPostalCode, $request->RecipientCity);


        if($package->save()){
            return['status'=>'data has been inserted'];
        }else{
            return['status'=>'Oh something went wrong, the data was unable to insert'];
        }

    }

    public function makeAddress(int $accID, $country, $StreetName, $HouseNumber, $PostalCode, $City){
        $address = new Address();
        $address->country = $country;
        $address->street_name = $StreetName;
        $address->house_number = $HouseNumber;
        $address->postal_code = $PostalCode;
        $address->city = $City;
        if($accID != null){
            $address->user_id = $accID;
        }
        $address->save();
       return $address->id;
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

    public function getAddress(int $senderID)
    {
        $addressID = DB::table('addresses')->where('user_id', $senderID)->first();



            return $addressID->id;

    }


}
