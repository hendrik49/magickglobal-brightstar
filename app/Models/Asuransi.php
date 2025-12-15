<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asuransi extends Model
{
    protected $fillable = [
        'id_employee',
        'jenis_asuransi',
        'nilai_premi',
    ];
}
