@extends('layouts.app')

@section('title', 'Input Data')

@section('content')

<!-- BREADCRUMB (POJOK KIRI ATAS) -->
<div class="mb-6 flex items-center gap-4 text-lg text-slate-500">
    <a href="{{ route('dashboard') }}"
        class="flex items-center gap-2 hover:text-red-600 transition">
        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-6 h-6 text-slate-400"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5" />
        </svg>
    </a>

    <span class="text-slate-400">›</span>

    <a href="{{ route('deployment.b2b') }}"
        class="font-medium hover:text-red-600 transition">
        B2B
    </a>

    <span class="text-slate-400">›</span>

    <span class="font-semibold text-slate-800">Input</span>
</div>

<!-- FORM (CENTER) -->
<div class="flex justify-center">

    <div class="bg-white rounded-xl shadow-sm p-6 w-full max-w-3xl">

        <form class="space-y-4">

            <!-- NDE JT -->
            <div>
                <label class="text-xs text-slate-500 block mb-1">Nomor NDE JT</label>
                <input type="text" placeholder="Nomor NDE JT"
                    class="w-full rounded-lg border px-3 py-2 text-sm
                    focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>

            <!-- STARCILCK -->
            <div>
                <label class="text-xs text-slate-500 block mb-1">Starclick ID / NCX</label>
                <input type="text" placeholder="Starclick ID / NCX"
                    class="w-full rounded-lg border px-3 py-2 text-sm
                    focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>

        
            <!-- NAMA -->
            <div>
                <label class="text-xs text-slate-500 block mb-1">Nama Pelanggan</label>
                <input type="text" placeholder="Nama Pelanggan"
                    class="w-full rounded-lg border px-3 py-2 text-sm
                    focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>

            <!-- ALAMAT -->
            <div>
                <label class="text-xs text-slate-500 block mb-1">Alamat Pelanggan</label>
                <input type="text" placeholder="Alamat Pelanggan"
                    class="w-full rounded-lg border px-3 py-2 text-sm
                    focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>

            <!-- TELEPON -->
            <div>
                <label class="text-xs text-slate-500 block mb-1">Telepon Pelanggan</label>
                <input type="text" placeholder="Telepon Pelanggan"
                    class="w-full rounded-lg border px-3 py-2 text-sm
                    focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>

            <!-- TIKOR -->
            <div>
                <label class="text-xs text-slate-500 block mb-1">Tikor Pelanggan</label>
                <input type="text" placeholder="Tikor Pelanggan"
                    class="w-full rounded-lg border px-3 py-2 text-sm
                    focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>

            <!-- DATEL & STO -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-slate-500 block mb-1">Datel</label>
                    <select class="w-full rounded-lg border px-3 py-2 text-sm">
                        <option selected disabled>Pilih Datel</option>
                        <option>CIREBON</option>
                        <option>INDRAMAYU</option>
                        <option>MAJALENGKA</option>
                        <option>KUNINGAN</option>
                        <option>SUBANG</option>
                    </select>
                </div>

                <div>
                    <label class="text-xs text-slate-500 block mb-1">STO</label>
                    <select class="w-full rounded-lg border px-3 py-2 text-sm">
                        <option selected disabled>Pilih STO</option>
                        <option>ARJAWINANGUN</option>
                        <option>BALONGAN</option>
                        <option>CIREBON</option>
                    </select>
                </div>
            </div>

            <!-- SUBMIT -->
            <button
                class="w-full mt-4 bg-red-600 hover:bg-red-700
                text-white text-sm font-medium py-2 rounded-lg transition">
                Submit
            </button>

        </form>

    </div>
</div>

@endsection
