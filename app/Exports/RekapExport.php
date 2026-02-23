<?php

namespace App\Exports;

use App\Models\EbisManualInput;
use App\Models\EbisPlanningOrder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class RekapExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = EbisManualInput::with('planning');

        // FILTER DROPDOWN ATAS
        if ($this->request->filled('starclick')) {
            $query->where('star_click_id', $this->request->starclick);
        }

        if ($this->request->filled('nama')) {
            $query->where('nama_customer', 'like', '%' . $this->request->nama . '%');
        }

        if ($this->request->filled('sto')) {
            $query->where('sto', $this->request->sto);
        }

        if ($this->request->filled('status_order') || $this->request->filled('tipe_desain') || $this->request->filled('jenis_program')) {
            $query->whereHas('planning', function ($q) {
                if ($this->request->filled('status_order')) {
                    $q->where('status_order', $this->request->status_order);
                }

                if ($this->request->filled('tipe_desain')) {
                    $q->where('tipe_desain', $this->request->tipe_desain);
                }

                if ($this->request->filled('jenis_program')) {
                    $q->where('jenis_program', $this->request->jenis_program);
                }
            });
        }

        // CARI FILTERING (MULTIPLE)
        $key = $this->request->filter_key;
        $values = array_filter(array_map('trim', explode(',', $this->request->filter_values ?? '')));

        if ($key && !empty($values)) {
            $query->where(function ($q) use ($key, $values) {
                foreach ($values as $val) {
                    if ($key === 'star_click_id') {
                        $q->orWhere($key, $val);
                    } elseif (in_array($key, ['sto', 'nama_customer'])) {
                        $q->orWhere($key, 'like', "%{$val}%");
                    }

                    if (in_array($key, ['ihld_lop_id', 'status_order', 'tipe_desain', 'jenis_program'])) {
                        $q->orWhereHas('planning', function ($p) use ($key, $val) {
                            if ($key === 'ihld_lop_id') {
                                $p->where($key, $val);
                            } else {
                                $p->where($key, 'like', "%{$val}%");
                            }
                        });
                    }
                }
            });
        }

        return $query
            ->leftJoin('ebis_planning_orders', 'ebis_manual_inputs.star_click_id', '=', 'ebis_planning_orders.star_click_id')
            ->select('ebis_manual_inputs.*')
            ->orderBy('ebis_planning_orders.id', 'desc');
    }

    public function headings(): array
    {
        return [
            'NDE JT',
            'Starclick ID',
            'Nama',
            'Nama Mitra',
            'Alamat',
            'Telepon',
            'Tikor',
            'Datel',
            'STO',
            'Status Alokasi',
            'Status Order',
            'iHLD LoP ID',
            'Tipe Desain',
            'Total BOQ',
            'Jenis Program',
            'Nama CFU',
            'Progres',
            'Tanggal Update',
            'Catatan',
        ];
    }

    public function map($row): array
    {
        $planning = $row->planning;
        $date = optional($planning)->tanggal_update_progres ?? $row->tanggal_update_progres;

        return [
            $row->nde_jt ?? '-',
            $row->star_click_id ?? '-',
            $row->nama_customer ?? '-',
            $row->nama_mitra ?? '-',
            $row->alamat_pelanggan ?? '-',
            $row->telepon_pelanggan ?? '-',
            $row->tikor_pelanggan ?? '-',
            $row->datel ?? '-',
            $row->sto ?? '-',
            optional($planning)->status_alokasi_alpro ?? '-',
            optional($planning)->status_order ?? '-',
            optional($planning)->ihld_lop_id ?? '-',
            optional($planning)->tipe_desain ?? '-',
            optional($planning)->total_boq ? number_format(optional($planning)->total_boq, 0, ',', '.') : '-',
            optional($planning)->jenis_program ?? '-',
            optional($planning)->nama_cfu ?? '-',
            optional($planning)->progres ?? $row->progres ?? '-',
            $date ? Carbon::parse($date)->format('d-m-Y H:i') : '-',
            $row->keterangan ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'DC2626'],
                ],
            ],
        ];
    }
}
