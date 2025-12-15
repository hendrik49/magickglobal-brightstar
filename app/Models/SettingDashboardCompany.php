<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingDashboardCompany extends Model
{
    use HasFactory;

    protected $table = 'setting_dashboard_companies';

    protected $fillable = [
        'user_id',
        'background_manufacture',
        'icon_manufacture',
        'background_pertambangan',
        'icon_pertambangan',
        'background_koperasi',
        'icon_koperasi',
        'background_pertanian',
        'icon_pertanian',
        'background_ekspedisi',
        'icon_ekspedisi',
        'background_ritel',
        'icon_ritel',
        'background_pelanggan',
        'icon_pelanggan',
        'background_vendor',
        'icon_vendor',
        'background_invoice',
        'icon_invoice',
        'background_bill',
        'icon_bill',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
