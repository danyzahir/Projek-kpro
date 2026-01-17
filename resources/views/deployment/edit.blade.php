@extends('layouts.app')

@section('title', 'Edit Data Deployment')

@section('content')
<div class="flex flex-col gap-6">

    <!-- ================= PAGE HEADER ================= -->
    <div>
        <h1 class="text-xl font-semibold text-slate-800">
            Edit Data Deployment
        </h1>
        <p class="text-sm text-slate-500">
            Perbarui progres dan informasi teknis deployment
        </p>
    </div>

    <!-- ================= FORM CARD ================= -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

        <form action="{{ route('deployment.update', $data->id) }}"
              method="POST"
              class="space-y-8">

            @csrf
            @method('PUT')

            <!-- ================= INFO UTAMA ================= -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- STAR CLICK ID -->
                <div>
                    <label class="block text-sm font-medium text-slate-600">
                        Star Click ID
                    </label>
                    <input type="text"
                           value="{{ $data->star_click_id }}"
                           disabled
                           class="w-full mt-1 rounded-lg bg-slate-100
                                  border px-3 py-2 text-slate-500 cursor-not-allowed">
                </div>

                <!-- NAMA PELANGGAN (DISABLED) -->
                <div>
                    <label class="block text-sm font-medium text-slate-600">
                        Nama Pelanggan
                    </label>
                    <input type="text"
                           value="{{ $data->nama_customer }}"
                           disabled
                           class="w-full mt-1 rounded-lg bg-slate-100
                                  border px-3 py-2 text-slate-500 cursor-not-allowed">
                </div>

            </div>

            <!-- ================= LOKASI ================= -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- DATEL -->
                <div>
                    <label class="block text-sm font-medium">
                        Datel
                    </label>
                    <select name="datel"
                            class="w-full mt-1 rounded-lg border px-3 py-2">
                        <option value="">-- Pilih Datel --</option>
                        @foreach ($datels as $datel)
                            <option value="{{ $datel }}"
                                {{ old('datel', $data->datel) == $datel ? 'selected' : '' }}>
                                {{ $datel }}
                            </option>
                        @endforeach
                    </select>
                    @error('datel')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- STO -->
                <div>
                    <label class="block text-sm font-medium">
                        STO
                    </label>
                    <select name="sto"
                            class="w-full mt-1 rounded-lg border px-3 py-2">
                        <option value="">-- Pilih STO --</option>
                        @foreach ($stos as $sto)
                            <option value="{{ $sto }}"
                                {{ old('sto', $data->sto) == $sto ? 'selected' : '' }}>
                                {{ $sto }}
                            </option>
                        @endforeach
                    </select>
                    @error('sto')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- ================= STATUS ================= -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- STATUS ORDER (DISABLED) -->
                <div>
                    <label class="block text-sm font-medium text-slate-600">
                        Status Order
                    </label>
                    <input type="text"
                           value="{{ $data->status_order }}"
                           disabled
                           class="w-full mt-1 rounded-lg bg-slate-100
                                  border px-3 py-2 text-slate-500 cursor-not-allowed">
                </div>

                <!-- TIPE DESAIN (DISABLED) -->
                <div>
                    <label class="block text-sm font-medium text-slate-600">
                        Tipe Desain
                    </label>
                    <input type="text"
                           value="{{ $data->tipe_desain }}"
                           disabled
                           class="w-full mt-1 rounded-lg bg-slate-100
                                  border px-3 py-2 text-slate-500 cursor-not-allowed">
                </div>

                <!-- PROGRES -->
                <div>
                    <label class="block text-sm font-medium">
                        Progres
                    </label>
                    <select name="progres"
                            class="w-full mt-1 px-3 py-2 border rounded-lg text-sm">
                        <option value="">-- Pilih Progres --</option>
                        <option value="COMPLETED PS"
                            {{ old('progres', $data->progres) == 'COMPLETED PS' ? 'selected' : '' }}>
                            COMPLETED PS
                        </option>
                        <option value="KENDALA"
                            {{ old('progres', $data->progres) == 'KENDALA' ? 'selected' : '' }}>
                            KENDALA
                        </option>
                    </select>
                </div>

            </div>

            <!-- ================= TANGGAL ================= -->
            <div class="max-w-sm">
                <label class="block text-sm font-medium">
                    Tanggal Update Progres
                </label>
                <input type="date"
                       name="tanggal_update_progres"
                       value="{{ old('tanggal_update_progres', optional($data->tanggal_update_progres)->format('Y-m-d')) }}"
                       class="w-full mt-1 rounded-lg border px-3 py-2">
                @error('tanggal_update_progres')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ================= ACTION ================= -->
            <div class="flex justify-end gap-3 pt-6 border-t border-slate-200">
                <a href="{{ route('deployment.update.list') }}"
                   class="px-4 py-2 rounded-lg border text-slate-600
                          hover:bg-slate-100 transition">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2 rounded-lg
                               bg-red-600 text-white
                               hover:bg-red-700 transition">
                    Update Data
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
