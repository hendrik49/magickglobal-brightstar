<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BpjsEmploymentPremium extends Model
{
    use HasFactory;

    protected $table = 'bpjs_employment_premiums';

    protected $fillable = [
        'premi_bpjs_ketenagakerjaan_id',
        'employee_id',
        'policy_number',
        'company_percentage',
        'employee_percentage',
    ];

    public function premiType()
    {
        return $this->belongsTo(PremiBpjsKetenagakerjaan::class, 'premi_bpjs_ketenagakerjaan_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

     // 🔢 Kontribusi perusahaan
    public function getCompanyContributionAttribute()
    {
        if ($this->employee && $this->employee->salary) {
            return round($this->employee->salary * ($this->company_percentage / 100), 2);
        }
        return 0;
    }

    // 🔢 Kontribusi karyawan
    public function getEmployeeContributionAttribute()
    {
        if ($this->employee && $this->employee->salary) {
            return round($this->employee->salary * ($this->employee_percentage / 100), 2);
        }
        return 0;
    }
}
