<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbisPlanningProgressLog extends Model
{
    protected $fillable = [
        'ebis_planning_order_id',
        'progres',
        'keterangan',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
