<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\EbisPlanningImport;
use App\Exports\EbisPlanningExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\EbisPlanningOrder;


class EbisPlanningController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new EbisPlanningImport, $request->file('file'));

        return back()->with('success', 'Data berhasil di-import');
    }

    public function export()
    {
        return Excel::download(
            new EbisPlanningExport,
            'ebis_planning_export.xlsx'
        );
    }
    public function index()
{
    $rows = EbisPlanningOrder::select(
        'star_click_id',
        'track_id',
        'status_alokasi_alpro',
        'datel',
        'sto',
        'nama_customer',
        'status_order',
        'ihld_lop_id',
        'tipe_desain',
        'total_boq',
        'jenis_program',
        'nama_cfu'
    )->latest()->paginate(400);

    return view('deployment.upload', compact('rows'));
}
}
