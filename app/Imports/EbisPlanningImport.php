<?php

namespace App\Imports;

use App\Models\EbisPlanningOrder;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EbisPlanningImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new EbisPlanningOrder([
            'star_click_id' => $row['star_click_id'],
            'track_id' => $row['track_id'],
            'ticket_id' => $row['ticket_id'],
            'star_click_status' => $row['star_click_status'],
            'status_alokasi_alpro' => $row['status_alokasi_alpro'],
            'datel' => $row['datel'],
            'sto' => $row['sto'],
            'nama_customer' => $row['nama_customer'],
            'status_order' => $row['status_order'],
            'ihld_lop_id' => $row['ihld_lop_id'],
            'tipe_desain' => $row['tipe_desain'],
            'total_boq' => $row['total_boq'],
            'jenis_program' => $row['jenis_program'],
            'nama_cfu' => $row['nama_cfu'],
            
        ]);
    }
}
