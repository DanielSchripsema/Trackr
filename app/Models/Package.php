<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Package extends Model
{
    
    protected $with = ['Sender', 'Recipient', 'SenderAddress', 'RecipientAddress', 'Review'];

    public $timestamps = false;

    public function Sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function Recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function RecipientAddress()
    {
        return $this->belongsTo(Address::class, 'recipient_address_id');
    }

    public function SenderAddress()
    {
        return $this->belongsTo(Address::class, 'sender_address_id');
    }


    public function Review()
    {
        return $this->hasOne(Review::class);
    }

}