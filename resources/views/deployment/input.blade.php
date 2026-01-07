@extends('layouts.app')

@section('title', 'Input Data')
@section('content')
    <div class="flex flex-col">


        <div class="flex items-center gap-4 text-lg text-slate-500 mb-4">

            <!-- HOME -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2
              transition-colors duration-200
              hover:text-red-600">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6 text-slate-400
                    transition-colors duration-200" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5" />
                </svg>

            </a>

            <span class="text-slate-400">›</span>

            <!-- B2B -->
            <a href="{{ route('deployment.b2b') }}"
                class="relative font-medium
              transition-colors duration-200
              hover:text-red-600">

                B2B

                <!-- underline smooth -->
                <span
                    class="absolute left-0 -bottom-1 h-[2px] w-0
                   bg-red-600 transition-all duration-200
                   group-hover:w-full">
                </span>
            </a>

            <span class="text-slate-400">›</span>

            <!-- CURRENT -->
            <span class="font-semibold text-slate-800">
                Input
            </span>
        </div>


        <!-- FORM CARD -->
        <!-- FILTER / INPUT BAR -->
        <div class="bg-white rounded-xl shadow-sm p-6">

            <form class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 items-end">

                <!-- NOMOR NDE JT -->
                <div>
                    <label class="text-xs text-slate-500 mb-1 block">Nomor NDE JT</label>
                    <input type="text" placeholder="Nomor NDE JT"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- STARCILCK ID -->
                <div>
                    <label class="text-xs text-slate-500 mb-1 block">Starclick ID / NCX</label>
                    <input type="text" placeholder="Starclick ID / NCX"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- TRACK ID -->
                <div>
                    <label class="text-xs text-slate-500 mb-1 block">Track ID</label>
                    <input type="text" placeholder="Track ID"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>


                <!-- NAMA PELANGGAN -->
                <div>
                    <label class="text-xs text-slate-500 mb-1 block">Nama Pelanggan</label>
                    <input type="text" placeholder="Nama Pelanggan"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- ALAMAT -->
                <div>
                    <label class="text-xs text-slate-500 mb-1 block">Alamat Pelanggan</label>
                    <input type="text" placeholder="Alamat Pelanggan"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- TELEPON -->
                <div>
                    <label class="text-xs text-slate-500 mb-1 block">Telepon Pelanggan</label>
                    <input type="text" placeholder="Telepon Pelanggan"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- TIKOR -->
                <div>
                    <label class="text-xs text-slate-500 mb-1 block">Tikor Pelanggan</label>
                    <input type="text" placeholder="Tikor Pelanggan"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <!-- DATEL -->
                <div>
                    <label class="text-xs text-slate-500 mb-1 block">Datel</label>
                    <select
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-red-500 focus:outline-none">
                        <option selected disabled>Pilih Datel</option>
                        <option>CIREBON</option>
                        <option>INDRAMAYU</option>
                        <option>MAJALENGKA</option>
                        <option>KUNINGAN</option>
                        <option>SUBANG</option>
                    </select>
                </div>

                <!-- STO -->
                <div>
                    <label class="text-xs text-slate-500 mb-1 block">STO</label>
                    <select
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-red-500 focus:outline-none">
                        <option selected disabled>Pilih STO</option>
                        <option>ARJAWINANGUN</option>
                        <option>BALONGAN</option>
                        <option>CIREBON</option>
                    </select>
                </div>


                <!-- BUTTON -->
                <div class="flex">
                    <button
                        class="w-full bg-red-600 hover:bg-red-700
                       text-white text-sm font-medium
                       px-6 py-2 rounded-lg transition">
                        Search
                    </button>
                </div>

            </form>
            <!-- TABLE RESULT -->
            <div class="mt-8 bg-white rounded-xl shadow-sm overflow-hidden">


                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-red-600 text-white">
                            <tr>
                                <th class="px-4 py-3 font-medium">NDE JT</th>
                                <th class="px-4 py-3 font-medium">Starclick / NCX</th>
                                <th class="px-4 py-3 font-medium">Track ID</th>
                                <th class="px-4 py-3 font-medium">Nama</th>
                                <th class="px-4 py-3 font-medium">Alamat</th>
                                <th class="px-4 py-3 font-medium">Telepon</th>
                                <th class="px-4 py-3 font-medium">Tikor</th>
                                <th class="px-4 py-3 font-medium">Datel</th>
                                <th class="px-4 py-3 font-medium">STO</th>
                                

                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @for ($i = 1; $i <= 5; $i++)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-4 py-3">NDE-00{{ $i }}</td>
                                    <td class="px-4 py-3">SC-10{{ $i }}</td>
                                    <td class="px-4 py-3">TRK-{{ 1000 + $i }}</td>
                                    <td class="px-4 py-3">Pelanggan {{ $i }}</td>
                                    <td class="px-4 py-3">Jl. Contoh Alamat {{ $i }}</td>
                                    <td class="px-4 py-3">08{{ rand(10000000, 99999999) }}</td>
                                    <td class="px-4 py-3">{{ -6.7 + $i * 0.01 }}, 108.5{{ $i }}</td>
                                    <td class="px-4 py-3">CIREBON</td>
                                    <td class="px-4 py-3">ARJAWINANGUN</td>
                                    
                                </tr>
                            @endfor
                        </tbody>

                    </table>
                </div>

            </div>


        </div>



    </div>
@endsection
