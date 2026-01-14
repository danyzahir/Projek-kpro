<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbisPlanningOrder extends Model
{
    use HasFactory;

    protected $table = 'ebis_planning_orders';

    protected $guarded = [];

    protected $fillable = [
        'star_click_id',
        'track_id',
        'ticket_id',
        'star_click_status',
        'status_alokasi_alpro',
        'id_odp_alokasi_alpro',
        'nama_odp_alokasi_alpro',
        'reservation_id_alokasi_alpro',
        'nama_pengguna_melakukan_alokasi_alpro',
        'username_nik_alokasi_alpro',
        'latitude',
        'longitude',
        'sales_code',
        'remark',
        'segment',
        'cfu',
        'source_app',
        'disurvey_pada',
        'estimasi_go_live',
        'real_go_live',
        'initial_date',
        'finish_install_date',
        'regional',
        'witel',
        'witel_lama',
        'datel',
        'sto',
        'wok',
        'nama_customer',
        'telkomsel_area',
        'telkomsel_regional',
        'telkomsel_branch',
        'telkomsel_cluster',
        'status_order',
        'validasi_planning',
        'ihld_lop_id',
        'eproposal_lop_id',
        'eproposal_lop_parent_id',
        'kode_program',
        'nama_proyek',
        'tipe_desain',
        'total_boq',
        'capex_per_port',
        'odp_total',
        'total_port',
        'batch_program',
        'status_eproposal',
        'status_tomps',
        'status_tomps_last_activity',
        'status_sap',
        'status_proyek',
        'odp_go_live',
        'tanggal_waiting_caring',
        'tanggal_submitted_to_eproposal',
        'tanggal_inisiasi_tomps',
        'tanggal_validasi_abd_tomps',
        'tanggal_go_live_tomps',
        'ditambahkan_pada',
        'username_nik_pembuat',
        'kategori_mitra',
        'nama_mitra',
        'revenue_plan',
        'nama_cfu',
        'tahun',
        'jenis_program',
        'kategori',
    ];
}
