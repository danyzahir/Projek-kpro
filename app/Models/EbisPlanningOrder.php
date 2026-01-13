<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbisPlanningOrder extends Model
{
    use HasFactory;

    // Nama tabel (opsional, tapi biar jelas)
    protected $table = 'ebis_planning_orders';

    // Boleh mass assignment (pemula aman)
    protected $guarded = [];

    protected $fillable = [
    'track_id',
    'datel',
    'sto',
    'status_order',
    'tipe_desain',
    'jenis_program',
];

}
