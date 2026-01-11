<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EbisManualInput;

class EbisManualInputController extends Controller
{
    /**
     * TAMPILKAN FORM + TABLE
     */
    public function index()
    {
        // dropdown (sesuai enum di migration)
        $datels = [
            'CIREBON',
            'INDRAMAYU',
            'MAJALENGKA',
            'KUNINGAN',
            'SUBANG'
        ];

        $stos = [
            'ARJAWINANGUN','BALONGAN','CIREBON','CIKIJING','HAURGEULIS',
            'INDRAMAYU','JAMBLANG','JATIBARANG','JATIWANGI','KADIPATEN',
            'KANCI','KARANGAMPEL','KARYAMULIA','KUNINGAN','CILIMUS',
            'LOSARANG','LOSARI','MAJALENGKA','PABUARAN','PATROL',
            'PLERED','RAJAGALUH','SINDANGLAUT','SUBANG','JALANCAGAK',
            'PAMANUKAN','PAGADEN','KALIJATI','CIASEM'
        ];

        // data table
        $rows = EbisManualInput::latest()->get();

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
        EbisManualInput::create([
            'nde_jt'             => $request->nde_jt,
            'star_click_id'      => $request->star_click_id,
            'nama_customer'      => $request->nama_customer,
            'alamat_pelanggan'   => $request->alamat_pelanggan,
            'telepon_pelanggan'  => $request->telepon_pelanggan,
            'tikor_pelanggan'    => $request->tikor_pelanggan,
            'datel'              => $request->datel,
            'sto'                => $request->sto,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
