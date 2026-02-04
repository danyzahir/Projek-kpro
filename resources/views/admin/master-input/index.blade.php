@extends('layouts.app')

@section('title', 'Master Input')

@section('content')
<h1 class="text-xl font-bold mb-6">Master Input</h1>

{{-- ================= NOTIFIKASI BERHASIL ================= --}}
@if(session('success'))
<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)"
    x-transition
    class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700">
    {{ session('success') }}
</div>
@endif

{{-- ================= NOTIFIKASI ERROR ================= --}}
@if($errors->any())
<div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700">
    <ul class="list-disc ml-5">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- ================= FORM INPUT ================= --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    <!-- DATEL -->
    <form method="POST" action="{{ route('admin.master-input.datel') }}">
        @csrf
        <h2 class="font-semibold mb-2">Datel</h2>
        <input name="nama_datel" class="border p-2 w-full mb-2 rounded" placeholder="Nama Datel">
        <button class="bg-red-600 text-white px-4 py-1 rounded">Tambah</button>
    </form>

    <!-- STO -->
    <form method="POST" action="{{ route('admin.master-input.sto') }}">
        @csrf
        <h2 class="font-semibold mb-2">STO</h2>
        <input name="nama_sto" class="border p-2 w-full mb-2 rounded" placeholder="Nama STO">
        <button class="bg-red-600 text-white px-4 py-1 rounded">Tambah</button>
    </form>

    <!-- MITRA -->
    <form method="POST" action="{{ route('admin.master-input.mitra') }}">
        @csrf
        <h2 class="font-semibold mb-2">Mitra</h2>
        <input name="nama_mitra" class="border p-2 w-full mb-2 rounded" placeholder="Nama Mitra">
        <button class="bg-red-600 text-white px-4 py-1 rounded">Tambah</button>
    </form>

</div>

{{-- ================= DATA MASTER (HORIZONTAL) ================= --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- ================= DATEL ================= --}}
    <div class="bg-white rounded-xl shadow border border-slate-200 p-4">
        <h3 class="font-semibold mb-3 text-center">Datel</h3>

        <table class="w-full text-sm border border-slate-200">
            <thead class="bg-slate-100">
                <tr>
                    <th class="border px-2 py-1 w-12 text-center">No</th>
                    <th class="border px-2 py-1">Nama</th>
                </tr>
            </thead>
            <tbody>
                @forelse($datels as $i => $datel)
                <tr>
                    <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                    <td class="border px-2 py-1">{{ $datel->nama_datel }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="border px-2 py-3 text-center text-slate-500">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ================= STO ================= --}}
    <div class="bg-white rounded-xl shadow border border-slate-200 p-4">
        <h3 class="font-semibold mb-3 text-center">STO</h3>

        <table class="w-full text-sm border border-slate-200">
            <thead class="bg-slate-100">
                <tr>
                    <th class="border px-2 py-1 w-12 text-center">No</th>
                    <th class="border px-2 py-1">Nama</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stos as $i => $sto)
                <tr>
                    <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                    <td class="border px-2 py-1">{{ $sto->nama_sto }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="border px-2 py-3 text-center text-slate-500">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ================= MITRA ================= --}}
    <div class="bg-white rounded-xl shadow border border-slate-200 p-4">
        <h3 class="font-semibold mb-3 text-center">Mitra</h3>

        <table class="w-full text-sm border border-slate-200">
            <thead class="bg-slate-100">
                <tr>
                    <th class="border px-2 py-1 w-12 text-center">No</th>
                    <th class="border px-2 py-1">Nama</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mitras as $i => $mitra)
                <tr>
                    <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                    <td class="border px-2 py-1">{{ $mitra->nama_mitra }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="border px-2 py-3 text-center text-slate-500">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>


@endsection
