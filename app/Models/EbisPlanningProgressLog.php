<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbisPlanningProgressLog extends Model
{
    protected $fillable = [
        'ebis_planning_order_id',
        'user_id',
        'progres',
        'keterangan',
        'data',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function planning()
    {
        return $this->belongsTo(EbisPlanningOrder::class, 'ebis_planning_order_id');
    }

    protected $casts = [
        'data' => 'array',
    ];
}
