<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntervalValue extends Model
{
    protected $fillable = [
        'branch',
        'name',
        'description',
        'min',
        'max',
        'created_by',
    ];

    public function branches()
    {
        return $this->hasOne('App\Models\Branch', 'id', 'branch');
    }

    public static $status = [
        'Not Started',
        'In Progress',
        'Completed',
    ];
}
