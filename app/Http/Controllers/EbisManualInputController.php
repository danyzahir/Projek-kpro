<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EbisManualInput;
use App\Models\EbisPlanningOrder;
use App\Helpers\DropdownHelper;
use App\Models\EbisPlanningProgressLog;
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
        $stos = DropdownHelper::stos();

        $rows = EbisManualInput::orderBy('created_at', 'desc')->paginate(10);

        return view('deployment.input', compact('datels', 'stos', 'rows'));
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
                'star_click_id' => 'required|string|max:50',
                'nama_customer' => 'required|string|max:255',
                'nama_mitra' => 'required|string|max:255',
                'alamat_pelanggan' => 'nullable|string|max:255',
                'telepon_pelanggan' => 'nullable|string|max:30',
                'tikor_pelanggan' => 'nullable|string|max:50',
                'datel' => 'required|string|max:50',
                'sto' => 'required|string|max:50',
                'catatan' => 'nullable|string',
            ],
            [
                'required' => 'attribute tidak boleh kosong',
            ],
            [
                'nde_jt' => 'Nomor NDE JT',
                'star_click_id' => 'Starclick ID / NCX',
                'nama_customer' => 'Nama Pelanggan',
                'nama_mitra' => 'Nama Mitra',
                'datel' => 'Datel',
                'sto' => 'STO',
            ],
        );

        EbisManualInput::create($validated);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * =============================
     * UPDATE DATA (LIST = REKAP)
     * =============================
     */
    public function updateList(Request $request)
    {
        $rows = EbisManualInput::with('planning')->paginate(10);

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
        $stos = DropdownHelper::stos();

        return view('deployment.edit', compact('data', 'datels', 'stos'));
    }

    /**
     * =============================
     * UPDATE DATA DEPLOYMENT
     * (HANYA PLANNING)
     * =============================
     */
    public function update(Request $request, $id)
    {
        // =================================
        // 1️⃣ VALIDASI (DASAR + DINAMIS)
        // =================================
        $rules = [
            'progres' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ];

        if ($request->progres === 'PERIJINAN') {
            $rules['evidence_perijinan'] = 'required|image|max:2048';
        }

        if ($request->progres === 'INSTALASI') {
            $rules['evidence_instalasi'] = 'required|image|max:2048';
        }

        if ($request->progres === 'SELESAI FISIK') {
            $rules['evidence_selesai_fisik'] = 'required|image|max:2048';
        }

        if ($request->progres === 'GOLIVE') {
            $rules['nama_odp'] = 'required|string|max:100';
            $rules['id_smallworld'] = 'required|string|max:100';
        }

        if ($request->progres === 'PS') {
            $rules['nomor_order_ps'] = 'required|string|max:100';
            $rules['tanggal_ps'] = 'required|date';
        }

        if ($request->progres === 'KENDALA') {
            $rules['jenis_kendala'] = 'required|string|max:100';
        }

        $request->validate($rules);

        // =================================
        // 2️⃣ AMBIL DATA MANUAL
        // =================================
        $manual = EbisManualInput::findOrFail($id);
        $planning = $manual->planning;

        if (!$planning) {
            $planning = new EbisPlanningOrder();
            $planning->ebis_manual_input_id = $manual->id;
            $planning->progres = $request->progres;
            $planning->tanggal_update_progres = now();
            $planning->data = [];
            $planning->save();
        }

        // =================================
        // 3️⃣ DATA DINAMIS (TEXT / NUMBER)
        // =================================
        $data = $request->except(['_token', '_method', 'progres', 'keterangan']);

        // =================================
        // 4️⃣ HANDLE UPLOAD FILE
        // =================================
        foreach ($request->allFiles() as $key => $file) {
            if ($file->isValid()) {
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('deployment/' . $request->progres, $filename, 'public');

                $data[$key] = $path;
            }
        }

        // =================================
        // 5️⃣ UPDATE DATA TERAKHIR (STATUS SAAT INI)
        // =================================
        $manual->update([
            'progres' => $request->progres,
            'keterangan' => $request->keterangan,
            'data' => $data,
            'tanggal_update_progres' => now(), // realtime
        ]);

        // =================================
        // 6️⃣ SIMPAN RIWAYAT PROGRES (LOG 🔥)
        // =================================
        EbisPlanningProgressLog::create([
            'ebis_planning_order_id' => $planning->id,
            'progres' => $request->progres,
            'keterangan' => $request->keterangan,
            'data' => $data,
        ]);

        return redirect()->route('deployment.update')->with('success', 'Progress deployment berhasil diperbarui');
    }
}
