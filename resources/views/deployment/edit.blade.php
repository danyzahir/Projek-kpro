@extends('layouts.app')

@section('title', 'Edit Data Deployment')

@section('content')
    <div class="max-w-4xl mx-auto flex flex-col gap-6">

        <div>
            <h1 class="text-xl font-semibold text-slate-800">
                Edit Data Upload
            </h1>
            <p class="text-sm text-slate-500">

            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <form action="{{ route('deployment.update', $data->id) }}" method="POST" class="space-y-6">

                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-slate-600">
                        Star Click ID
                    </label>
                    <input type="text" value="{{ $data->star_click_id }}" disabled
                        class="w-full mt-1 rounded-lg bg-slate-100
                              border px-3 py-2 text-slate-500 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-medium">
                        Nama Pelanggan
                    </label>
                    <input type="text" name="track_id" value="{{ old('track_id', $data->track_id) }}"
                        class="w-full mt-1 rounded-lg border px-3 py-2
                              focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('nama_customer')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">

                    <!-- DATEL -->
                    <div>
                        <label class="block text-sm font-medium">
                            Datel
                        </label>
                        <select name="datel" class="w-full mt-1 rounded-lg border px-3 py-2">
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
                        <select name="sto" class="w-full mt-1 rounded-lg border px-3 py-2">
                            <option value="">-- Pilih STO --</option>
                            @foreach ($stos as $sto)
                                <option value="{{ $sto }}" {{ old('sto', $data->sto) == $sto ? 'selected' : '' }}>
                                    {{ $sto }}
                                </option>
                            @endforeach
                        </select>
                        @error('sto')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div>
                    <label class="block text-sm font-medium">
                        Status Order
                    </label>
                    <input type="text" name="status_order" value="{{ old('status_order', $data->status_order) }}"
                        class="w-full mt-1 rounded-lg border px-3 py-2
                              focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('status_order')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">
                        Tipe Desain
                    </label>
                    <input type="text" name="tipe_desain" value="{{ old('tipe_desain', $data->tipe_desain) }}"
                        class="w-full mt-1 rounded-lg border px-3 py-2
                              focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('tipe_desain')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Progres
                    </label>
                    <select name="progres" class="w-full px-3 py-2 border rounded-lg text-sm">
                        <option value="">-- Pilih Progres --</option>
                        <option value="COMPLETED PS" {{ $data->progres == 'COMPLETED PS' ? 'selected' : '' }}>
                            COMPLETED PS
                        </option>
                        <option value="KENDALA" {{ $data->progres == 'KENDALA' ? 'selected' : '' }}>
                            KENDALA
                        </option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">
                        Tanggal Update
                    </label>

                    <input type="date" name="tanggal_update_progres"
                        value="{{ old('tanggal_update_progres', optional($data->tanggal_update_progres)->format('Y-m-d')) }}"
                        class="w-full mt-1 rounded-lg border px-3 py-2">

                    @error('tanggal_update_progres')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="flex justify-end gap-3 pt-6 border-t">
                    <a href="{{ route('deployment.update.list') }}"
                        class="px-4 py-2 rounded-lg border text-slate-600
                          hover:bg-slate-100">
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
