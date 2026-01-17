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
        <span class="font-semibold text-slate-800">Update</span>
    </div>

    <!-- ================= CARD ================= -->
    <div class="bg-white rounded-2xl shadow-sm">

        <!-- ================= TOOLBAR ================= -->
        <div class="px-6 py-4 border-b flex items-center justify-between">
            <input
                type="text"
                id="tableSearch"
                placeholder="Cari data..."
                class="w-72 rounded-xl border border-slate-300
                       px-4 py-2 text-sm
                       focus:ring-2 focus:ring-red-500
                       focus:outline-none">
        </div>

        <!-- ================= TABLE ================= -->
        <div class="p-6">
            <div class="overflow-x-auto border rounded-xl max-w-7xl mx-auto">

                <table id="dataTable"
                    class="table-fixed w-full text-sm leading-relaxed">

                    <!-- HEADER -->
                    <thead class="bg-red-600 text-white text-xs uppercase tracking-wide">
                        <tr>
                            <th class="px-4 py-3 text-left w-40">Star Click ID</th>
                            <th class="px-4 py-3 text-left w-64">Nama Pelanggan</th>
                            <th class="px-4 py-3 text-left w-24">Datel</th>
                            <th class="px-4 py-3 text-center w-32">STO</th>
                            <th class="px-4 py-3 text-left w-40">Status Order</th>
                            <th class="px-4 py-3 text-left w-32">Tipe Desain</th>
                            <th class="px-4 py-3 text-left w-24">Progres</th>
                            <th class="px-4 py-3 text-left w-32">Tanggal Update</th>
                            <th class="px-4 py-3 text-center w-20">Action</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody class="divide-y divide-slate-200 text-slate-700">

                        @forelse ($rows as $row)
                        <tr class="hover:bg-red-50 transition">

                            <td class="px-4 py-3 font-medium whitespace-nowrap">
                                {{ $row->star_click_id ?? '-' }}
                            </td>

                            <td class="px-4 py-3 break-words leading-snug">
                                {{ $row->nama_customer }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $row->datel }}
                            </td>

                            <td class="px-4 py-3 text-center whitespace-nowrap">
                                {{ $row->sto }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $row->status_order }}
                            </td>

                            <td class="px-4 py-3 truncate">
                                {{ $row->tipe_desain ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $row->progres ?? '-' }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ optional($row->tanggal_update_progres)->format('d-m-Y') ?? '-' }}
                            </td>

                            <!-- ACTION -->
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('deployment.edit', $row->id) }}"
                                    class="inline-flex items-center justify-center
                                          px-3 py-1.5 text-xs font-medium
                                          bg-blue-600 text-white
                                          rounded-lg
                                          hover:bg-blue-700 transition">
                                    Update
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="9"
                                class="text-center py-12 text-slate-400">
                                Tidak ada data
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
    document.getElementById('tableSearch').addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        document.querySelectorAll('#dataTable tbody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ?
                '' :
                'none';
        });
    });
</script>
@endpush