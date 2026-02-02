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
        EbisPlanningOrder::query()->delete();

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
            'nama_pengguna_melakukan_alokasi_alpro',
            'id_odp_alokasi_alpro',
            'nama_odp_alokasi_alpro',
            'reservation_id_alokasi_alpro',
            'username_nik_melakukan_alokasi_alpro',
            'sales_code',
            'segment',
            'cfu',
            'source_app',
            'regional',
            'witel',
            'witel_lama',
            'wok',
            'status_eproposal',
            'status_tomps',
            'status_sap',
            'status_proyek',
            'kode_program',
            'nama_proyek',
            'batch_program',
            'kategori',
            'tahun'
        ];

        $rows = EbisPlanningOrder::query()

            // 🔍 GLOBAL SEARCH (SEMUA KOLOM)
            ->when($request->search, function ($query) use ($request, $searchableColumns) {
                $query->where(function ($q) use ($request, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $q->orWhere($column, 'like', '%' . $request->search . '%');
                    }
                });
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        // ✅ AJAX → table saja
        if ($request->ajax()) {
            return view('deployment.partials.table', compact('rows'))->render();
        }

        // ✅ NORMAL → full page
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
    $query = EbisManualInput::with('planning');

    /**
     * =============================
     * FILTER DROPDOWN ATAS
     * =============================
     */
    if ($request->filled('star_click_id')) {
        $query->where('star_click_id', $request->star_click_id);
    }

    if ($request->filled('nama_customer')) {
        $query->where('nama_customer', 'like', '%' . $request->nama_customer . '%');
    }

    if ($request->filled('sto')) {
        $query->where('sto', $request->sto);
    }

    if (
        $request->filled('status_order') ||
        $request->filled('tipe_desain') ||
        $request->filled('jenis_program')
    ) {
        $query->whereHas('planning', function ($q) use ($request) {

            if ($request->filled('status_order')) {
                $q->where('status_order', $request->status_order);
            }

            if ($request->filled('tipe_desain')) {
                $q->where('tipe_desain', $request->tipe_desain);
            }

            if ($request->filled('jenis_program')) {
                $q->where('jenis_program', $request->jenis_program);
            }
        });
    }

    /**
     * =============================
     * CARI FILTERING (MULTIPLE)
     * =============================
     */
    $key = $request->filter_key;
    $values = array_filter(
        array_map('trim', explode(',', $request->filter_values ?? ''))
    );

    if ($key && !empty($values)) {

        $query->where(function ($q) use ($key, $values) {

            foreach ($values as $val) {

                // FIELD MANUAL INPUT
                if (in_array($key, ['sto', 'star_click_id', 'nama_customer'])) {
                    $q->orWhere($key, 'like', "%{$val}%");
                }

                // FIELD PLANNING
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

    /**
     * =============================
     * DROPDOWN FILTER DINAMIS
     * =============================
     */
    $filters = [
        'starclicks' => EbisManualInput::select('star_click_id')
            ->whereNotNull('star_click_id')
            ->distinct()
            ->pluck('star_click_id'),

        'nama_customers' => EbisManualInput::select('nama_customer')
            ->whereNotNull('nama_customer')
            ->distinct()
            ->pluck('nama_customer'),

        'stos' => EbisManualInput::select('sto')
            ->whereNotNull('sto')
            ->distinct()
            ->pluck('sto'),

        'status_orders' => EbisPlanningOrder::select('status_order')
            ->whereNotNull('status_order')
            ->distinct()
            ->pluck('status_order'),

        'tipe_desains' => EbisPlanningOrder::select('tipe_desain')
            ->whereNotNull('tipe_desain')
            ->distinct()
            ->pluck('tipe_desain'),

        'jenis_programs' => EbisPlanningOrder::select('jenis_program')
            ->whereNotNull('jenis_program')
            ->distinct()
            ->pluck('jenis_program'),
    ];

    /**
     * =============================
     * FINAL RESULT
     * =============================
     */
    $rows = $query->latest()
        ->paginate(10)
        ->withQueryString();

    return view('deployment.rekap', compact('rows', 'filters'));
}


}
