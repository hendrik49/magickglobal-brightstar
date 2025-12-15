<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InsuranceMedical extends Model
{
    use HasFactory;

    protected $table = 'insurance_medicals';

    protected $fillable = [
        'employee_id',
        'provider',
        'policy_number',
        'nominal',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
