@extends('layouts.app')

@section('title', 'Edit Data Deployment')

@section('content')
    <div class="flex flex-col gap-6">

        <!-- ================= BREADCRUMB ================= -->
        <div class="flex items-center gap-3 text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition">Dashboard</a>
            <span>›</span>
            <a href="{{ route('deployment.update') }}" class="hover:text-red-600 transition">Update Data</a>
            <span>›</span>
            <span class="font-semibold text-slate-800">Edit</span>
        </div>

        <!-- ================= PAGE HEADER ================= -->
        <div>
            <h1 class="text-xl font-semibold text-slate-800">Edit Data Deployment</h1>
            <p class="text-sm text-slate-500">
                Perbarui progres dan informasi deployment
            </p>
        </div>

        <!-- ================= FORM ================= -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

            <form action="{{ route('deployment.update.process', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- ================= DATA PELANGGAN ================= -->
                <h2 class="text-sm font-semibold text-slate-700 mb-4">Data Pelanggan</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    <!-- TIDAK BISA DIUBAH -->
                    <div>
                        <label class="block text-sm font-medium">Starclick / NCX</label>
                        <input type="text" value="{{ $data->star_click_id }}" readonly
                            title="Field ini tidak dapat diubah"
                            class="w-full mt-1 rounded-lg bg-slate-100 border px-3 py-2
                               text-slate-500 cursor-not-allowed">
                    </div>

                    <!-- TIDAK BISA DIUBAH -->
                    <div>
                        <label class="block text-sm font-medium">Nama Pelanggan</label>
                        <input type="text" value="{{ $data->nama_customer }}" readonly
                            title="Field ini tidak dapat diubah"
                            class="w-full mt-1 rounded-lg bg-slate-100 border px-3 py-2
                               text-slate-500 cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">
                            Datel <span class="text-red-600">*</span>
                        </label>

                        <select name="datel" required class="w-full rounded-lg border px-3 py-2 text-sm">
                            <option value="" disabled>-- Pilih Datel --</option>

                            @foreach ($datels as $d)
                                <option value="{{ $d }}"
                                    {{ old('datel', $data->datel) == $d ? 'selected' : '' }}>
                                    {{ $d }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">
                            STO <span class="text-red-600">*</span>
                        </label>

                        <select name="sto" required class="w-full rounded-lg border px-3 py-2 text-sm">
                            <option value="" disabled>-- Pilih STO --</option>

                            @foreach ($stos as $s)
                                <option value="{{ $s }}" {{ old('sto', $data->sto) == $s ? 'selected' : '' }}>
                                    {{ $s }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                </div>

                <!-- ================= DATA DEPLOYMENT ================= -->
                <h2 class="text-sm font-semibold text-slate-700 mb-4">Data Deployment</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">

                    <!-- READONLY -->
                    <div>
                        <label class="block text-sm font-medium">Status Order</label>
                        <input type="text" value="{{ optional($data->planning)->status_order ?? '-' }}" readonly
                            class="w-full mt-1 rounded-lg bg-slate-100 border px-3 py-2
                               text-slate-500 cursor-not-allowed">
                    </div>

                    <!-- READONLY -->
                    <div>
                        <label class="block text-sm font-medium">Tipe Desain</label>
                        <input type="text" value="{{ optional($data->planning)->tipe_desain ?? '-' }}" readonly
                            class="w-full mt-1 rounded-lg bg-slate-100 border px-3 py-2
                               text-slate-500 cursor-not-allowed">
                    </div>

                    <!-- PROGRES -->
                    <div>
                        <label class="block text-sm font-medium">Progres</label>
                        <select name="progres" class="w-full mt-1 px-3 py-2 border rounded-lg">
                            <option value="">-- Pilih Progres --</option>
                            @php
                                $listProgress = [
                                    'ON DESK',
                                    'SURVEY',
                                    'PERIJINAN',
                                    'DRM',
                                    'APPROVED BY EBIS',
                                    'MATDEV',
                                    'INSTALASI',
                                    'SELESAI FISIK',
                                    'GOLIVE',
                                    'PS',
                                    'KENDALA',
                                    'UJI TERIMA',
                                    'REKON',
                                ];
                            @endphp
                            @foreach ($listProgress as $progress)
                                <option value="{{ $progress }}"
                                    {{ old('progres', optional($data->planning)->progres) == $progress ? 'selected' : '' }}>
                                    {{ $progress }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <!-- KETERANGAN (SELALU MUNCUL) -->
                <div class="mb-6">
                    <label class="block text-sm font-medium">Keterangan Progress</label>
                    <textarea name="keterangan" rows="3" class="w-full mt-1 px-3 py-2 border rounded-lg"
                        placeholder="Keterangan tambahan (opsional)"></textarea>
                </div>

                <!-- ================= ACTION ================= -->
                <div class="flex justify-end gap-3 pt-6 border-t">
                    <a href="{{ route('deployment.update') }}" class="px-4 py-2 rounded-lg border">Batal</a>

                    <button type="submit" class="px-6 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                        Update Data
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
