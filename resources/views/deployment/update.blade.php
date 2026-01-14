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

                    <!-- HEADER -->
                    <thead class="bg-red-600 text-white uppercase text-xs">
                        <tr>
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
                        </tr>
                    </thead>

                    <!-- BODY -->
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
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="69" class="text-center py-10 text-slate-400">
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
