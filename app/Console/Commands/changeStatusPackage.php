<?php

namespace App\Console\Commands;

use App\Models\Package;
use Illuminate\Console\Command;
use function PHPUnit\Framework\returnCallback;

class changeStatusPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changeStatusPackage:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       // returnCallback('/API/Changepackage{packageID}To{status}');
//        DB::insert('insert into addresses (country, street_name,house_number, postal_code, city) values (kk, kk, 3, 4444 GH, eindhoven)');
        $package = new Package();
        $package->recipient_id = 1;
        $package->recipient_address_id = 1;
        $package->sender_address_id = 1;
        $package->EmailRecipient = "sa@example.com";
        $package->EmailSender = 'a@example.com';
    }
}
