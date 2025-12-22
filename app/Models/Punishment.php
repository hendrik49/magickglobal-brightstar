<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Deduction;


class Punishment extends Model
{


     protected $fillable = [
        'employee_id',
        'payslip_id',
        'punishmentype',
        'date',
        'gift',
        'description',
        'created_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function deduction()
    {
        return $this->belongsTo(DeductionOption::class, 'punishmentype', 'id');
    }

    // Relasi ke User yang membuat punishment
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function payslip()
{
    return $this->belongsTo(PaySlip::class, 'payslip_id' , 'id');
}
    

}
