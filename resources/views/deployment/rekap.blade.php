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
                Rekap
            </span>
        </div>


        <!-- FORM CARD -->
        <!-- FILTER / INPUT BAR -->
        <div class="bg-white rounded-xl shadow-sm p-6">

            
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
                                <th class="px-4 py-3 font-medium">Status Alokasi Alpro</th>
                                <th class="px-4 py-3 font-medium">Status Order</th>
                                <th class="px-4 py-3 font-medium">iHLD LoP ID</th>
                                <th class="px-4 py-3 font-medium">Tipe Desain</th>
                                <th class="px-4 py-3 font-medium">Total BOQ</th>
                                <th class="px-4 py-3 font-medium">Jenis Program</th>
                                <th class="px-4 py-3 font-medium">Nama CFU</th>

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
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                            Success Alpro Allocation
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">
                                            Completed Order PT1
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">11172936</td>
                                    <td class="px-4 py-3">PT2-AERIAL</td>
                                    <td class="px-4 py-3">2099481</td>
                                    <td class="px-4 py-3">EBIS-DBS</td>
                                    <td class="px-4 py-3">EBIS</td>
                                </tr>
                            @endfor
                        </tbody>

                    </table>
                </div>

            </div>


        </div>



    </div>
@endsection
