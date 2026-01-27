<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EbisManualInput;
use App\Models\EbisPlanningOrder;
use App\Helpers\DropdownHelper;

class EbisManualInputController extends Controller
{
    /**
     * =============================
     * INPUT DATA (SEMUA MANUAL)
     * =============================
     */
    public function index()
    {
        $datels = DropdownHelper::datels();
        $stos   = DropdownHelper::stos();

        $rows = EbisManualInput::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('deployment.input', compact(
            'datels',
            'stos',
            'rows'
        ));
    }

    /**
     * =============================
     * SIMPAN DATA MANUAL
     * =============================
     */
   public function store(Request $request)
{
    $validated = $request->validate(
        [
            'nde_jt' => 'nullable|string|max:255',
            'star_click_id'     => 'required|string|max:50',
            'nama_customer'     => 'required|string|max:255',
            'nama_mitra'        => 'required|string|max:255',
            'alamat_pelanggan'  => 'nullable|string|max:255',
            'telepon_pelanggan' => 'nullable|string|max:30',
            'tikor_pelanggan'   => 'nullable|string|max:50',
            'datel'             => 'required|string|max:50',
            'sto'               => 'required|string|max:50',
            'catatan'           => 'nullable|string',
        ],
        [
            'required' => 'attribute tidak boleh kosong',
        ],
        [
            'nde_jt'            => 'Nomor NDE JT',
            'star_click_id'     => 'Starclick ID / NCX',
            'nama_customer'     => 'Nama Pelanggan',
            'nama_mitra'        => 'Nama Mitra',
            'datel'             => 'Datel',
            'sto'               => 'STO',
        ]
    );

    EbisManualInput::create($validated);

    return redirect()->back()
        ->with('success', 'Data berhasil disimpan');
}


    /**
     * =============================
     * UPDATE DATA (LIST = REKAP)
     * =============================
     */
    public function updateList(Request $request)
    {
        
           $rows = EbisManualInput::with('planning')
        ->paginate(10);

        return view('deployment.update', compact('rows'));
    }

    /**
     * =============================
     * FORM EDIT DEPLOYMENT
     * =============================
     */
    public function edit($id)
    {
        $data = EbisManualInput::with('planning')->findOrFail($id);

        $datels = DropdownHelper::datels();
        $stos   = DropdownHelper::stos();

        return view('deployment.edit', compact(
            'data',
            'datels',
            'stos'
        ));
    }

    /**
     * =============================
     * UPDATE DATA DEPLOYMENT
     * (HANYA PLANNING)
     * =============================
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'progres' => 'nullable|string|max:50',
            'tanggal_update_progres' => 'nullable|date',
        ]);

        $manual = EbisManualInput::findOrFail($id);

        $planning = $manual->planning;
        if (!$planning) {
            $planning = new EbisPlanningOrder();
            $planning->ebis_manual_input_id = $manual->id;
        }

        $planning->progres = $validated['progres'] ?? $planning->progres;
        $planning->tanggal_update_progres =
            $validated['tanggal_update_progres']
            ?? $planning->tanggal_update_progres;

        $planning->save();

        return redirect()
            ->route('deployment.update')
            ->with('success', 'Data deployment berhasil diperbarui');
    }
}
