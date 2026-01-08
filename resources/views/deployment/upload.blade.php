@extends('layouts.app')

@section('title', 'Input Data')

@section('content')
<div class="flex flex-col gap-6">

    <!-- ================= BREADCRUMB ================= -->
     <div class="flex items-center gap-4 text-lg text-slate-500">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-2 hover:text-red-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-6 h-6 text-slate-400"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5"/>
            </svg>
        </a>

        <span class="text-slate-400">›</span>

        <a href="{{ route('deployment.b2b') }}"
           class="font-medium hover:text-red-600 transition">
            B2B
        </a>

        <span class="text-slate-400">›</span>

        <span class="font-semibold text-slate-800">Upload</span>
    </div>

    <!-- ================= CARD ================= -->
<div class="bg-white rounded-xl shadow-sm">

    <!-- TOOLBAR -->
    <div class="p-4 border-b flex flex-wrap items-center justify-between gap-4">
        <input type="text"
               placeholder="Cari data..."
               class="w-64 rounded-lg border border-slate-300 px-3 py-2 text-sm
                      focus:ring-2 focus:ring-red-500 focus:outline-none">

        <div class="flex gap-2">
            <button class="px-4 py-2 text-sm rounded-lg bg-slate-100 hover:bg-slate-200">
                Import
            </button>
            <button class="px-4 py-2 text-sm rounded-lg bg-green-600 text-white hover:bg-green-700">
                Export
            </button>
        </div>
    </div>

    <!-- TABLE AREA (ADA PADDING) -->
    <div class="p-4">

        <!-- SCROLL HANYA DI SINI -->
        <div class="overflow-x-auto rounded-xl border">

            <table class="min-w-[2200px] text-sm text-left">

                <!-- HEADER -->
                <thead class="bg-red-600 text-white">
                    <tr>
                        <th class="sticky left-0 z-30 bg-red-600 px-4 py-3">
                            NDE JT
                        </th>
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

                <!-- BODY -->
                <tbody class="divide-y text-slate-700">
                @for ($i = 1; $i <= 10; $i++)
                    <tr class="hover:bg-slate-50">
                        <td class="sticky left-0 z-20 bg-white px-4 py-3 font-medium">
                            NDE-00{{ $i }}
                        </td>
                        <td class="px-4 py-3">SC-10{{ $i }}</td>
                        <td class="px-4 py-3">TRK-{{ 1000 + $i }}</td>
                        <td class="px-4 py-3">Pelanggan {{ $i }}</td>
                        <td class="px-4 py-3">Jl. Contoh Alamat {{ $i }}</td>
                        <td class="px-4 py-3">08{{ rand(10000000, 99999999) }}</td>
                        <td class="px-4 py-3">{{ -6.7 + $i * 0.01 }}, 108.5{{ $i }}</td>
                        <td class="px-4 py-3">CIREBON</td>
                        <td class="px-4 py-3">ARJAWINANGUN</td>

                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-md text-xs bg-green-100 text-green-700">
                                Success Alpro Allocation
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-md text-xs bg-blue-100 text-blue-700">
                                Completed Order PT1
                            </span>
                        </td>

                        <td class="px-4 py-3">11172936</td>
                        <td class="px-4 py-3">PT2-AERIAL</td>
                        <td class="px-4 py-3">2099481</td>
                        <td class="px-4 py-3">EBIS-DBS</td>
                        <td class="px-4 py-3">EBIS</td>

                        <!-- PROGRESS -->
                        <td class="px-4 py-3">
                            <div class="relative w-36">
                                <button onclick="toggleDropdown(this)"
                                    class="status-btn w-full h-9 box-border
                                           flex items-center justify-between gap-2
                                           rounded-full px-4
                                           text-xs font-semibold leading-none
                                           bg-green-200 text-green-900
                                           border border-green-400 shadow-sm">
                                    <span class="truncate">Completed PS</span>
                                    <svg class="w-4 h-4 shrink-0"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div
                                    class="status-menu hidden absolute z-30 mt-2 w-full
                                           rounded-xl overflow-hidden border bg-white shadow-lg">
                                    <div onclick="selectStatus(this,'completed')"
                                         class="px-4 py-2 text-xs cursor-pointer bg-green-200">
                                        Completed PS
                                    </div>
                                    <div onclick="selectStatus(this,'kendala')"
                                         class="px-4 py-2 text-xs cursor-pointer bg-yellow-200">
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

    button.className =
        'status-btn w-full h-9 box-border flex items-center justify-between gap-2 ' +
        'rounded-full px-4 text-xs font-semibold leading-none shadow-sm border';

    if (value === 'completed') {
        button.classList.add('bg-green-200','text-green-900','border-green-400');
        label.textContent = 'Completed PS';
    } else {
        button.classList.add('bg-yellow-200','text-yellow-900','border-yellow-400');
        label.textContent = 'Kendala';
    }

    menu.classList.add('hidden');
}

// SEARCH
document.getElementById('tableSearch').addEventListener('keyup', function () {
    const value = this.value.toLowerCase();
    document.querySelectorAll('#dataTable tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
    });
});
</script>
