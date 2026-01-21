<div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white">
    <table class="min-w-[1400px] text-sm text-slate-700">

        <!-- HEADER -->
        <thead class="sticky top-0 z-20 bg-slate-100 border-b">
            <tr class="text-xs font-semibold uppercase tracking-wide text-slate-600">
                <th class="sticky left-0 z-30 bg-slate-100 px-4 py-3 border-r">Star Click ID</th>
                <th class="px-4 py-3">Track ID</th>
                <th class="px-4 py-3">Ticket ID</th>
                <th class="px-4 py-3">Star Click Status</th>
                <th class="px-4 py-3">Status Alokasi Alpro</th>
                <th class="px-4 py-3">ID ODP Alokasi</th>
                <th class="px-4 py-3">Nama ODP Alokasi</th>
                <th class="px-4 py-3">Reservation ID</th>
                <th class="px-4 py-3">Nama Pengguna Alokasi</th>
                <th class="px-4 py-3">Username/NIK</th>
                <th class="px-4 py-3">Latitude</th>
                <th class="px-4 py-3">Longitude</th>
                <th class="px-4 py-3">Sales Code</th>
                <th class="px-4 py-3">Remark</th>
                <th class="px-4 py-3">Segment</th>
                <th class="px-4 py-3">CFU</th>
                <th class="px-4 py-3">Source App</th>
                <th class="px-4 py-3">Disurvey Pada</th>
                <th class="px-4 py-3">Estimasi Go Live</th>
                <th class="px-4 py-3">Real Go Live</th>
                <th class="px-4 py-3">Initial Date</th>
                <th class="px-4 py-3">Finish Install Date</th>
                <th class="px-4 py-3">Regional</th>
                <th class="px-4 py-3">Witel</th>
                <th class="px-4 py-3">Witel Lama</th>
                <th class="px-4 py-3">Datel</th>
                <th class="px-4 py-3">STO</th>
                <th class="px-4 py-3">WOK</th>
                <th class="px-4 py-3">Nama Customer</th>
                <th class="px-4 py-3">Telkomsel Area</th>
                <th class="px-4 py-3">Telkomsel Regional</th>
                <th class="px-4 py-3">Telkomsel Branch</th>
                <th class="px-4 py-3">Telkomsel Cluster</th>
                <th class="px-4 py-3">Status Order</th>
                <th class="px-4 py-3">Validasi Planning</th>
                <th class="px-4 py-3">iHLD LoP ID</th>
                <th class="px-4 py-3">eProposal LoP ID</th>
                <th class="px-4 py-3">eProposal Parent ID</th>
                <th class="px-4 py-3">Kode Program</th>
                <th class="px-4 py-3">Nama Proyek</th>
                <th class="px-4 py-3">Tipe Desain</th>
                <th class="px-4 py-3">Total BOQ</th>
                <th class="px-4 py-3">Capex / Port</th>
                <th class="px-4 py-3">ODP Total</th>
                <th class="px-4 py-3">Total Port</th>
                <th class="px-4 py-3">Batch Program</th>
                <th class="px-4 py-3">Status eProposal</th>
                <th class="px-4 py-3">Status TOMPS</th>
                <th class="px-4 py-3">TOMPS Last Activity</th>
                <th class="px-4 py-3">Status SAP</th>
                <th class="px-4 py-3">Status Proyek</th>
                <th class="px-4 py-3">Jenis Program</th>
                <th class="px-4 py-3">ODP Go Live</th>
                <th class="px-4 py-3">Tanggal Waiting Caring</th>
                <th class="px-4 py-3">Tanggal Submitted eProposal</th>
                <th class="px-4 py-3">Tanggal Inisiasi TOMPS</th>
                <th class="px-4 py-3">Tanggal Validasi ABD</th>
                <th class="px-4 py-3">Tanggal Go Live TOMPS</th>
                <th class="px-4 py-3">Ditambahkan Pada</th>
                <th class="px-4 py-3">Username Pembuat</th>
                <th class="px-4 py-3">Kategori Mitra</th>
                <th class="px-4 py-3">Nama Mitra</th>
                <th class="px-4 py-3">Revenue Plan</th>
                <th class="px-4 py-3">Nama CFU</th>
                <th class="px-4 py-3">Tahun</th>
                <th class="px-4 py-3">Kategori</th>
            </tr>
        </thead>

        <!-- BODY -->
        <tbody class="divide-y">
            @forelse ($rows as $row)
                <tr class="hover:bg-slate-50">
                    <td class="sticky left-0 z-10 bg-white px-4 py-3 font-medium">
                        {{ $row->star_click_id }}
                    </td>
                    <td class="px-4 py-3">{{ $row->track_id }}</td>
                    <td class="px-4 py-3">{{ $row->ticket_id }}</td>
                    <td class="px-4 py-3">{{ $row->star_click_status }}</td>
                    <td class="px-4 py-3">{{ $row->status_alokasi_alpro }}</td>
                    <td class="px-4 py-3">{{ $row->id_odp_alokasi_alpro }}</td>
                    <td class="px-4 py-3">{{ $row->nama_odp_alokasi_alpro }}</td>
                    <td class="px-4 py-3">{{ $row->reservation_id_alokasi_alpro }}</td>
                    <td class="px-4 py-3">{{ $row->nama_pengguna_melakukan_alokasi_alpro }}</td>
                    <td class="px-4 py-3">{{ $row->username_nik_alokasi_alpro }}</td>
                    <td class="px-4 py-3">{{ $row->latitude }}</td>
                    <td class="px-4 py-3">{{ $row->longitude }}</td>
                    <td class="px-4 py-3">{{ $row->sales_code }}</td>
                    <td class="px-4 py-3">{{ $row->remark }}</td>
                    <td class="px-4 py-3">{{ $row->segment }}</td>
                    <td class="px-4 py-3">{{ $row->cfu }}</td>
                    <td class="px-4 py-3">{{ $row->source_app }}</td>
                    <td class="px-4 py-3">{{ $row->disurvey_pada }}</td>
                    <td class="px-4 py-3">{{ $row->estimasi_go_live }}</td>
                    <td class="px-4 py-3">{{ $row->real_go_live }}</td>
                    <td class="px-4 py-3">{{ $row->initial_date }}</td>
                    <td class="px-4 py-3">{{ $row->finish_install_date }}</td>
                    <td class="px-4 py-3">{{ $row->regional }}</td>
                    <td class="px-4 py-3">{{ $row->witel }}</td>
                    <td class="px-4 py-3">{{ $row->witel_lama }}</td>
                    <td class="px-4 py-3">{{ $row->datel }}</td>
                    <td class="px-4 py-3">{{ $row->sto }}</td>
                    <td class="px-4 py-3">{{ $row->wok }}</td>
                    <td class="px-4 py-3">{{ $row->nama_customer }}</td>
                    <td class="px-4 py-3">{{ $row->telkomsel_area }}</td>
                    <td class="px-4 py-3">{{ $row->telkomsel_regional }}</td>
                    <td class="px-4 py-3">{{ $row->telkomsel_branch }}</td>
                    <td class="px-4 py-3">{{ $row->telkomsel_cluster }}</td>
                    <td class="px-4 py-3">{{ $row->status_order }}</td>
                    <td class="px-4 py-3">{{ $row->validasi_planning }}</td>
                    <td class="px-4 py-3">{{ $row->ihld_lop_id }}</td>
                    <td class="px-4 py-3">{{ $row->eproposal_lop_id }}</td>
                    <td class="px-4 py-3">{{ $row->eproposal_lop_parent_id }}</td>
                    <td class="px-4 py-3">{{ $row->kode_program }}</td>
                    <td class="px-4 py-3">{{ $row->nama_proyek }}</td>
                    <td class="px-4 py-3">{{ $row->tipe_desain }}</td>
                    <td class="px-4 py-3">{{ $row->total_boq }}</td>
                    <td class="px-4 py-3">{{ $row->capex_per_port }}</td>
                    <td class="px-4 py-3">{{ $row->odp_total }}</td>
                    <td class="px-4 py-3">{{ $row->total_port }}</td>
                    <td class="px-4 py-3">{{ $row->batch_program }}</td>
                    <td class="px-4 py-3">{{ $row->status_eproposal }}</td>
                    <td class="px-4 py-3">{{ $row->status_tomps }}</td>
                    <td class="px-4 py-3">{{ $row->status_tomps_last_activity }}</td>
                    <td class="px-4 py-3">{{ $row->status_sap }}</td>
                    <td class="px-4 py-3">{{ $row->status_proyek }}</td>
                    <td class="px-4 py-3">{{ $row->jenis_program }}</td>
                    <td class="px-4 py-3">{{ $row->odp_go_live }}</td>
                    <td class="px-4 py-3">{{ $row->tanggal_waiting_caring }}</td>
                    <td class="px-4 py-3">{{ $row->tanggal_submitted_to_eproposal }}</td>
                    <td class="px-4 py-3">{{ $row->tanggal_inisiasi_tomps }}</td>
                    <td class="px-4 py-3">{{ $row->tanggal_validasi_abd_tomps }}</td>
                    <td class="px-4 py-3">{{ $row->tanggal_go_live_tomps }}</td>
                    <td class="px-4 py-3">{{ $row->ditambahkan_pada }}</td>
                    <td class="px-4 py-3">{{ $row->username_nik_pembuat }}</td>
                    <td class="px-4 py-3">{{ $row->kategori_mitra }}</td>
                    <td class="px-4 py-3">{{ $row->nama_mitra }}</td>
                    <td class="px-4 py-3">{{ $row->revenue_plan }}</td>
                    <td class="px-4 py-3">{{ $row->nama_cfu }}</td>
                    <td class="px-4 py-3">{{ $row->tahun }}</td>
                    <td class="px-4 py-3">{{ $row->kategori }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="70" class="text-center py-10 text-slate-400">
                        Tidak ada data ditemukan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="mt-6 flex justify-center">
    {{ $rows->links('components.pagination') }}
</div>
