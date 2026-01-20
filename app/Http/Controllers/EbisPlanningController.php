<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\EbisPlanningImport;
use App\Exports\EbisPlanningExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\EbisPlanningOrder;
use App\Models\EbisManualInput;
use App\Helpers\DropdownHelper;
use DB;

class EbisPlanningController extends Controller
{
    /**
     * =============================
     * IMPORT EXCEL (REPLACE DATA)
     * =============================
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        EbisPlanningOrder::truncate();

        Excel::import(new EbisPlanningImport(), $request->file('file'));

        return back()->with('success', 'Data lama berhasil diganti dengan data baru');
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
     * LIST DATA UPLOAD + FILTER
     * =============================
     */
    public function index(Request $request)
    {
        $searchableColumns = [
            'star_click_id',
            'track_id',
            'ticket_id',
            'nama_customer',
            'status_order',
            'tipe_desain',
            'jenis_program',
            'datel',
            'sto',
            'nama_pengguna_melakukan_alokasi_alpro'
        ];
        $rows = EbisPlanningOrder::query()

            // =============================
            // GLOBAL SEARCH (MULTI KOLOM)
            // =============================
            ->when($request->search, function ($query) use ($request, $searchableColumns) {
                $keywords = preg_split('/[\s,]+/', $request->search, -1, PREG_SPLIT_NO_EMPTY);

                // 2. Setiap keyword WAJIB cocok
                foreach ($keywords as $keyword) {
                    $query->where(function ($q) use ($keyword, $searchableColumns) {
                        foreach ($searchableColumns as $column) {
                            $q->orWhere($column, 'like', "%{$keyword}%");
                        }
                    });
                }
            })

            // =============================
            // FILTERING (SPESIFIK)
            // =============================
            ->when($request->star_click_id, function ($q) use ($request) {
                $q->where('star_click_id', 'like', '%' . $request->star_click_id . '%');
            })

            ->when($request->track_id, function ($q) use ($request) {
                $q->where('track_id', 'like', '%' . $request->track_id . '%');
            })

            ->when($request->nama_customer, function ($q) use ($request) {
                $q->where('nama_customer', 'like', '%' . $request->nama_customer . '%');
            })

            ->when($request->datel, function ($q) use ($request) {
                $q->where('datel', $request->datel);
            })

            ->when($request->sto, function ($q) use ($request) {
                $q->where('sto', $request->sto);
            })

            ->when($request->status_order, function ($q) use ($request) {
                $q->where('status_order', 'like', '%' . $request->status_order . '%');
            })

            ->when($request->tipe_desain, function ($q) use ($request) {
                $q->where('tipe_desain', 'like', '%' . $request->tipe_desain . '%');
            })

            ->when($request->jenis_program, function ($q) use ($request) {
                $q->where('jenis_program', 'like', '%' . $request->jenis_program . '%');
            })

            ->when($request->progres, function ($q) use ($request) {
                $q->where('progres', $request->progres);
            })

            // =============================
            // SORT + PAGINATION
            // =============================
            ->latest()
            ->paginate(5)
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
        ->paginate(5);

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
