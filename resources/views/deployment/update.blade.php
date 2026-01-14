@extends('layouts.app')

@section('title', 'Update Data')

@section('content')
<div class="flex flex-col gap-6">

    <!-- BREADCRUMB -->
    <div class="flex items-center gap-3 text-sm text-slate-500">
        <a href="{{ route('dashboard') }}" class="hover:text-red-600">Dashboard</a>
        <span>›</span>
        <a href="{{ route('deployment.b2b') }}" class="hover:text-red-600">B2B</a>
        <span>›</span>
        <span class="font-semibold text-slate-800">Update</span>
    </div>

    <div class="bg-white rounded-2xl shadow-sm">

<<<<<<< HEAD
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
=======
        <!-- SEARCH -->
        <div class="px-5 py-4 border-b">
            <input type="text" id="tableSearch"
                   placeholder="Cari data..."
                   class="w-72 rounded-xl border px-3 py-2 text-sm
                          focus:ring-2 focus:ring-red-500 focus:outline-none">
        </div>

        <!-- TABLE -->
        <div class="p-5">
            <div class="overflow-x-auto border rounded-xl">

                <table id="dataTable"
                       class="table-auto text-xs w-full whitespace-nowrap">
>>>>>>> 1d700439e6cbdbdfb0801e2185fa2d650fb60b16

                    <!-- HEADER -->
                    <thead class="bg-red-600 text-white uppercase text-xs">
                        <tr>
<<<<<<< HEAD
                            <th class="px-4 py-3 text-left w-40">Star Click ID</th>
                            <th class="px-4 py-3 text-left w-64">Nama Pelanggan</th>
                            <th class="px-4 py-3 text-left w-24">Datel</th>
                            <th class="px-4 py-3 text-center w-32">STO</th>
                            <th class="px-4 py-3 text-left w-40">Status Order</th>
                            <th class="px-4 py-3 text-left w-32">Tipe Desain</th>
                            <th class="px-4 py-3 text-left w-24">Progres</th>
                            <th class="px-4 py-3 text-left w-32">Tanggal Update</th>
                            <th class="px-4 py-3 text-center w-20">Action</th>
=======
                            <th>Star Click ID</th>
                            <th>Track ID</th>
                            <th>Ticket ID</th>
                            <th>Star Click Status</th>
                            <th>Status Alokasi Alpro</th>
                            <th>ID ODP Alokasi</th>
                            <th>Nama ODP Alokasi</th>
                            <th>Reservation ID</th>
                            <th>Nama Pengguna Alokasi</th>
                            <th>Username/NIK Alokasi</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Sales Code</th>
                            <th>Remark</th>
                            <th>Segment</th>
                            <th>CFU</th>
                            <th>Source App</th>
                            <th>Disurvey Pada</th>
                            <th>Estimasi Go Live</th>
                            <th>Real Go Live</th>
                            <th>Initial Date</th>
                            <th>Finish Install</th>
                            <th>Regional</th>
                            <th>Witel</th>
                            <th>Witel Lama</th>
                            <th>Datel</th>
                            <th>STO</th>
                            <th>WOK</th>
                            <th>Nama Customer</th>
                            <th>Telkomsel Area</th>
                            <th>Telkomsel Regional</th>
                            <th>Telkomsel Branch</th>
                            <th>Telkomsel Cluster</th>
                            <th>Status Order</th>
                            <th>Validasi Planning</th>
                            <th>iHLD LoP ID</th>
                            <th>eProposal LoP ID</th>
                            <th>eProposal Parent ID</th>
                            <th>Kode Program</th>
                            <th>Nama Proyek</th>
                            <th>Tipe Desain</th>
                            <th>Total BOQ</th>
                            <th>Capex / Port</th>
                            <th>ODP Total</th>
                            <th>Total Port</th>
                            <th>Batch Program</th>
                            <th>Status eProposal</th>
                            <th>Status Tomps</th>
                            <th>Status Tomps Update</th>
                            <th>Status SAP</th>
                            <th>Status Proyek</th>
                            <th>ODP Go Live</th>
                            <th>Tgl Waiting Caring</th>
                            <th>Tgl Submit eProposal</th>
                            <th>Tgl Inisiasi Tomps</th>
                            <th>Tgl Validasi ABD</th>
                            <th>Tgl Go Live Tomps</th>
                            <th>Dibuat</th>
                            <th>Diperbarui</th>
                            <th>Dihapus</th>
                            <th>Ditambahkan</th>
                            <th>Username Pembuat</th>
                            <th>Kategori Mitra</th>
                            <th>Nama Mitra</th>
                            <th>Revenue Plan</th>
                            <th>Nama CFU</th>
                            <th>Tahun</th>
                            <th>Jenis Program</th>
                            <th>Action</th>
>>>>>>> 1d700439e6cbdbdfb0801e2185fa2d650fb60b16
                        </tr>
                    </thead>

                    <!-- BODY -->
