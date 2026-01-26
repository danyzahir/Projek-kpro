<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\EbisPlanningImport;
use App\Exports\EbisPlanningExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\EbisPlanningOrder;
use App\Models\EbisManualInput;
use App\Helpers\DropdownHelper;
use Maatwebsite\Excel\Validators\ValidationException;
use DB;

class EbisPlanningController extends Controller
{
    /**
     * =============================
     * IMPORT EXCEL (STRICT HEADER)
     * =============================
     */
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls',
    ]);

    // Hapus data lama
    EbisPlanningOrder::truncate();

    // Import
    Excel::import(new EbisPlanningImport(), $request->file('file'));

    // CEK APAKAH ADA DATA VALID
    $validData = EbisPlanningOrder::whereNotNull('star_click_id')
        ->orWhereNotNull('track_id')
        ->orWhereNotNull('ticket_id')
        ->orWhereNotNull('nama_customer')
        ->count();

    // ❌ JIKA TIDAK ADA DATA VALID
    if ($validData === 0) {
        EbisPlanningOrder::truncate(); // bersihin lagi

        return redirect()
            ->route('deployment.upload')
            ->with('error', 'Import ditolak! Data tidak sesuai.');
    }

    // ✅ JIKA ADA DATA VALID
    return redirect()
        ->route('deployment.upload')
        ->with('success', 'Import berhasil. Data lama diganti dengan data baru.');
}

    /**
     * =============================
     * EXPORT EXCEL
     * =============================
     */
    public function export()
    {
        return Excel::download(new EbisPlanningExport(), 'ebis_planning_export.xlsx');
    }

    /**
     * =============================
     * LIST DATA UPLOAD
     * =============================
     */
    public function index(Request $request)
    {
        $rows = EbisPlanningOrder::latest()
            ->paginate(10)
            ->withQueryString();

        return view('deployment.upload', compact('rows'));
    }


    /**
     * =============================
     * LIST UPDATE DATA
     * =============================
     */
    public function updateList(Request $request)
    {
        $rows = EbisPlanningOrder::select([
            'id',
            'star_click_id',
            'nama_customer',
            'datel',
            'sto',
            'status_order',
            'tipe_desain',
            'progres'
        ])
            ->where(function ($q) {
                $q->whereNull('progres')
                    ->orWhere('progres', '-');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('deployment.update', compact('rows'));
    }



    /**
     * =============================
     * FORM EDIT
     * =============================
     */
    public function edit($id)
    {
        $data = EbisPlanningOrder::findOrFail($id);

        $datels = DropdownHelper::datels();
        $stos = DropdownHelper::stos();

        return view('deployment.edit', compact('data', 'datels', 'stos'));
    }

    /**
     * =============================
     * UPDATE DATA
     * =============================
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'track_id' => 'required|string|max:100',
            'datel' => 'required|string|max:50',
            'sto' => 'required|string|max:50',
            'status_order' => 'required|string|max:50',
            'tipe_desain' => 'required|string|max:50',
            'jenis_program' => 'nullable|string|max:50',
            'progres' => 'nullable|string|max:30',
            'tanggal_update_progres' => 'nullable|date',
        ]);

        EbisPlanningOrder::where('id', $id)->update($validated);

        return redirect()->route('deployment.update.list')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * =============================
     * REKAP DATA (MANUAL + UPLOAD)
     * =============================
     */
    public function rekap(Request $request)
    {
        $rows = EbisManualInput::with('planning')

            ->when($request->star_click_id, function ($q) use ($request) {
                $q->where('star_click_id', 'like', '%' . $request->star_click_id . '%');
            })

            ->when($request->nama_customer, function ($q) use ($request) {
                $q->where('nama_customer', 'like', '%' . $request->nama_customer . '%');
            })

            ->when($request->sto, function ($q) use ($request) {
                $q->where('sto', 'like', '%' . $request->sto . '%');
            })

            ->when(
                $request->status_order || $request->tipe_desain || $request->jenis_program,
                function ($q) use ($request) {
                    $q->whereHas('planning', function ($p) use ($request) {

                        if ($request->status_order) {
                            $p->where('status_order', 'like', '%' . $request->status_order . '%');
                        }

                        if ($request->tipe_desain) {
                            $p->where('tipe_desain', 'like', '%' . $request->tipe_desain . '%');
                        }

                        if ($request->jenis_program) {
                            $p->where('jenis_program', 'like', '%' . $request->jenis_program . '%');
                        }
                    });
                }
            )

            ->latest()
            ->paginate(10)
            ->withQueryString();


        $totalOrders = EbisPlanningOrder::count();

        $ordersByStatus = EbisPlanningOrder::select(
            'status_order',
            DB::raw('count(*) as total')
        )
            ->groupBy('status_order')
            ->get();

        return view('deployment.rekap', compact(
            'rows',
            'totalOrders',
            'ordersByStatus'
        ));
    }
}
