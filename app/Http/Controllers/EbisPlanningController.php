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
    )->latest()->paginate(500);

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
    $stos   = DropdownHelper::stos();

    return view('deployment.edit', compact(
        'data',
        'datels',
        'stos'
    ));
}


public function update(Request $request, $id)
{
    $validated = $request->validate([
        'track_id'      => 'required|string|max:100',
        'datel'         => 'required|string|max:50',
        'sto'           => 'required|string|max:50',
        'status_order'  => 'required|string|max:50',
        'tipe_desain'   => 'required|string|max:50',
        'jenis_program' => 'required|string|max:50',
    ]);

    EbisPlanningOrder::where('id', $id)->update($validated);

    return redirect()
        ->route('deployment.update.list')
        ->with('success', 'Data berhasil diperbarui');
}

public function rekap(Request $request)
{
    $data = collect([
        [
            'nde' => 'NDE-001',
            'starclick' => 'SC-101',
            'track_id' => 'TRK-1001',
            'nama' => 'Pelanggan 1',
            'sto' => 'ARJAWINANGUN',
            'status_order' => 'Completed Order PT1',
            'tipe_desain' => 'PT2-AERIAL',
            'jenis_program' => 'EBIS-DBS',
        ],
    ]);

    $filtered = $data->filter(function ($item) use ($request) {
        return
            (!$request->starclick || str_contains($item['starclick'], $request->starclick)) &&
            (!$request->nama || str_contains(strtolower($item['nama']), strtolower($request->nama))) &&
            (!$request->status_order || $item['status_order'] == $request->status_order) &&
            (!$request->tipe_desain || $item['tipe_desain'] == $request->tipe_desain) &&
            (!$request->jenis_program || $item['jenis_program'] == $request->jenis_program) &&
            (!$request->sto || $item['sto'] == $request->sto);
    });

    return view('deployment.rekap', compact('filtered'));
}


}
