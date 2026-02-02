    @extends('layouts.app')

    @section('title', 'Rekap B2B')

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
            <span class="font-semibold text-slate-800">Rekap Data</span>
        </div>

        <!-- ================= CARD ================= -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form method="GET"
      action="{{ route('deployment.rekap') }}"
      class="flex flex-nowrap items-center gap-2 mb-4 overflow-x-auto">

    <select name="starclick" class="h-10 min-w-[160px] rounded-lg border px-3 text-sm">
        <option value="">Starclick / NCX</option>
        @foreach ($filters['starclicks'] as $item)
            <option value="{{ $item }}" {{ request('starclick') == $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>

    <select name="nama" class="h-10 min-w-[160px] rounded-lg border px-3 text-sm">
        <option value="">Nama Pelanggan</option>
        @foreach ($filters['nama_customers'] as $item)
            <option value="{{ $item }}" {{ request('nama') == $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>

    <select name="status_order" class="h-10 min-w-[160px] rounded-lg border px-3 text-sm">
        <option value="">Status Order</option>
        @foreach ($filters['status_orders'] as $item)
            <option value="{{ $item }}" {{ request('status_order') == $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>

    <select name="tipe_desain" class="h-10 min-w-[220px] rounded-lg border px-3 text-sm">
        <option value="">Tipe Desain</option>
        @foreach ($filters['tipe_desains'] as $item)
            <option value="{{ $item }}" {{ request('tipe_desain') == $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>

    <select name="jenis_program" class="h-10 min-w-[160px] rounded-lg border px-3 text-sm">
        <option value="">Jenis Program</option>
        @foreach ($filters['jenis_programs'] as $item)
            <option value="{{ $item }}" {{ request('jenis_program') == $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>

    <select name="sto" class="h-10 min-w-[120px] rounded-lg border px-3 text-sm">
        <option value="">STO</option>
        @foreach ($filters['stos'] as $item)
            <option value="{{ $item }}" {{ request('sto') == $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>

    <button type="submit"
        class="h-10 min-w-[90px] bg-red-600 text-white
               rounded-lg flex items-center justify-center
               hover:bg-red-700 transition">
        Filter
    </button>
</form>



            <!-- ================= FILTER (MANUAL INPUT) ================= -->
            <form method="GET" action="{{ route('deployment.rekap') }}"
                x-data="filterBar()"
                class="mb-4">

                <div class="flex items-center gap-2 bg-white border rounded-xl px-3 py-2 shadow-sm">

                    <!-- FILTER DROPDOWN -->
                    <div class="relative" x-data="{open:false}">
                        <button type="button"
                            @click="open = !open"
                            class="flex items-center gap-2 px-3 py-2 text-sm border rounded-lg bg-slate-50">
                            <span x-text="selectedLabel"></span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.outside="open=false"
                            class="absolute z-50 mt-2 w-48 bg-white border rounded-lg shadow text-sm">
                            <template x-for="item in filters" :key="item.value">
                                <button type="button"
                                    @click="selectFilter(item)"
                                    class="block w-full text-left px-4 py-2 hover:bg-slate-100">
                                    <span x-text="item.label"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- MULTIPLE TOGGLE -->
                    <button type="button"
                        @click="toggleMultiple"
                        :class="multiple ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-500'"
                        class="px-3 py-2 rounded-lg text-xs font-semibold">
                        Multiple
                    </button>


                    <!-- INPUT AREA -->
                    <!-- INPUT AREA -->
                    <div class="flex-1">
                        <input
                            type="text"
                            x-model="input"
                            placeholder="Pisahkan dengan koma, contoh: 1001631410,101231231"
                            class="w-full px-3 py-2 text-sm focus:outline-none">
                    </div>


                    <!-- SUBMIT -->
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700">
                        Cari
                    </button>
                </div>
                <input type="hidden" name="filter_key" :value="selectedFilter">
                <input type="hidden" name="filter_values" :value="input">

            </form>

            <!-- ================= TABLE ================= -->
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
                            <th
                                class="sticky left-0 z-30 bg-slate-50 px-4 py-3 border-r border-slate-200">

                                NDE JT
                            </th>

                            @foreach (['Starclick ID', 'Nama', 'Nama Mitra', 'Alamat', 'Telepon', 'Tikor', 'Datel', 'STO', 'Status Alokasi', 'Status Order', 'iHLD LoP ID', 'Tipe Desain', 'Total BOQ', 'Jenis Program', 'Nama CFU', 'Progres', 'Tanggal Update', 'Catatan'] as $head)
                            <th
                                class="px-4 py-4
                                        align-middle text-center
                                        whitespace-nowrap">
                                {{ $head }}
                            </th>
                            @endforeach

                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($rows as $row)
                        <tr class="hover:bg-slate-50 transition">

                            <!-- STICKY FIRST COLUMN -->
                            <td
                                class="sticky left-0 z-10
                                bg-white
                                px-4 py-4
                                font-semibold
                                border-r border-slate-100">
                                {{ $row->nde_jt ?? '-' }}
                            </td>

                            <td class="px-4 py-4">{{ $row->star_click_id ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $row->nama_customer ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $row->nama_mitra ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $row->alamat_pelanggan ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $row->telepon_pelanggan ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $row->tikor_pelanggan ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $row->datel ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $row->sto ?? '-' }}</td>

                            <!-- STATUS ALOKASI -->
                            <td class="px-4 py-4">
                                <span
                                    class="px-2 py-1 text-xs rounded-full font-medium bg-green-100 text-green-700">
                                    {{ optional($row->planning)->status_alokasi_alpro ?? '-' }}
                                </span>
                            </td>

                            <!-- STATUS ORDER -->
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">
                                    {{ optional($row->planning)->status_order ?? '-' }}
                                </span>
                            </td>

                            <td class="px-4 py-4">{{ optional($row->planning)->ihld_lop_id ?? '-' }}</td>
                            <td class="px-4 py-4">{{ optional($row->planning)->tipe_desain ?? '-' }}</td>
                            <td class="px-4 py-4">
                                {{ optional($row->planning)->total_boq
                                        ? number_format(optional($row->planning)->total_boq, 0, ',', '.')
                                        : '-' }}
                            </td>
                            <td class="px-4 py-4">{{ optional($row->planning)->jenis_program ?? '-' }}</td>
                            <td class="px-4 py-4">{{ optional($row->planning)->nama_cfu ?? '-' }}</td>

                            <!-- PROGRES -->
                            <td class="px-4 py-4">
                                <span
                                    class="inline-flex min-w-[120px] justify-center
                                    rounded-full
                                    px-3 py-1
                                    text-xs font-medium
                                {{ optional($row->planning)->progres === 'COMPLETED PS'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ optional($row->planning)->progres ?? '-' }}
                                </span>
                            </td>

                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ optional($row->planning)->tanggal_update_progres
                                            ? optional($row->planning)->tanggal_update_progres->format('d-m-Y')
                                            : '-' }}
                            </td>

                            <td class="px-4 py-4 text-slate-600">
                                {{ $row->catatan ?? '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="19" class="py-12 text-center text-slate-400">
                                Data tidak ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>


        </div>
    </div>
    <div class="mt-6 flex justify-center">
        {{ $rows->links('components.pagination') }}
    </div>

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


    @endsection