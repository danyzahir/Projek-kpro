@extends('layouts.app')

@section('title', 'Input Data')

@section('content')
    <div class="flex flex-col gap-6">

        <!-- ================= BREADCRUMB ================= -->
        <div class="flex items-center gap-3 text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition">
                Dashboard
            </a>
            <span>›</span>
            <a href="{{ route('deployment.b2b') }}" class="hover:text-red-600 transition">
                B2B
            </a>
            <span>›</span>
            <span class="font-semibold text-slate-800">Update</span>
        </div>

        <!-- ================= CARD ================= -->
        <div class="bg-white rounded-2xl shadow-sm">


            <!-- ================= TABLE ================= -->
            <div class="bg-white rounded-xl shadow-sm p-6">

                <form method="GET" action="{{ route('deployment.rekap') }}" x-data="filterBar()" class="mb-4">

                    <div class="flex items-center gap-2 bg-white border rounded-xl px-3 py-2 shadow-sm">

                        <!-- FILTER DROPDOWN -->
                        <div class="relative" x-data="{ open: false }">
                            <button type="button" @click="open = !open"
                                class="flex items-center gap-2 px-3 py-2 text-sm border rounded-lg bg-slate-50">
                                <span x-text="selectedLabel"></span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" @click.outside="open=false"
                                class="absolute z-50 mt-2 w-48 bg-white border rounded-lg shadow text-sm">
                                <template x-for="item in filters" :key="item.value">
                                    <button type="button" @click="selectFilter(item)"
                                        class="block w-full text-left px-4 py-2 hover:bg-slate-100">
                                        <span x-text="item.label"></span>
                                    </button>
                                </template>
                            </div>
                        </div>

                        <!-- MULTIPLE TOGGLE -->
                        <button type="button" @click="toggleMultiple"
                            :class="multiple ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-500'"
                            class="px-3 py-2 rounded-lg text-xs font-semibold">
                            Multiple
                        </button>


                        <!-- INPUT AREA -->
                        <!-- INPUT AREA -->
                        <div class="flex-1">
                            <input type="text" x-model="input"
                                placeholder="Pisahkan dengan koma, contoh: 1001631410,100032312"
                                class="w-full px-3 py-2 text-sm focus:outline-none">
                        </div>


                        <!-- SUBMIT -->
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700">
                            Cari
                        </button>
                    </div>
                    <input type="hidden" name="filter_key" :value="selectedFilter">
                    <input type="hidden" name="filter_values" :value="input">

                </form>

                <!-- ================= TABLE ================= -->
                <div class="relative overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <table class="min-w-[1600px] text-sm text-slate-700">

                        <!-- HEADER -->
                        <thead
                            class="sticky top-0 z-20
                            bg-slate-50
                            border-b border-slate-200
                            text-[11px] font-semibold uppercase tracking-wider
                            text-slate-500">
                            <tr>
                                <th class="sticky left-0 z-30 bg-slate-50 px-4 py-3 border-r border-slate-200">
                                    NDE JT
                                </th>
                                @foreach (['Starclick ID', 'Nama', 'Alamat', 'Telepon', 'Tikor', 'Datel', 'STO', 'Status Alokasi Alpro', 'Status Order', 'iHLD LoP ID', 'Tipe Desain', 'Total BOQ', 'Jenis Program', 'Nama CFU', 'Progres', 'Tanggal Update', 'Action'] as $head)
                                    <th
                                        class="px-4 py-4
                                        align-middle
                                        whitespace-nowrap
                                        {{ $head === 'Action' ? 'text-center' : '' }}">
                                        {{ $head }}
                                    </th>
                                @endforeach


                            </tr>
                        </thead>

                        <!-- BODY -->
                        <tbody class="divide-y bg-white">
                            @forelse ($rows as $row)
                                <tr class="hover:bg-slate-50">

                                    <!-- DATA INPUT (ebis_manual_inputs) -->
                                    <td class="px-4 py-3 sticky left-0 bg-white font-medium">
                                        {{ $row->nde_jt ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3">{{ $row->star_click_id ?? '-' }}</td>

                                    <td class="px-4 py-3">{{ $row->nama_customer ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $row->alamat_pelanggan ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $row->telepon_pelanggan ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $row->tikor_pelanggan ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $row->datel ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $row->sto ?? '-' }}</td>

                                    <!-- DATA UPLOAD (ebis_planning_orders) -->
                                    <td class="px-4 py-3">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full font-medium bg-green-100 text-green-700">
                                            {{ optional($row->planning)->status_alokasi_alpro ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">
                                            {{ optional($row->planning)->status_order ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">{{ optional($row->planning)->ihld_lop_id ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ optional($row->planning)->tipe_desain ?? '-' }}</td>
                                    <td class="px-4 py-4">
                                        {{ optional($row->planning)->total_boq ? number_format(optional($row->planning)->total_boq, 0, ',', '.') : '-' }}
                                    </td>

                                    <td class="px-4 py-3">{{ optional($row->planning)->jenis_program ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ optional($row->planning)->nama_cfu ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="px-2 py-1 text-xs rounded
            {{ $row->progres === 'PS' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ $row->progres ?? '-' }}
                                        </span>
                                    </td>


                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ $row->tanggal_update_progres
                                            ? \Carbon\Carbon::parse($row->tanggal_update_progres)->format('d-m-Y H:i')
                                            : '-' }}
                                    </td>


                                    <td class="px-4 py-3 text-center whitespace-nowrap">
                                        <a href="{{ route('deployment.edit', $row->id) }}"
                                            class="inline-flex items-center gap-1
                                                px-3 py-1.5 text-xs font-medium
                                                rounded-md
                                                text-blue-600 bg-blue-50
                                                hover:bg-blue-100 transition">
                                            Update
                                        </a>
                                    </td>



                                </tr>
                            @empty
                                <tr>
                                    <td colspan="18" class="py-12 text-center text-slate-500">
                                        <div class="flex flex-col items-center gap-2">
                                            <span class="text-sm font-medium">Data tidak ditemukan</span>
                                            <span class="text-xs text-slate-400">
                                                Coba ubah filter atau kata kunci pencarian
                                            </span>
                                        </div>
                                    </td>

                                </tr>
                            @endforelse
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-6 flex justify-center">
        {{ $rows->links('components.pagination') }}
    </div>
@endsection

@push('scripts')
    <script>
        function filterBar() {
            return {
                input: '',
                multiple: false, // cuma UI toggle (opsional)

                selectedFilter: 'ihld_lop_id',
                selectedLabel: 'Cari Filtering',

                filters: [{
                        label: 'iHLD LoP ID',
                        value: 'ihld_lop_id'
                    },
                    {
                        label: 'Starclick / NCX',
                        value: 'star_click_id'
                    },
                    {
                        label: 'Nama Pelanggan',
                        value: 'nama_customer'
                    },
                    {
                        label: 'STO',
                        value: 'sto'
                    },
                    {
                        label: 'Status Order',
                        value: 'status_order'
                    },
                    {
                        label: 'Tipe Desain',
                        value: 'tipe_desain'
                    },
                    {
                        label: 'Jenis Program',
                        value: 'jenis_program'
                    },
                ],

                selectFilter(item) {
                    this.selectedFilter = item.value;
                    this.selectedLabel = item.label;
                    this.input = '';
                },

                toggleMultiple() {
                    this.multiple = !this.multiple;
                }
            }
        }
    </script>
@endpush
