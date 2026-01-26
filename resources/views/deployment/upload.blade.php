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
          
                <input
                    type="text"
                    id="searchInput"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari data..."
                    class="w-64 rounded-lg border px-3 py-2 text-sm">
            

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
        <div class="p-4" id="table-container">
            @include('deployment.partials.table', ['rows' => $rows])>
        </div>
    </div>

</div>

 <div id="loadingOverlay"
        class="fixed inset-0 z-50 hidden items-center justify-center
        pointer-events-auto">

        <div class="bg-white rounded-2xl p-6 w-72 text-center shadow-xl">

            <!-- SPINNER -->
            <div class="flex justify-center mb-4">
                <div class="spinner"></div>
            </div>

            <p class="text-sm font-semibold text-slate-700">
                Mengimpor data, mohon tunggu...
            </p>

            <p class="text-xs text-slate-500 mt-1">
                Jangan tutup halaman ini
            </p>
        </div>
    </div>
@endsection

@push('scripts')
<style>
    /* SPINNER */
    .spinner {
        border: 4px solid rgba(0, 0, 0, 0.1);
        border-left-color: #ef4444; /* red-500 */
        border-radius: 50%;
        width: 36px;
        height: 36px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
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
        const searchInput = document.getElementById('searchInput');
        const tableContainer = document.getElementById('table-container');
        let timeout = null;

        searchInput.addEventListener('keyup', function() {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                fetch(`{{ route('deployment.upload') }}?search=${encodeURIComponent(this.value)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        tableContainer.innerHTML = html;
                    });
            }, 400);
        });
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
@endpush