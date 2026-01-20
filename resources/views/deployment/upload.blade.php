@extends('layouts.app')

@section('title', 'Input Data')

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
            <span class="font-semibold text-slate-800">Upload</span>
        </div>

        <!-- ================= CARD ================= -->
        <div class="bg-white rounded-xl shadow-sm">
            

            <!-- TOOLBAR -->
            <div class="p-4 border-b flex flex-wrap items-center justify-between gap-4">
               <form method="GET" action="{{ route('deployment.upload') }}">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari data..."
                        class="w-64 rounded-lg border px-3 py-2 text-sm">
                </form>

                <div class="flex gap-2">

                    <!-- IMPORT -->
                    <form id="importForm"
      action="{{ route('ebis.import') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    <label
        class="flex items-center gap-2
               px-4 py-2 text-sm rounded-lg
               bg-slate-100 hover:bg-slate-200
               cursor-pointer transition">

        <!-- ICON UPLOAD -->
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4 text-slate-600"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12V4m0 0l-4 4m4-4l4 4" />
        </svg>

        <span>Import</span>

        <input type="file"
               name="file"
               class="hidden"
               required
               onchange="submitImport()">
    </label>
</form>


                </div>


            </div>

            <!-- TABLE AREA (ADA PADDING) -->
            <div class="p-4">

                <!-- SCROLL HANYA DI SINI -->
                <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white">
                    <table class="min-w-[1400px] text-sm text-slate-700">

                        <!-- HEADER -->
                        <thead class="sticky top-0 z-20 bg-slate-100 border-b">
                            <tr class="text-xs font-semibold uppercase tracking-wide text-slate-600">
                                <th class="sticky left-0 z-30 bg-slate-100 px-4 py-3 border-r">
                                    Star Click ID
                                </th>
                                <th class="px-4 py-3">Track ID</th>
                                <th class="px-4 py-3">Ticket ID</th>
                                <th class="px-4 py-3">Star Click Status</th>
                                <th class="px-4 py-3">Status Alokasi Alpro</th>
                                <th class="px-4 py-3">ID ODP Alokasi</th>
                                <th class="px-4 py-3">Nama ODP Alokasi</th>
                                <th class="px-4 py-3">Reservation ID Alokasi</th>
                                <th class="px-4 py-3">Nama Pengguna Alokasi</th>
                                <th class="px-4 py-3">Username/NIK Alokasi</th>
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
                        <tbody class="divide-y text-slate-700">
                            @if ($rows->count())
                                @foreach ($rows as $row)
                                    <tr class="hover:bg-slate-50">

                                        <td class="sticky left-0 z-20 bg-white px-4 py-3 font-medium">
                                            {{ $row->star_click_id }}</td>
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
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="70" class="text-center py-8 text-slate-400">
                                        Belum ada data
                                    </td>
                                </tr>
                            @endif
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

    </div>
    <div class="mt-6 flex justify-center">
        {{ $rows->links('components.pagination') }}
    </div>

   <div id="loadingOverlay"
     class="fixed inset-0 z-50 hidden items-center justify-center
            bg-transparent  pointer-events-auto">
    
    <div class="bg-white rounded-2xl p-6 w-80 text-center
                shadow-[0_25px_50px_-12px_rgba(0,0,0,0.35)] ring-1 ring-black/5">
        
        <p class="text-sm font-semibold mb-4 text-slate-700">
            Mengimpor data, mohon tunggu...
        </p>

        <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
            <div class="bg-red-600 h-2 rounded-full animate-loading"></div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <style>
        @keyframes loading {
            0% {
                width: 0%;
            }

            50% {
                width: 80%;
            }

            100% {
                width: 100%;
            }
        }

        .animate-loading {
            animation: loading 2s ease-in-out infinite;
        }
    </style>
    <script>
        /* ================= DROPDOWN ================= */
        function toggleDropdown(btn) {
            btn.nextElementSibling.classList.toggle('hidden');
        }

        function selectStatus(el, value) {
            const wrapper = el.closest('.relative');
            const button = wrapper.querySelector('.status-btn');
            const label = button.querySelector('span');
            const menu = wrapper.querySelector('.status-menu');

            button.className =
                'status-btn w-full h-9 box-border flex items-center justify-between gap-2 ' +
                'rounded-full px-4 text-xs font-semibold leading-none shadow-sm border';

            if (value === 'completed') {
                button.classList.add(
                    'bg-green-200',
                    'text-green-900',
                    'border-green-400'
                );
                label.textContent = 'Completed PS';
            } else {
                button.classList.add(
                    'bg-yellow-200',
                    'text-yellow-900',
                    'border-yellow-400'
                );
                label.textContent = 'Kendala';
            }

            menu.classList.add('hidden');
        }

        /* ================= SEARCH TABLE ================= */
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('tableSearch');

            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const value = this.value.toLowerCase();
                    document.querySelectorAll('#dataTable tbody tr').forEach(row => {
                        row.style.display = row.innerText.toLowerCase().includes(value) ?
                            '' :
                            'none';
                    });
                });
            }
        });

        /* ================= IMPORT LOADING ================= */
        function submitImport() {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.classList.remove('hidden');
                overlay.classList.add('flex');
            }

            const form = document.getElementById('importForm');
            if (form) {
                form.submit();
            }
        }
    </script>
