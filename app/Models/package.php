<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function Sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function Recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
