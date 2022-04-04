<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BarcodeGenerator;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Dompdf\Dompdf;

class PackageController extends Controller
{
    public function outgoingPackages() {
    $packages = Package::all()->where('sender_id', '=', Auth::id());

	foreach($packages as $package)
	{
		$package->barcode_str = hash('MD2', $package->id);
		$package->barcode = $this->generateBarcode($package->barcode_str);
		$package->guest_link =  $_SERVER['APP_URL'] . ":" .$_SERVER['SERVER_PORT'] . "/package/" . base64_encode($package->id);
	}


    return view('outgoing-packages')->with('packages', $packages);
    }

    public function incomingPackages() {
    $packages = Package::all()->where('sender_id', '=', Auth::id());

	foreach($packages as $package)
	{
		$package->barcode_str = hash('MD2', $package->id);
		$package->barcode = $this->generateBarcode($package->barcode_str);
		$package->guest_link =  $_SERVER['APP_URL'] . ":" .$_SERVER['SERVER_PORT'] . "/package/" . base64_encode($package->id);
	}


    return view('incoming-packages')->with('packages', $packages);
    }


    public function getGuestPackage($id)
    {
	    try{
	    $package = Package::find(base64_decode($id));
	    $package->barcode_str = hash('MD2', $package->id);
	    $package->barcode = $this->generateBarcode($package->barcode_str);
	    return view('package')->with('package', $package);
	    }
	    catch(\Exception $e){
		    abort(404);
	    }
    }

    public function printLables(Request $request)
    {

	if (count((array)$request->package) == 0) abort(404);	

	$dompdf = new Dompdf();
	$html = "";

	foreach($request->package as $id)
	{
	    $package = Package::find($id);

	    if ($package == NULL) abort(404);

	    $package->barcode_str = hash('MD2', $package->id);
	    $package->barcode = $this->generateBarcode($package->barcode_str);

	    $html = $html .  "
			<div style=\"padding: 20px; width: 400px; height: 160px; position: relative; border: 1px dashed\">
			<div>
			<div style=\"margin: 5px; float: right;\">
			Sender:<br>
			" . $package->SenderAddress->firstname . " "
			  . $package->SenderAddress->lastname . "<br>" . 
			    $package->SenderAddress->street_name  . " " .
			    $package->SenderAddress->house_number . " <br> 
			" . $package->SenderAddress->postal_code . " " .
			    $package->SenderAddress->city ."<br>" .
			    $package->SenderAddress->country . "<br> 
			</div>
			<div style=\"margin: 5px; float: left\">
			Recipient:<br>
			" . $package->RecipientAddress->firstname  . " "
			  . $package->RecipientAddress->lastname . "<br>" . 
			    $package->RecipientAddress->street_name  . " " .
			    $package->RecipientAddress->house_number . " <br> 
			" . $package->RecipientAddress->postal_code . " " . 
			    $package->RecipientAddress->city ."<br>" .
			    $package->RecipientAddress->country . "<br> 
			</div>
			</div>
			<div style=\"margin: 10px; position: absolute;bottom: 0; left: 15px \">
			" .  $package->barcode . 
			     $package->barcode_str . "
			</div>
			</div><br>";
	}

	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'landscape');
	$dompdf->render();
        $dompdf->stream("dashboard/labels.pdf", array("Attachment" => true));
	
    }

	private function generateBarcode($request)
	{
		$generator = new BarcodeGeneratorHTML();	  		  	
		return $generator->getBarcode($request, $generator::TYPE_CODE_128, 1, 50);
	}

}