<<<<<<< HEAD
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
                                {{ $row->tanggal_update ?? '-' }}
                            </td>

                            <!-- ACTION -->
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('deployment.edit', $row->id) }}"
                                   class="inline-flex items-center justify-center
                                          px-3 py-1.5 text-xs font-medium
                                          bg-blue-600 text-white
                                          rounded-lg
                                          hover:bg-blue-700 transition">
                                    Edit
=======
                    <tbody class="divide-y text-slate-700">
                    @forelse ($rows as $row)
                        <tr class="hover:bg-red-50">
                            <td>{{ $row->star_click_id }}</td>
                            <td>{{ $row->track_id }}</td>
                            <td>{{ $row->ticket_id }}</td>
                            <td>{{ $row->star_click_status }}</td>
                            <td>{{ $row->status_alokasi_alpro }}</td>
                            <td>{{ $row->id_odp_alokasi }}</td>
                            <td>{{ $row->nama_odp_alokasi_alpro }}</td>
                            <td>{{ $row->reservation_id_alokasi_alpro }}</td>
                            <td>{{ $row->nama_pengguna_alokasi_alpro }}</td>
                            <td>{{ $row->username_nik_alokasi_alpro }}</td>
                            <td>{{ $row->latitude }}</td>
                            <td>{{ $row->longitude }}</td>
                            <td>{{ $row->sales_code }}</td>
                            <td>{{ $row->remark }}</td>
                            <td>{{ $row->segment }}</td>
                            <td>{{ $row->cfu }}</td>
                            <td>{{ $row->source_app }}</td>
                            <td>{{ $row->disurvey_pada }}</td>
                            <td>{{ $row->estimasi_go_live }}</td>
                            <td>{{ $row->real_go_live }}</td>
                            <td>{{ $row->initial_date }}</td>
                            <td>{{ $row->finish_install_date }}</td>
                            <td>{{ $row->regional }}</td>
                            <td>{{ $row->witel }}</td>
                            <td>{{ $row->witel_lama }}</td>
                            <td>{{ $row->datel }}</td>
                            <td>{{ $row->sto }}</td>
                            <td>{{ $row->wok }}</td>
                            <td>{{ $row->nama_customer }}</td>
                            <td>{{ $row->telkomsel_area }}</td>
                            <td>{{ $row->telkomsel_regional }}</td>
                            <td>{{ $row->telkomsel_branch }}</td>
                            <td>{{ $row->telkomsel_cluster }}</td>
                            <td>{{ $row->status_order }}</td>
                            <td>{{ $row->validasi_planning }}</td>
                            <td>{{ $row->ihld_lop_id }}</td>
                            <td>{{ $row->eproposal_lop_id }}</td>
                            <td>{{ $row->eproposal_lop_parent_id }}</td>
                            <td>{{ $row->kode_program }}</td>
                            <td>{{ $row->nama_proyek }}</td>
                            <td>{{ $row->tipe_desain }}</td>
                            <td>{{ $row->total_boq }}</td>
                            <td>{{ $row->capex_per_port }}</td>
                            <td>{{ $row->odp_total }}</td>
                            <td>{{ $row->total_port }}</td>
                            <td>{{ $row->batch_program }}</td>
                            <td>{{ $row->status_eproposal }}</td>
                            <td>{{ $row->status_tomps }}</td>
                            <td>{{ $row->status_tomps_last_update }}</td>
                            <td>{{ $row->status_sap }}</td>
                            <td>{{ $row->status_proyek }}</td>
                            <td>{{ $row->odp_go_live }}</td>
                            <td>{{ $row->tanggal_waiting_caring }}</td>
                            <td>{{ $row->tanggal_submitted_to_eproposal }}</td>
                            <td>{{ $row->tanggal_inisiasi_tomps }}</td>
                            <td>{{ $row->tanggal_validasi_abd_tomps }}</td>
                            <td>{{ $row->tanggal_go_live_tomps }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->updated_at }}</td>
                            <td>{{ $row->deleted_at }}</td>
                            <td>{{ $row->ditambahkan_pada }}</td>
                            <td>{{ $row->username_nik_pembuat }}</td>
                            <td>{{ $row->kategori_mitra }}</td>
                            <td>{{ $row->nama_mitra }}</td>
                            <td>{{ $row->revenue_plan }}</td>
                            <td>{{ $row->nama_cfu }}</td>
                            <td>{{ $row->tahun }}</td>
                            <td>{{ $row->jenis_program }}</td>
                            <td>
                                <a href="{{ route('deployment.edit', $row->id) }}"
                                   class="text-blue-600 hover:underline">
                                   Edit
>>>>>>> 1d700439e6cbdbdfb0801e2185fa2d650fb60b16
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
<<<<<<< HEAD
                            <td colspan="9"
                                class="text-center py-12 text-slate-400">
=======
                            <td colspan="69" class="text-center py-10 text-slate-400">
>>>>>>> 1d700439e6cbdbdfb0801e2185fa2d650fb60b16
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
        row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
    });
});
</script>
@endpush
