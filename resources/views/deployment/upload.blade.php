@extends('layouts.app')

@section('title', 'input data')

@section('content')
    <div class="flex flex-col">

        <!-- BREADCRUMB -->
        <div class="flex items-center gap-4 text-lg text-slate-500 mb-6">

            <!-- HOME -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:text-red-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5" />
                </svg>
            </a>

            <span class="text-slate-400">›</span>

            <!-- B2B -->
            <a href="{{ route('deployment.b2b') }}" class="font-medium hover:text-red-600 transition">
                B2B
            </a>

            <span class="text-slate-400">›</span>

            <!-- CURRENT -->
            <span class="font-semibold text-slate-800">
                Rekap
            </span>
        </div>

        <!-- CARD -->
        <div class="bg-white rounded-xl shadow-sm p-6">

            <!-- TOOLBAR -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                <!-- BUTTON -->
                <div class="flex gap-3">
                    <button
                        class="px-5 py-2 rounded-lg border border-slate-300
                           bg-white text-slate-700 text-sm font-medium
                           shadow-sm hover:bg-slate-100 transition">
                        Import Data
                    </button>

                    <button
                        class="px-5 py-2 rounded-lg border border-slate-300
                           bg-white text-slate-700 text-sm font-medium
                           shadow-sm hover:bg-slate-100 transition">
                        Export Data
                    </button>
                </div>

                <!-- SEARCH -->
                <div class="relative w-full md:w-72">
                    <input type="text" placeholder="Cari Data"
                        class="w-full rounded-lg border border-slate-300
                           pl-10 pr-4 py-2 text-sm
                           focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="absolute left-3 top-1/2 -translate-y-1/2
                            w-5 h-5 text-slate-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                </div>

            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto rounded-xl shadow-sm">
                <table class="min-w-full text-sm text-left">

                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-4 py-3">NDE JT</th>
                            <th class="px-4 py-3">Starclick / NCX</th>
                            <th class="px-4 py-3">Track ID</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Alamat</th>
                            <th class="px-4 py-3">Telepon</th>
                            <th class="px-4 py-3">Tikor</th>
                            <th class="px-4 py-3">Datel</th>
                            <th class="px-4 py-3">STO</th>
                            <th class="px-4 py-3">Status Alokasi Alpro</th>
                            <th class="px-4 py-3">Status Order</th>
                            <th class="px-4 py-3">iHLD LoP ID</th>
                            <th class="px-4 py-3">Tipe Desain</th>
                            <th class="px-4 py-3">Total BOQ</th>
                            <th class="px-4 py-3">Jenis Program</th>
                            <th class="px-4 py-3">Nama CFU</th>
                            <th class="px-4 py-3">Progress</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y bg-white">
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
                                <td class="px-4 py-3">
                                    <div class="relative w-36">
                                        <button onclick="toggleDropdown(this)"
                                            class="status-btn w-full rounded-2xl px-3 py-3 text-sm font-semibold
               bg-green-200 text-green-900 border border-green-400
               flex items-center justify-between shadow-sm">
                                            <span data-value="completed">Completed PS</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

                                        <div
                                            class="status-menu hidden absolute z-20 mt-2 w-full rounded-2xl shadow-lg border bg-white overflow-hidden">
                                            <div onclick="selectStatus(this, 'completed')"
                                                class="px-3 py-2 cursor-pointer bg-green-200 text-green-900 hover:bg-green-300">
                                                Completed PS
                                            </div>
                                            <div onclick="selectStatus(this, 'kendala')"
                                                class="px-3 py-2 cursor-pointer bg-yellow-200 text-yellow-900 hover:bg-yellow-300">
                                                Kendala
                                            </div>
                                        </div>
                                    </div>


                                </td>

                            </tr>
                        @endfor
                    </tbody>

                </table>
            </div>

        </div>
    </div>
@endsection
<script>
function toggleDropdown(btn) {
    btn.nextElementSibling.classList.toggle('hidden');
}

function selectStatus(el, value) {
    const wrapper = el.closest('.relative');
    const button = wrapper.querySelector('.status-btn');
    const label = button.querySelector('span');
    const menu = wrapper.querySelector('.status-menu');

    // reset
    button.className =
        'status-btn w-full rounded-2xl px-3 py-3 text-sm font-semibold ' +
        'flex items-center justify-between shadow-sm border';

    if (value === 'completed') {
        button.classList.add('bg-green-200','text-green-900','border-green-400');
        label.textContent = 'Completed PS';
    } else {
        button.classList.add('bg-yellow-200','text-yellow-900','border-yellow-400');
        label.textContent = 'Kendala';
    }

    label.dataset.value = value;
    menu.classList.add('hidden');
}
</script>

