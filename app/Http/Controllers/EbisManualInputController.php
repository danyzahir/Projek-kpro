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
        $mitras = DropdownHelper::mitras();

        $rows = EbisManualInput::orderBy('created_at', 'desc')->paginate(10);

        return view('deployment.input', compact('datels', 'stos', 'rows', 'mitras'));
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
                 'link_dokumen' => 'nullable|string', 
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
    /**
     * =============================
     * QUERY UTAMA
     * =============================
     */
    $rows = EbisManualInput::with('planning');

    /**
     * =============================
     * FILTER DARI FORM
     * =============================
     */
    if ($request->filled('star_click_id')) {
        $rows->where('star_click_id', $request->star_click_id);
    }

    if ($request->filled('nama_customer')) {
        $rows->where('nama_customer', 'like', '%' . $request->nama_customer . '%');
    }

    if ($request->filled('sto')) {
        $rows->where('sto', $request->sto);
    }

    // FILTER DARI RELASI PLANNING
    if (
        $request->filled('status_order') ||
        $request->filled('tipe_desain') ||
        $request->filled('jenis_program')
    ) {
        $rows->whereHas('planning', function ($q) use ($request) {

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

    // PAGINATION (HARUS PALING BAWAH)
    $rows = $rows->paginate(10)->withQueryString();

    /**
     * =============================
     * DROPDOWN FILTER DINAMIS
     * (DIAMBIL DARI DATA TABEL)
     * =============================
     */
    $filters = [
        // dari tabel manual input
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

        // dari relasi planning
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

    return view('deployment.update', compact('rows', 'filters'));
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
