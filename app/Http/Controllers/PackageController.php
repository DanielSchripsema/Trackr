<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function index(){
    return view('create-labels');
    }


    public function outgoingPackages() {

    $lc = new LabelController();
    $packages = Package::where('sender_id', '=', Auth::id())->filter(request(['status', 'time']))->paginate(10);
    $packages = $lc->labelGeneratorWithGuestLink($packages);
    return view('outgoing-packages')->with('packages', $packages);
    }

    public function incomingPackages() {

    $lc = new LabelController();
    $packages = Package::where('recipient_id', '=', Auth::id())->filter(request(['status', 'time']))->paginate(10);
    $packages = $lc->labelGeneratorWithGuestLink($packages);

    return view('incoming-packages')->with('packages', $packages);
    }

    public function guestPackage($id)
    {
    try{
	    $lc = new LabelController();
	    $package = Package::find(base64_decode($id));
	    $package = $lc->labelGenerator($package);
		    return view('package')->with('package', $package);
	    }
		    catch(\Exception $e){
		    abort(404);
	    }
    }
}
