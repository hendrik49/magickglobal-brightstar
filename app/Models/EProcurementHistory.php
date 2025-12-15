<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EProcurementHistory extends Model
{
    use HasFactory;

    protected $table = 'eprocurement_history';

    protected $fillable = [
        'eprocurement_id',
        'status',
        'note',
    ];

    public function eprocurement()
    {
        return $this->belongsTo(EProcurement::class);
    }
}