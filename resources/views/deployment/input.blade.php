@extends('layouts.app')

@section('title', 'Input Data')

@section('content')

    <!-- ================= BREADCRUMB ================= -->
    <div class="flex items-center gap-3 text-sm text-slate-500 mb-6">
        <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition">
            Dashboard
        </a>
        <span>›</span>
        <a href="{{ route('deployment.b2b') }}" class="hover:text-red-600 transition">
            B2B
        </a>
        <span>›</span>
        <span class="font-semibold text-slate-800">Input</span>
    </div>

    <div class="flex flex-col gap-6">



        <!-- ================= FORM CARD ================= -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

            <form x-data="{ confirmOpen: false }" x-ref="form" method="POST" action="{{ route('ebis.manual.store') }}"
                class="space-y-8">
                @csrf

                <!-- ================= IDENTITAS ================= -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- NDE JT (TIDAK WAJIB) -->
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">
                            Nomor NDE JT
                        </label>
                        <input name="nde_jt" type="text"
                            class="w-full rounded-lg border px-3 py-2 text-sm
                               focus:ring-2 focus:ring-red-500 focus:outline-none"
                            placeholder="Masukkan nomor NDE JT">
                    </div>

                    <!-- STARCLICK -->
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">
                            Starclick ID / NCX <span class="text-red-600">*</span>
                        </label>
                        <input name="star_click_id" type="text" required
                            class="w-full rounded-lg border px-3 py-2 text-sm
                               focus:ring-2 focus:ring-red-500 focus:outline-none"
                            placeholder="Masukkan Starclick ID / NCX">
                    </div>
                </div>

                <!-- ================= PELANGGAN ================= -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">
                            Nama Pelanggan <span class="text-red-600">*</span>
                        </label>
                        <input name="nama_customer" type="text" required
                            class="w-full rounded-lg border px-3 py-2 text-sm
                               focus:ring-2 focus:ring-red-500 focus:outline-none"
                            placeholder="Nama lengkap pelanggan">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">
                            Nama Mitra <span class="text-red-600">*</span>
                        </label>
                        <input name="nama_mitra" type="text" required
                            class="w-full rounded-lg border px-3 py-2 text-sm
                               focus:ring-2 focus:ring-red-500 focus:outline-none"
                            placeholder="Nama lengkap mitra">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">
                            Telepon Pelanggan <span class="text-red-600">*</an>
                        </label>
                        <input name="telepon_pelanggan" type="text" required
                            class="w-full rounded-lg border px-3 py-2 text-sm
                               focus:ring-2 focus:ring-red-500 focus:outline-none"
                            placeholder="08xxxxxxxxxx">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">
                            Titik Koordinat (Tikor) <span class="text-red-600">*</span>
                        </label>
                        <input name="tikor_pelanggan" type="text" required
                            class="w-full rounded-lg border px-3 py-2 text-sm
                            focus:ring-2 focus:ring-red-500 focus:outline-none"
                            placeholder="-6.xxxxx, 108.xxxxx">
                    </div>


                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-600 mb-1">
                            Alamat Pelanggan <span class="text-red-600">*</span>
                        </label>
                        <input name="alamat_pelanggan" type="text" required
                            class="w-full rounded-lg border px-3 py-2 text-sm
                           focus:ring-2 focus:ring-red-500 focus:outline-none"
                            placeholder="Alamat lengkap pelanggan">

                    </div>
                </div>

                <!-- ================= LOKASI ================= -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div x-data="searchableSelect(@js($datels))" class="relative">
    <label class="block text-sm font-medium text-slate-600 mb-1">
        Datel <span class="text-red-600">*</span>
    </label>

    <input
        type="text"
        x-model="search"
        @focus="open = true"
        @click="open = true"
        @input="open = true"
        placeholder="Datel"
        class="w-full rounded-lg border px-3 py-2 text-sm
               focus:ring-2 focus:ring-red-500 focus:outline-none"
        required
    >

    <input type="hidden" name="datel" :value="selected">

    <div x-show="open" @click.outside="open = false"
         class="absolute z-50 mt-1 w-full bg-white border rounded-lg shadow max-h-48 overflow-y-auto">
        <template x-for="item in filtered()" :key="item">
            <div
                @click="select(item)"
                class="px-3 py-2 text-sm cursor-pointer hover:bg-red-50">
                <span x-text="item"></span>
            </div>
        </template>

        <div x-show="filtered().length === 0"
             class="px-3 py-2 text-sm text-slate-400">
            Tidak ditemukan
        </div>
    </div>
</div>


                    <div x-data="searchableSelect(@js($stos))" class="relative">
    <label class="block text-sm font-medium text-slate-600 mb-1">
        STO <span class="text-red-600">*</span>
    </label>

    <input
        type="text"
        x-model="search"
        @focus="open = true"
        @click="open = true"
        @input="open = true"
        placeholder="STO"
        class="w-full rounded-lg border px-3 py-2 text-sm
               focus:ring-2 focus:ring-red-500 focus:outline-none"
        required
    >

    <input type="hidden" name="sto" :value="selected">

    <div x-show="open" @click.outside="open = false"
         class="absolute z-50 mt-1 w-full bg-white border rounded-lg shadow max-h-48 overflow-y-auto">
        <template x-for="item in filtered()" :key="item">
            <div
                @click="select(item)"
                class="px-3 py-2 text-sm cursor-pointer hover:bg-red-50">
                <span x-text="item"></span>
            </div>
        </template>

        <div x-show="filtered().length === 0"
             class="px-3 py-2 text-sm text-slate-400">
            Tidak ditemukan
        </div>
    </div>
</div>


                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium">Catatan</label>
                    <textarea name="catatan" rows="3" class="w-full mt-1 px-3 py-2 border rounded-lg"
                        placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>
                </div>


                <!-- ================= ACTION ================= -->
                <div class="flex justify-end pt-6 border-t border-slate-200">
                    <button type="submit"
                        class="px-6 py-2 rounded-lg
                            bg-red-600 text-white
                            hover:bg-red-700 transition">
                        Simpan Data
                    </button>

                </div>


                <!-- ================= MODAL KONFIRMASI (NO BLUR, NO OVERLAY) ================= -->
                <template
                    x-teleport="body">
                    <div x-show="confirmOpen" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center">
                        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
                            <h3 class="text-lg font-semibold text-slate-800 mb-2"> Konfirmasi Simpan Data </h3>
                            <p class="text-sm text-slate-600 mb-6"> Pastikan data yang Anda input sudah benar. Data akan
                                langsung disimpan ke sistem. </p>
                            <div class="flex justify-end gap-3"> <button type="button" @click="confirmOpen = false"
                                    class="px-4 py-2 rounded-lg border text-slate-600 hover:bg-slate-100 transition"> Batal
                                </button> <!-- SUBMIT FORM --> <button type="button" @click="$refs.form.submit()"
                                    class="px-6 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition"> Ya,
                                    Simpan </button> </div>
                        </div>
                    </div>
                </template>

            </form>

        </div>

    </div>
@endsection

