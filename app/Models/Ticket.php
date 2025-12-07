<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message', 'status'
    ];

    protected $attributes = [
        'status' => 'Pending'
    ];
}
