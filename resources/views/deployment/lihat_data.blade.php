@extends('layouts.app')

@section('title', 'Lihat Data')

@section('content')
<div class="flex flex-col gap-6">

    <!-- ================= FILTER CARD ================= -->
    <div class="bg-white rounded-2xl shadow-sm border p-5" style="border-color:#fde8e8; box-shadow: 0 4px 20px rgba(227,43,43,0.06);" x-data="tagSearch()">
        
        <!-- TOP: SEARCH & BASIC ACTIONS -->
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center mb-4">
             <!-- TAG INPUT SEARCH -->
             <div class="flex-1 w-full">
                <div class="relative group">
                    <div class="flex items-center gap-2 flex-wrap w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 focus-within:ring-2 focus-within:ring-red-100 focus-within:border-red-400 transition"
                         @click="$refs.searchInput.focus()">
                        
                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>

                        <!-- Tags -->
                        <template x-for="(tag, index) in tags" :key="index">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-red-100 text-red-700 animate-fade-in">
                                <span x-text="tag"></span>
                                <button type="button" @click.stop="removeTag(index)" class="ml-1.5 text-red-400 hover:text-red-600 focus:outline-none">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                            </span>
                        </template>

                        <!-- Input -->
                        <input x-ref="searchInput" type="text" 
                               x-model="input" @keydown.enter.prevent="addTag()" @keydown.backspace="handleBackspace()"
                                placeholder="Cari NDE, Starclick, Nama..."
                                class="flex-1 bg-transparent border-none text-sm 
                                        focus:ring-0 focus:outline-none outline-none
                                        placeholder-slate-400 min-w-[200px]">
                    </div>
                </div>
                
                <!-- Hidden Input for Form Submission -->
                <!-- Removed duplicate hidden input -->
             </div>

            <!-- SEARCH BUTTON -->
            <button type="button" @click="submitSearch()" 
                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-red-600 text-white text-sm font-semibold hover:bg-red-700 shadow-md hover:shadow-lg transition flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Cari
            </button>

            <button @click="showAdvanced = !showAdvanced" 
                    class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50 transition flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter Lanjutan
                <svg :class="showAdvanced ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </button>
        </div>

        <div x-show="showAdvanced" x-collapse x-cloak class="pt-4 border-t border-slate-100 space-y-4">
            <!-- MAIN FILTER FORM -->
            <form id="filterForm" method="GET" action="{{ route('deployment.lihat-data') }}">
                
                <!-- SYNC HIDDEN SEARCH INPUT FROM TAGS -->
                <input type="hidden" name="search" id="hiddenSearchInput" value="{{ request('search') }}">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                     <!-- DATE FILTERS -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" 
                               class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:ring-red-500 focus:border-red-500 p-2.5">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" 
                               class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:ring-red-500 focus:border-red-500 p-2.5">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <select name="status_order" class="rounded-xl border-slate-200 bg-slate-50 text-sm focus:ring-red-500 focus:border-red-500 p-2.5">
                        <option value="">Semua Status Order</option>
                        @foreach ($filters['status_orders'] as $item)
                            <option value="{{ $item }}" {{ request('status_order') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>

                    <select name="sto" class="rounded-xl border-slate-200 bg-slate-50 text-sm focus:ring-red-500 focus:border-red-500 p-2.5">
                        <option value="">Semua STO</option>
                        @foreach ($filters['stos'] as $item)
                            <option value="{{ $item }}" {{ request('sto') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>

                    <select name="jenis_program" class="rounded-xl border-slate-200 bg-slate-50 text-sm focus:ring-red-500 focus:border-red-500 p-2.5">
                        <option value="">Semua Jenis Program</option>
                        @foreach ($filters['jenis_programs'] as $item)
                            <option value="{{ $item }}" {{ request('jenis_program') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-red-600 text-white rounded-xl px-4 py-2.5 text-sm font-semibold hover:bg-red-700 transition shadow-sm">
                        Terapkan Filter
                    </button>
                </div>

            </form>
        </div>
    </div>


    <!-- ================= TABLE CARD ================= -->
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden" style="border-color:#fde8e8; box-shadow: 0 4px 20px rgba(227,43,43,0.06);">
        <div id="table-container" class="relative">
            <!-- LOADING OVERLAY -->
            <div id="tableLoading" class="hidden absolute inset-0 bg-white/90 z-20 flex items-center justify-center">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-8 h-8 border-4 rounded-full animate-spin" style="border-color:#fde8e8; border-top-color:#e32b2b;"></div>
                    <span class="text-sm font-medium text-slate-500">Memuat data...</span>
                </div>
            </div>
            @include('deployment.partials.lihat-data-table', ['rows' => $rows])
        </div>
    </div>
</div>

@push('scripts')
<script>
    function tagSearch() {
        return {
            input: '',
            tags: [],
            showAdvanced: false,

            init() {
                // Initialize tags from URL if exists
                const searchParams = new URLSearchParams(window.location.search);
                const search = searchParams.get('search');
                if (search) {
                    this.tags = search.split(',').filter(item => item.trim() !== '');
                }
            },

            addTag() {
                if (this.input.trim() !== '' && !this.tags.includes(this.input.trim())) {
                    this.tags.push(this.input.trim());
                    this.input = '';
                    this.updateHiddenInput();
                }
            },

            removeTag(index) {
                this.tags.splice(index, 1);
                this.updateHiddenInput();
            },

            handleBackspace() {
                if (this.input === '' && this.tags.length > 0) {
                    this.tags.pop();
                    this.updateHiddenInput();
                }
            },

            updateHiddenInput() {
                // Sync to hidden input in the main form
                const hiddenInput = document.getElementById('hiddenSearchInput');
                if(hiddenInput) {
                    hiddenInput.value = this.tags.join(',');
                }
            },

            submitSearch() {
                // If there is text in input, add it as tag first
                if (this.input.trim() !== '') {
                    this.addTag();
                }
                
                // Show loading overlay
                const loading = document.getElementById('tableLoading');
                if (loading) loading.classList.remove('hidden');

                // Wait for Alpine to process updates then submit
                this.$nextTick(() => {
                    document.getElementById('filterForm').submit();
                });
            }
        }
    }

    /* ===== AJAX PAGINATION INTERCEPT ===== */
    function ajaxFetch(url) {
        const tableContainer = document.getElementById('table-container');
        const loading = document.getElementById('tableLoading');

        if (loading) loading.classList.remove('hidden');

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            if (loading) loading.classList.add('hidden');
            tableContainer.innerHTML = html;
            bindPaginationLinks();
        })
        .catch(() => {
            if (loading) loading.classList.add('hidden');
        });
    }

    function bindPaginationLinks() {
        const tableContainer = document.getElementById('table-container');
        if (!tableContainer) return;
        tableContainer.querySelectorAll('a[href]').forEach(link => {
            // Only intercept pagination links (contain ?page= or &page=)
            if (link.href.includes('page=')) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    ajaxFetch(this.href);
                });
            }
        });
    }

    document.addEventListener('turbo:load', function() {
        bindPaginationLinks();
    });
</script>
@endpush
@endsection