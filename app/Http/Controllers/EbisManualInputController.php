<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EbisManualInput;
use App\Helpers\DropdownHelper;

class EbisManualInputController extends Controller
{
    /**
     * TAMPILKAN FORM + TABLE
     */
    public function index()
    {
        // dropdown
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
     * SIMPAN DATA
     */
    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'nde_jt'            => 'required|string|max:50',
            'star_click_id'     => 'required|string|max:50',
            'nama_customer'     => 'required|string|max:255',
            'alamat_pelanggan'  => 'nullable|string|max:255',
            'telepon_pelanggan' => 'nullable|string|max:30',
            'tikor_pelanggan'   => 'nullable|string|max:50',
            'datel'             => 'required|string|max:50',
            'sto'               => 'required|string|max:50', 
        ]);

        // ✅ SIMPAN DATA
        EbisManualInput::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Data berhasil disimpan');
    }
}
