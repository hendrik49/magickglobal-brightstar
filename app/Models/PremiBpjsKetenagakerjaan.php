<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PremiBpjsKetenagakerjaan extends Model
{
    use HasFactory;

    protected $table = 'premi_bpjs_ketenagakerjaan';

    protected $fillable = [
        'name',
        'premi',
        'is_active',
    ];

    public function employmentPremiums()
    {
        return $this->hasMany(BpjsEmploymentPremium::class, 'premi_bpjs_ketenagakerjaan_id');
    }
}
