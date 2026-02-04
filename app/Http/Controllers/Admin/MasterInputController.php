<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterDatel;
use App\Models\MasterSto;
use App\Models\MasterMitra;

class MasterInputController extends Controller
{
    public function index()
    {
        return view('admin.master-input.index', [
            'datels' => MasterDatel::orderBy('nama_datel')->get(),
            'stos'   => MasterSto::orderBy('nama_sto')->get(),
            'mitras' => MasterMitra::orderBy('nama_mitra')->get(),
        ]);
    }

    public function storeDatel(Request $request)
    {
        $request->validate([
            'nama_datel' => 'required|string|max:100|unique:master_datels,nama_datel'
        ]);

        MasterDatel::create([
            'nama_datel' => strtoupper($request->nama_datel)
        ]);

        return back()->with('success', 'Datel berhasil ditambahkan');
    }

    public function storeSto(Request $request)
    {
        $request->validate([
            'nama_sto' => 'required|string|max:100|unique:master_stos,nama_sto'
        ]);

        MasterSto::create([
            'nama_sto' => strtoupper($request->nama_sto)
        ]);

        return back()->with('success', 'STO berhasil ditambahkan');
    }

    public function storeMitra(Request $request)
    {
        $request->validate([
            'nama_mitra' => 'required|string|max:150|unique:master_mitras,nama_mitra'
        ]);

        MasterMitra::create([
            'nama_mitra' => strtoupper($request->nama_mitra)
        ]);

        return back()->with('success', 'Mitra berhasil ditambahkan');
    }
}
