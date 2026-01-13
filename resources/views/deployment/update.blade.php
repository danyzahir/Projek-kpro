@extends('layouts.app')

@section('title', 'Update Data')

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

        <!-- TOOLBAR -->
        <div class="px-5 py-4 border-b flex items-center justify-between">
            <input
                type="text"
                id="tableSearch"
                placeholder="Cari data..."
                class="w-64 rounded-xl border border-slate-300
                       px-3 py-2 text-sm
                       focus:ring-2 focus:ring-red-500
                       focus:outline-none">
        </div>

        <!-- TABLE WRAPPER -->
        <div class="p-5">
            <div class="overflow-x-auto border rounded-xl max-w-6xl mx-auto">

                <table id="dataTable"
                       class="table-fixed text-sm w-full">

                    <!-- HEADER -->
                    <thead class="bg-red-600 text-white text-xs uppercase tracking-wide">
                        <tr>
                            <th class="px-3 py-3 text-left w-56">Track ID</th>
                            <th class="px-3 py-3 text-left w-28">Datel</th>
                            <th class="px-3 py-3 text-left w-20">STO</th>
                            <th class="px-3 py-3 text-left w-36">Status Order</th>
                            <th class="px-3 py-3 text-left w-36">Tipe Desain</th>
                            <th class="px-3 py-3 text-left w-32">Jenis Program</th>
                            <th class="px-2 py-3 text-center w-16">Action</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody class="divide-y text-slate-700">

                        @forelse ($rows as $row)
                        <tr class="hover:bg-red-50 transition">

                            <td class="px-3 py-2 w-56 font-medium truncate">
                                {{ $row->track_id ?? '-' }}
                            </td>

                            <td class="px-3 py-2 w-28">
                                {{ $row->datel }}
                            </td>

                            <td class="px-3 py-2 w-20">
                                {{ $row->sto }}
                            </td>

                            <td class="px-3 py-2 w-36 truncate">
                                {{ $row->status_order }}
                            </td>

                            <td class="px-3 py-2 w-36 truncate">
                                {{ $row->tipe_desain }}
                            </td>

                            <td class="px-3 py-2 w-32 truncate">
                                {{ $row->jenis_program ?? '-' }}
                            </td>

                            <!-- ACTION -->
                            <td class="px-2 py-2 w-16 text-center">
                                <a href="{{ route('deployment.edit', $row->id) }}"
                                   class="inline-flex items-center
                                          px-2.5 py-1 text-xs font-medium
                                          bg-blue-600 text-white
                                          rounded-md
                                          hover:bg-blue-700 transition">
                                    Edit
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6"
                                class="text-center py-10 text-slate-400">
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
@endsection

@push('scripts')
<script>
document.getElementById('tableSearch').addEventListener('keyup', function () {
    const value = this.value.toLowerCase();
    document.querySelectorAll('#dataTable tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value)
            ? ''
            : 'none';
    });
});
</script>
@endpush
