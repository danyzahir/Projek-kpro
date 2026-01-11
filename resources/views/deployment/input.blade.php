@extends('layouts.app')

@section('title', 'Input Data')

@section('content')

    <!-- BREADCRUMB (POJOK KIRI ATAS) -->
    <div class="mb-6 flex items-center gap-4 text-lg text-slate-500">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:text-red-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5" />
            </svg>
        </a>

        <span class="text-slate-400">›</span>

        <a href="{{ route('deployment.b2b') }}" class="font-medium hover:text-red-600 transition">
            B2B
        </a>

        <span class="text-slate-400">›</span>

        <span class="font-semibold text-slate-800">Input</span>
    </div>


    <div class="flex justify-center">
        <div class="bg-white rounded-xl shadow-sm p-6 w-full max-w-3xl">


            <h2 class="text-lg font-semibold mb-4 text-gray-700">
                Input Data Manual EBIS
            </h2>

            <form method="POST" action="{{ route('ebis.manual.store') }}" class="space-y-4">
                @csrf


                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Nomor NDE JT
                    </label>
                    <input name="nde_jt" type="text" class="w-full rounded-lg border px-3 py-2 text-sm"
                        placeholder="Masukkan nomor NDE JT">
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Starclick ID / NCX
                    </label>
                    <input name="star_click_id" type="text" class="w-full rounded-lg border px-3 py-2 text-sm"
                        placeholder="Masukkan Starclick ID / NCX">
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Nama Pelanggan
                    </label>
                    <input name="nama_customer" type="text" class="w-full rounded-lg border px-3 py-2 text-sm"
                        placeholder="Nama lengkap pelanggan">
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Alamat Pelanggan
                    </label>
                    <input name="alamat_pelanggan" type="text" class="w-full rounded-lg border px-3 py-2 text-sm"
                        placeholder="Alamat lengkap pelanggan">
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Telepon Pelanggan
                    </label>
                    <input name="telepon_pelanggan" type="text" class="w-full rounded-lg border px-3 py-2 text-sm"
                        placeholder="Contoh: 08xxxxxxxxxx">
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Titik Koordinat (Tikor)
                    </label>
                    <input name="tikor_pelanggan" type="text" class="w-full rounded-lg border px-3 py-2 text-sm"
                        placeholder="-6.xxxxx, 108.xxxxx">
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Datel
                        </label>
                        <select name="datel" class="w-full rounded-lg border px-3 py-2 text-sm">
                            <option disabled selected>Pilih Datel</option>
                            @foreach ($datels as $d)
                                <option value="{{ $d }}">{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            STO
                        </label>
                        <select name="sto" class="w-full rounded-lg border px-3 py-2 text-sm">
                            <option disabled selected>Pilih STO</option>
                            @foreach ($stos as $s)
                                <option value="{{ $s }}">{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg transition">
                    Submit
                </button>
            </form>
        </div>
    </div>



@endsection
