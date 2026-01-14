<?php

namespace App\Imports;

use App\Models\EbisPlanningOrder;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class EbisPlanningImport implements ToModel, WithHeadingRow
{
    /**
     * Bersihkan kolom DATE
     * support:
     * - null / kosong / "-"
     * - string tanggal
     * - numeric tanggal Excel
     */
    private function cleanDate($value)
    {
        if ($value === null || $value === '' || $value === '-') {
            return null;
        }

        try {
            // Kalau numeric (tanggal bawaan Excel)
            if (is_numeric($value)) {
                return Carbon::instance(
                    ExcelDate::excelToDateTimeObject($value)
                )->format('Y-m-d');
            }

            // Kalau string
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Bersihkan kolom ANGKA (INT / DECIMAL)
     */
    private function cleanNumber($value)
    {
        if ($value === null || $value === '' || $value === '-') {
            return null;
        }

        $value = str_replace(',', '', $value);
        return is_numeric($value) ? $value : null;
    }

    public function model(array $row)
    {
        return new EbisPlanningOrder([

            // =====================
            // IDENTITAS
            // =====================
            'star_click_id' => $row['star_click_id'] ?? null,
            'track_id' => $row['track_id'] ?? null,
            'ticket_id' => $row['ticket_id'] ?? null,
            'star_click_status' => $row['star_click_status'] ?? null,
            'status_alokasi_alpro' => $row['status_alokasi_alpro'] ?? null,
            'id_odp_alokasi_alpro' => $row['id_odp_alokasi_alpro'] ?? null,
            'nama_odp_alokasi_alpro' => $row['nama_odp_alokasi_alpro'] ?? null,
            'reservation_id_alokasi_alpro' => $row['reservation_id_alokasi_alpro'] ?? null,

            // =====================
            // ALOKASI ALPRO
            // =====================
            'nama_pengguna_melakukan_alokasi_alpro'
                => $row['nama_pengguna_melakukan_alokasi_alpro'] ?? null,

            'username_nik_melakukan_alokasi_alpro'
                => $row['username_nik_melakukan_alokasi_alpro'] ?? null,

            // =====================
            // KOORDINAT
            // =====================
            'latitude' => $this->cleanNumber($row['latitude'] ?? null),
            'longitude' => $this->cleanNumber($row['longitude'] ?? null),

            // =====================
            // UMUM
            // =====================
            'sales_code' => $row['sales_code'] ?? null,
            'remark' => $row['remark'] ?? null,
            'segment' => $row['segment'] ?? null,
            'cfu' => $row['cfu'] ?? null,
            'source_app' => $row['source_app'] ?? null,

            // =====================
            // DATE
            // =====================
            'disurvey_pada' => $this->cleanDate($row['disurvey_pada'] ?? null),
            'estimasi_go_live' => $this->cleanDate($row['estimasi_go_live'] ?? null),
            'real_go_live' => $this->cleanDate($row['real_go_live'] ?? null),
            'initial_date' => $this->cleanDate($row['initial_date'] ?? null),
            'finish_install_date' => $this->cleanDate($row['finish_install_date'] ?? null),

            // =====================
            // LOKASI
            // =====================
            'regional' => $row['regional'] ?? null,
            'witel' => $row['witel'] ?? null,
            'witel_lama' => $row['witel_lama'] ?? null,
            'datel' => $row['datel'] ?? null,
            'sto' => $row['sto'] ?? null,
            'wok' => $row['wok'] ?? null,

            // =====================
            // CUSTOMER
            // =====================
            'nama_customer' => $row['nama_customer'] ?? null,
            'telkomsel_area' => $row['telkomsel_area'] ?? null,
            'telkomsel_regional' => $row['telkomsel_regional'] ?? null,
            'telkomsel_branch' => $row['telkomsel_branch'] ?? null,
            'telkomsel_cluster' => $row['telkomsel_cluster'] ?? null,

            // =====================
            // STATUS
            // =====================
            'status_order' => $row['status_order'] ?? null,
            'validasi_planning' => $row['validasi_planning'] ?? null,
            'ihld_lop_id' => $row['ihld_lop_id'] ?? null,
            'eproposal_lop_id' => $row['eproposal_lop_id'] ?? null,
            'eproposal_lop_parent_id' => $row['eproposal_lop_parent_id'] ?? null,
            'kode_program' => $row['kode_program'] ?? null,
            'nama_proyek' => $row['nama_proyek'] ?? null,
            'tipe_desain' => $row['tipe_desain'] ?? null,

            // =====================
            // ANGKA
            // =====================
            'total_boq' => $this->cleanNumber($row['total_boq'] ?? null),
            'capex_per_port' => $this->cleanNumber($row['capex_per_port'] ?? null),
            'odp_total' => $this->cleanNumber($row['odp_total'] ?? null),
            'total_port' => $this->cleanNumber($row['total_port'] ?? null),
            'batch_program' => $row['batch_program'] ?? null,

            // =====================
            // STATUS LANJUTAN
            // =====================
            'status_eproposal' => $row['status_eproposal'] ?? null,
            'status_tomps' => $row['status_tomps'] ?? null,
            'status_tomps_last_activity' => $row['status_tomps_last_activity'] ?? null,
            'status_sap' => $row['status_sap'] ?? null,
            'status_proyek' => $row['status_proyek'] ?? null,

            // =====================
            // DATE LANJUTAN
            // =====================
            'odp_go_live' => $row['odp_go_live'] ?? null,
            'tanggal_waiting_caring' => $this->cleanDate($row['tanggal_waiting_caring'] ?? null),
            'tanggal_submitted_to_eproposal'=>$row['tanggal_submitted_to_eproposal'] ?? null,
            'tanggal_inisiasi_tomps' => $this->cleanDate($row['tanggal_inisiasi_tomps'] ?? null),
            'tanggal_validasi_abd_tomps' =>$row['tanggal_validasi_abd_tomps'] ?? null,
            'tanggal_go_live_tomps' => $row['tanggal_go_live_tomps'] ?? null,

            // =====================
            // META
            // =====================
            'ditambahkan_pada' => $this->cleanDate($row['ditambahkan_pada'] ?? null),
            'username_nik_pembuat' => $row['username_nik_pembuat'] ?? null,
            'kategori_mitra' => $row['kategori_mitra'] ?? null,
            'nama_mitra' => $row['nama_mitra'] ?? null,
            'revenue_plan' => $this->cleanNumber($row['revenue_plan'] ?? null),
            'nama_cfu' => $row['nama_cfu'] ?? null,
            'jenis_program' => $row['jenis_program'] ?? null,

            // =====================
            // TAHUN & KATEGORI (FINAL)
            // =====================
            'tahun' => $this->cleanNumber($row['tahun'] ?? null),
            'kategori' => $row['kategori'] ?? null,
        ]);
    }
}
