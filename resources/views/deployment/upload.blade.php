@extends('layouts.app')

@section('title', 'Input Data')

@section('content')
<div class="flex flex-col gap-6">

     <!-- ================= BREADCRUMB ================= -->
    <div class="flex items-center gap-3 text-sm text-slate-500">
        <a href="{{ route('dashboard') }}"
           class="hover:text-red-600 transition">
            Dashboard
        </a>
        <span>›</span>
        <a href="{{ route('deployment.b2b') }}"
           class="hover:text-red-600 transition">
            B2B
        </a>
        <span>›</span>
        <span class="font-semibold text-slate-800">Upload</span>
    </div>

    <!-- ================= CARD ================= -->
    <div class="bg-white rounded-xl shadow-sm">

        <!-- TOOLBAR -->
        <div class="p-4 border-b flex flex-wrap items-center justify-between gap-4">
            <input type="text" placeholder="Cari data..."
                class="w-64 rounded-lg border border-slate-300 px-3 py-2 text-sm
                      focus:ring-2 focus:ring-red-500 focus:outline-none">

            <div class="flex gap-2">

                <!-- IMPORT -->
                <form action="{{ route('ebis.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label
                        class="flex items-center gap-2
                   px-4 py-2 text-sm rounded-lg
                   bg-slate-100 hover:bg-slate-200
                   cursor-pointer transition">

                        <!-- ICON UPLOAD -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12V4m0 0l-4 4m4-4l4 4" />
                        </svg>

                        <span>Import</span>

                        <input type="file" name="file" class="hidden" onchange="this.form.submit()" required>
                    </label>
                </form>

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
                            <th class="sticky left-0 z-30 bg-red-600 px-4 py-3">Star Click ID</th>
                            <th class="px-4 py-3">Track ID</th>
                            <th class="px-4 py-3">Status Alokasi Alpro</th>
                            <th class="px-4 py-3">Datel</th>
                            <th class="px-4 py-3">STO</th>
                            <th class="px-4 py-3">Nama Customer</th>
                            <th class="px-4 py-3">Status Order</th>
                            <th class="px-4 py-3">iHLD LoP ID</th>
                            <th class="px-4 py-3">Tipe Desain</th>
                            <th class="px-4 py-3">Total BOQ</th>
                            <th class="px-4 py-3">Jenis Program</th>
                            <th class="px-4 py-3">Nama CFU</th>
                        </tr>
                    </thead>


                    <!-- BODY -->
                    <tbody class="divide-y text-slate-700">

                        @if ($rows->count())
                        @foreach ($rows as $row)
                        <tr class="hover:bg-slate-50">

                            <td class="sticky left-0 z-20 bg-white px-4 py-3 font-medium">
                                {{ $row->star_click_id }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $row->track_id }}

                            <td class="px-4 py-3">
                                {{ $row->status_alokasi_alpro }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $row->datel }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $row->sto }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $row->nama_customer }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $row->status_order }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $row->ihld_lop_id }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $row->tipe_desain }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $row->total_boq }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $row->jenis_program }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $row->nama_cfu }}
                            </td>

                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="9" class="text-center py-8 text-slate-400">
                                Belum ada data
                            </td>
                        </tr>
                        @endif

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
            button.classList.add('bg-green-200', 'text-green-900', 'border-green-400');
            label.textContent = 'Completed PS';
        } else {
            button.classList.add('bg-yellow-200', 'text-yellow-900', 'border-yellow-400');
            label.textContent = 'Kendala';
        }

        menu.classList.add('hidden');
    }

    // SEARCH
    document.getElementById('tableSearch').addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        document.querySelectorAll('#dataTable tbody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>