<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Package;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Picqer\Barcode\BarcodeGeneratorHTML;

class AdminController extends Controller
{

	public function index(){
		return view('admin');
	}


    public function pickUpPlanSystem() {
        $packages = Package::all()->where('sender_id', '=', Auth::id());
        $ValidPackages = [];
        foreach ($packages as $package){
           $checkDate = $package->created_at;
           $checkDate->addDays(-1);
            $checkDate->hour = '15';
            $checkDate->minute = '00';
            $checkDate->second = '00';

           //$date = new DateTime($checkDate->year + '-'+ $checkDate->month + '-' + $checkDate->day + '15:00:00');
          // echo($package->created_at);

            array_push($ValidPackages, $package);
        }
        return view('pickUpPlanSystem')->with('packages', $ValidPackages);
    }

    public function changePickUp(Request $request) {
      $array = [];
        foreach($request->package as $id) {
            $packages = Package::find($id);
            array_push($array, $packages);
        }
        return view('changePickUp')->with('packages', $array);
    }
    public function ConfirmPickUpChange(Request $request)
    {
        $validated = $request->validate([
            'Country' => 'bail|required',
            'Srteetname' => 'required',
            'housenumber' => 'required',
            'postalcode' => 'required',
            'Country' => 'required',
            'City' => 'required',
            'Date' => 'required'
        ]);
        foreach($request->package as $id) {
            $packages = Package::find($id);
            $idAddress = $this->makeAddress($this->getFirstname($packages->recipient_address_id), $this->getlastname($packages->recipient_address_id),$request->Country, $request->Srteetname, $request->housenumber, $request->postalcode, $request->City);
            $packages->recipient_address_id = $idAddress;
            $packages->save();
        };
        $packagesss = Package::all()->where('sender_id', '=', Auth::id());

        return view('pickUpPlanSystem')->with('packages', $packagesss);
    }

    public function makeAddress($Fistname, $Lastname, $country, $StreetName, $HouseNumber, $PostalCode, $City){
        $Query = DB::table('addresses')
            ->where('country', '=',$country)
            ->where('street_name', '=',$StreetName)
            ->where('house_number', '=',$HouseNumber)
            ->where('postal_code', '=',$PostalCode)
            ->where('city', '=',$City)
            ->where('firstname', '=', $Fistname)
            ->where('lastname', '=', $Lastname)
            ->first();
        if($Query != null){
            $address = $Query;
        }else{
            $address = new Address();
            $address->country = $country;
            $address->street_name = $StreetName;
            $address->house_number = $HouseNumber;
            $address->postal_code = $PostalCode;
            $address->city = $City;
            $address->firstname = $Fistname;
            $address->lastname = $Lastname;
            $address->save();
        }
        return $address->id;
    }

    private function getFirstname(int $recipientAddress_id)
    {
        $address = DB::table('addresses')->where('id', $recipientAddress_id)->first();
       return $address->firstname;
    }
    private function getlastname(int $recipientAddress_id)
    {
        $address = DB::table('addresses')->where('id', $recipientAddress_id)->first();
        return $address->lastname;
    }

}
