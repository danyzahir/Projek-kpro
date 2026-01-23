<div class="relative overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-[1600px] text-sm text-slate-700">

        <!-- HEADER -->
        <thead
            class="sticky top-0 z-20
                   bg-slate-50
                   text-[11px] font-semibold uppercase tracking-wider
                   text-slate-500
                   border-b border-slate-200">

            <tr>
                <th class="sticky left-0 z-30 bg-slate-50 px-4 py-3 border-r border-slate-200">
                    Star Click ID
                </th>

                @foreach ([
                    'Track ID','Ticket ID','Star Click Status','Status Alokasi Alpro',
                    'ID ODP','Nama ODP','Reservation ID','Nama Pengguna','Username/NIK',
                    'Latitude','Longitude','Sales Code','Remark','Segment','CFU',
                    'Source App','Disurvey Pada','Estimasi Go Live','Real Go Live',
                    'Initial Date','Finish Install Date','Regional','Witel','Witel Lama',
                    'Datel','STO','WOK','Nama Customer','Telkomsel Area','Telkomsel Regional',
                    'Telkomsel Branch','Telkomsel Cluster','Status Order','Validasi Planning',
                    'iHLD LoP ID','eProposal LoP ID','eProposal Parent ID','Kode Program',
                    'Nama Proyek','Tipe Desain','Total BOQ','Capex / Port','ODP Total',
                    'Total Port','Batch Program','Status eProposal','Status TOMPS',
                    'TOMPS Last Activity','Status SAP','Status Proyek','Jenis Program',
                    'ODP Go Live','Waiting Caring','Submitted eProposal',
                    'Inisiasi TOMPS','Validasi ABD','Go Live TOMPS','Ditambahkan Pada',
                    'Username Pembuat','Kategori Mitra','Nama Mitra',
                    'Revenue Plan','Nama CFU','Tahun','Kategori'
                ] as $head)
                    <th class="px-4 py-3 whitespace-nowrap">
                        {{ $head }}
                    </th>
                @endforeach
            </tr>
        </thead>

        <!-- BODY -->
        <tbody class="divide-y divide-slate-100">
            @forelse ($rows as $row)
                <tr class="hover:bg-slate-50 transition">

                    <!-- STICKY FIRST COLUMN -->
                    <td
                        class="sticky left-0 z-10 bg-white px-4 py-3 font-semibold
                               border-r border-slate-100">
                        {{ $row->star_click_id ?? '-' }}
                    </td>

                    <td class="px-4 py-3">{{ $row->track_id }}</td>
                    <td class="px-4 py-3">{{ $row->ticket_id }}</td>

                    <!-- STATUS BADGE -->
                    <td class="px-4 py-3">
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium
                            {{ $row->star_click_status === 'ACTIVE'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-slate-100 text-slate-600' }}">
                            {{ $row->star_click_status }}
                        </span>
                    </td>

                    <td class="px-4 py-3">
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium
                            {{ $row->status_alokasi_alpro === 'OK'
                                ? 'bg-blue-100 text-blue-700'
                                : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $row->status_alokasi_alpro }}
                        </span>
                    </td>

                    <td class="px-4 py-3">{{ $row->id_odp_alokasi_alpro }}</td>
                    <td class="px-4 py-3">{{ $row->nama_odp_alokasi_alpro }}</td>
                    <td class="px-4 py-3">{{ $row->reservation_id_alokasi_alpro }}</td>
                    <td class="px-4 py-3">{{ $row->nama_pengguna_melakukan_alokasi_alpro }}</td>
                    <td class="px-4 py-3">{{ $row->username_nik_alokasi_alpro }}</td>

                    <td class="px-4 py-3 tabular-nums">{{ $row->latitude }}</td>
                    <td class="px-4 py-3 tabular-nums">{{ $row->longitude }}</td>

                    <td class="px-4 py-3">{{ $row->sales_code }}</td>
                    <td class="px-4 py-3 text-slate-500">{{ $row->remark }}</td>

                    <!-- sisanya biarkan sama -->
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
                    <td colspan="70" class="py-12 text-center text-slate-400">
                        Data tidak ditemukan
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
