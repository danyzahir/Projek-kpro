<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbisManualInput extends Model
{
    use HasFactory;

    protected $table = 'ebis_manual_inputs';

    protected $fillable = [
        'nde_jt',
        'star_click_id',
        'nama_customer',
        'alamat_pelanggan',
        'telepon_pelanggan',
        'tikor_pelanggan',
        'datel',
        'sto',
        'catatan',
    ];

    /**
     * ======================================
     * RELATION KE DATA UPLOAD (EXCEL)
     * ======================================
     * Ambil data dari ebis_planning_orders
     * berdasarkan star_click_id
     */
    public function planning()
    {
        return $this->belongsTo(
            \App\Models\EbisPlanningOrder::class,
            'star_click_id',   
            'star_click_id'    
        );
    }
}
