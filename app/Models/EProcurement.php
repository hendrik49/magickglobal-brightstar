<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class EProcurement extends Model
{
    use HasFactory;

    protected $table = 'eprocurements';

    protected $fillable = [
        // Corporate Identity
        'nama_perusahaan',
        'nomor_sk_menkumham',
        'no_akta',
        'nomor_nib_oss',
        'npwp',
        'izin_operasional',
        'nomor_telpon',
        'email',
        'website',
        'alamat',
        
        // Manager Identity
        'nama_direksi',
        'nama_komisaris',
        'ktp_direksi',
        'ktp_komisaris',
        'npwp_direksi',
        'npwp_komisaris',
        'hp_direksi',
        'hp_komisaris',
        
        // Financial Data
        'nomor_rekening',
        'nama_bank',
        'cabang_bank',
        'atas_nama',
        
        // Document Files
        'sk_menkumham_file',
        'akta_file',
        'npwp_file',
        'nib_oss_file',
        'siup_file',
        'rekening_koran_file',
        'neraca_file',
        'company_profile_file',
        'portfolio_file',
        'cv_tenaga_ahli_file',
        'ktp_direksi_file',
        'ktp_komisaris_file',
        'npwp_direksi_file',
        'npwp_komisaris_file',
        
        // Status
        'status',
        'source_data_eproc',
        'created_by',
        'notes'
    ];

    // Define relationship with the user who created this record
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Get document file URL
    public function getDocumentUrl($field)
    {
        if (!$this->$field) {
            return null;
        }
        
        return Storage::url('eprocurement/' . $this->$field);
    }
}
