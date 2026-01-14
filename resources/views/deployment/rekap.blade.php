@extends('layouts.app')

@section('title', 'Rekap B2B')

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
        <span class="font-semibold text-slate-800">Rekap Data</span>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <!-- ================= FILTER ================= -->
        <form method="GET" action="{{ route('deployment.b2b') }}"
            class="mb-4 grid grid-cols-1 md:grid-cols-6 gap-3">

            <input type="text" name="starclick"
                value="{{ request('starclick') }}"
                placeholder="Starclick / NCX"
                class="px-3 py-2 border rounded-lg text-sm focus:ring focus:ring-red-200">

            <input type="text" name="nama"
                value="{{ request('nama') }}"
                placeholder="Nama Pelanggan"
                class="px-3 py-2 border rounded-lg text-sm focus:ring focus:ring-red-200">

            <select name="status_order"
                    class="px-3 py-2 border rounded-lg text-sm">
                <option value="">Status Order</option>
                <option value="Completed Order PT1" {{ request('status_order')=='Completed Order PT1'?'selected':'' }}>
                    Completed Order PT1
                </option>
                <option value="On Progress" {{ request('status_order')=='On Progress'?'selected':'' }}>
                    On Progress
                </option>
            </select>

            <select name="tipe_desain"
                    class="px-3 py-2 border rounded-lg text-sm">
                <option value="">Tipe Desain</option>
                <option value="PT2-AERIAL" {{ request('tipe_desain')=='PT2-AERIAL'?'selected':'' }}>
                    PT2-AERIAL
                </option>
                <option value="PT1" {{ request('tipe_desain')=='PT1'?'selected':'' }}>
                    PT1
                </option>
            </select>

            <select name="jenis_program"
                    class="px-3 py-2 border rounded-lg text-sm">
                <option value="">Jenis Program</option>
                <option value="EBIS-DBS" {{ request('jenis_program')=='EBIS-DBS'?'selected':'' }}>
                    EBIS-DBS
                </option>
            </select>

            <select name="sto"
                    class="px-3 py-2 border rounded-lg text-sm">
                <option value="">STO</option>
                <option value="ARJAWINANGUN" {{ request('sto')=='ARJAWINANGUN'?'selected':'' }}>
                    ARJAWINANGUN
                </option>
            </select>

            <!-- BUTTON -->
            <div class="md:col-span-6 flex gap-2">
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700">
                    Filter
                </button>

                <a href="{{ route('deployment.b2b') }}"
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                    Reset
                </a>
            </div>
        </form>


        <!-- 👉 SCROLL AREA (HANYA TABEL) -->
        <div class="overflow-x-auto rounded-xl border">

            <table class="min-w-[2000px] text-sm text-left border-collapse">

                <!-- HEADER -->
                <thead class="bg-red-600 text-white sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-3 font-medium sticky left-0 bg-red-600 z-20">
                            NDE JT
                        </th>
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

                <!-- BODY -->
                <tbody class="divide-y">
                    @forelse ($filtered as $row)
                    <tr class="hover:bg-slate-50">

                        <td class="px-4 py-3 sticky left-0 bg-white font-medium">
                            {{ $row['nde'] ?? '-' }}
                        </td>

                        <td class="px-4 py-3">{{ $row['starclick'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['track_id'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['nama'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['alamat'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['telepon'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['tikor'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['datel'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['sto'] ?? '-' }}</td>

                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                {{ $row['status_alpro'] ?? '-' }}
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">
                                {{ $row['status_order'] ?? '-' }}
                            </span>
                        </td>

                        <td class="px-4 py-3">{{ $row['ihld'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['tipe_desain'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['boq'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['jenis_program'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['cfu'] ?? '-' }}</td>

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
@endsection
