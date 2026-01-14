<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\EbisPlanningImport;
use App\Exports\EbisPlanningExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\EbisPlanningOrder;
use App\Helpers\DropdownHelper;

class EbisPlanningController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new EbisPlanningImport(), $request->file('file'));

        return back()->with('success', 'Data berhasil di-import');
    }

    public function export()
    {
        return Excel::download(new EbisPlanningExport(), 'ebis_planning_export.xlsx');
    }
    public function index()
    {
        $rows = EbisPlanningOrder::select(
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
            'status_tomps_last_update',
            'status_sap',
            'status_proyek',
            'odp_go_live',
            'tanggal_waiting_caring',
            'tanggal_submitted_to_eproposal',
            'tanggal_inisiasi_tomps',
            'tanggal_validasi_abd_tomps',
            'tanggal_go_live_tomps',
            'created_at',
            'updated_at',
            'deleted_at',
            'ditambahkan_pada',
            'username_nik_pembuat',
            'kategori_mitra',
            'nama_mitra',
            'revenue_plan',
            'nama_cfu',
            'tahun',
            'jenis_program',
        )
            ->latest()
            ->paginate(500);

        return view('deployment.upload', compact('rows'));
    }

    public function updateList()
    {
        $rows = EbisPlanningOrder::latest()->get();
        return view('deployment.update', compact('rows'));
    }

    public function edit($id)
    {
        $data = EbisPlanningOrder::findOrFail($id);

        $datels = DropdownHelper::datels();
        $stos = DropdownHelper::stos();

        return view('deployment.edit', compact('data', 'datels', 'stos'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'track_id' => 'required|string|max:100',
            'datel' => 'required|string|max:50',
            'sto' => 'required|string|max:50',
            'status_order' => 'required|string|max:50',
            'tipe_desain' => 'required|string|max:50',
            'jenis_program' => 'required|string|max:50',
        ]);

        EbisPlanningOrder::where('id', $id)->update($validated);

        return redirect()->route('deployment.update.list')->with('success', 'Data berhasil diperbarui');
    }
}
