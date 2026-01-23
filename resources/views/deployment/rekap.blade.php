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
                                <td class="px-4 py-4">{{ optional($row->planning)->total_boq ?? '-' }}</td>
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

@endsection
