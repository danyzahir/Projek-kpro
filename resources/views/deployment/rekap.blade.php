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

            <!-- ================= FILTER (MANUAL INPUT) ================= -->
            <form method="GET" action="{{ route('deployment.rekap') }}" class="mb-4 grid grid-cols-1 md:grid-cols-6 gap-3">

                <input type="text" name="star_click_id" value="{{ request('star_click_id') }}"
                    placeholder="Starclick / NCX" class="px-3 py-2 border rounded-lg text-sm focus:ring focus:ring-red-200">

                <input type="text" name="nama_customer" value="{{ request('nama_customer') }}"
                    placeholder="Nama Pelanggan" class="px-3 py-2 border rounded-lg text-sm focus:ring focus:ring-red-200">

                <input type="text" name="status_order" value="{{ request('status_order') }}" placeholder="Status Order"
                    class="px-3 py-2 border rounded-lg text-sm focus:ring focus:ring-red-200">

                <input type="text" name="tipe_desain" value="{{ request('tipe_desain') }}" placeholder="Tipe Desain"
                    class="px-3 py-2 border rounded-lg text-sm focus:ring focus:ring-red-200">

                <input type="text" name="jenis_program" value="{{ request('jenis_program') }}"
                    placeholder="Jenis Program" class="px-3 py-2 border rounded-lg text-sm focus:ring focus:ring-red-200">

                <input type="text" name="sto" value="{{ request('sto') }}" placeholder="STO"
                    class="px-3 py-2 border rounded-lg text-sm focus:ring focus:ring-red-200">

                <!-- BUTTON -->
                <div class="md:col-span-6 flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700">
                        Filter
                    </button>
                    
                </div>
            </form>

            <!-- ================= TABLE ================= -->
            <div class="overflow-x-auto rounded-xl border">
                <table class="min-w-[2000px] text-sm text-left border-collapse">

                    <!-- HEADER -->
                    <thead class="bg-red-600 text-white sticky top-0 z-10">
                        <tr>
                            <th class="px-4 py-3 sticky left-0 bg-red-600 z-20">NDE JT</th>
                            <th class="px-4 py-3">Starclick / NCX</th>

                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Nama Mitra</th>
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
                            <th class="px-4 py-3">Progres</th>
                            <th class="px-4 py-3">Tanggal Update</th>
                            <th class="px-4 py-3">Catatan</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody class="divide-y">
                        @forelse ($rows as $row)
                            <tr class="hover:bg-slate-50">

                                <!-- DATA INPUT (ebis_manual_inputs) -->
                                <td class="px-4 py-3 sticky left-0 bg-white font-medium">
                                    {{ $row->nde_jt ?? '-' }}
                                </td>

                                <td class="px-4 py-3">{{ $row->star_click_id ?? '-' }}</td>

                                <td class="px-4 py-3">{{ $row->nama_customer ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $row->nama_mitra ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $row->alamat_pelanggan ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $row->telepon_pelanggan ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $row->tikor_pelanggan ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $row->datel ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $row->sto ?? '-' }}</td>

                                <!-- DATA UPLOAD (ebis_planning_orders) -->
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
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
                                <td class="px-4 py-3">{{ optional($row->planning)->total_boq ?? '-' }}</td>
                                <td class="px-4 py-3">{{ optional($row->planning)->jenis_program ?? '-' }}</td>
                                <td class="px-4 py-3">{{ optional($row->planning)->nama_cfu ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 text-xs rounded
                                             {{ optional($row->planning)->progres === 'COMPLETED PS'
                                                 ? 'bg-green-100 text-green-700'
                                                 : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ optional($row->planning)->progres ?? '-' }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">
                                    {{ optional($row->planning)->tanggal_update_progres
                                        ? optional($row->planning)->tanggal_update_progres->format('d-m-Y')
                                        : '-' }}
                                </td>
                                <td class="px-4 py-3">{{ $row->catatan ?? '-' }}</td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="16" class="py-6 text-center text-slate-500">
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

@endsection
