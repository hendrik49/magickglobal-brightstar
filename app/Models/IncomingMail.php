<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingMail extends Model
{
    use HasFactory;

    protected $fillable = [
        'mail_no',
        'date',
        'source',
        'subject',
        'status',
        'created_by',
    ];
}
