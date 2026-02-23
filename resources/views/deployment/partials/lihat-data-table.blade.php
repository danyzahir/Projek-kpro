<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-slate-600">
        <thead class="text-xs text-slate-500 uppercase border-b border-slate-200" style="background:#fafafa;">
            <tr>
                <th class="px-6 py-4 font-semibold sticky left-0 bg-slate-50 z-10 border-r border-slate-100 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">
                    NDE JT
                </th>
                @foreach (['Starclick ID', 'Nama', 'Nama Mitra', 'Alamat', 'Telepon', 'Tikor', 'Datel', 'STO', 'Status Alokasi', 'Status Order', 'LoP ID', 'Tipe Desain', 'Total BOQ', 'Jenis Program', 'Nama CFU', 'Progres', 'Action'] as $head)
                    <th class="px-6 py-4 font-semibold whitespace-nowrap {{ $head === 'Action' ? 'text-center sticky right-0 bg-slate-50 z-10 border-l border-slate-100' : '' }}">
                        {{ $head }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($rows as $row)
            <tr class="hover:bg-red-50/30 transition group">
                <!-- NDE JT (Sticky) -->
                <td class="px-6 py-4 font-medium text-slate-900 sticky left-0 bg-white group-hover:bg-red-50 z-10 border-r border-slate-100 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">
                    {{ $row->nde_jt ?? '-' }}
                </td>

                <td class="px-6 py-4 whitespace-nowrap">{{ $row->star_click_id ?? '-' }}</td>
                <td class="px-6 py-4 min-w-[200px]">{{ $row->nama_customer ?? '-' }}</td>
                <td class="px-6 py-4 min-w-[150px]">{{ $row->nama_mitra ?? '-' }}</td>
                <td class="px-6 py-4 min-w-[250px] truncate max-w-xs" title="">{{ $row->alamat_pelanggan ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $row->telepon_pelanggan ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap font-mono text-xs">{{ $row->tikor_pelanggan ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $row->datel ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $row->sto ?? '-' }}</td>

                <!-- STATUS BADGES -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <x-status-badge :value="optional($row->planning)->status_alokasi_alpro" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <x-status-badge :value="optional($row->planning)->status_order" />
                </td>

                <td class="px-6 py-4 whitespace-nowrap">{{ optional($row->planning)->ihld_lop_id ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ optional($row->planning)->tipe_desain ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap font-mono">
                    {{ optional($row->planning)->total_boq ? number_format(optional($row->planning)->total_boq, 0, ',', '.') : '-' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <x-status-badge :value="optional($row->planning)->jenis_program" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <x-status-badge :value="optional($row->planning)->nama_cfu" />
                </td>

                <!-- PROGRES -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <x-status-badge :value="$row->progres" />
                </td>

                <!-- ACTION (Sticky Right) -->
                <td class="px-4 py-3 text-center whitespace-nowrap sticky right-0 bg-white group-hover:bg-red-50 z-10 border-l border-slate-100">
                   <div x-data="{ showDetail: false }">
                        <button @click="showDetail = true"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold
                                 bg-white border border-slate-200 text-slate-700 shadow-sm
                                 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition">
                            Lihat
                        </button>

                        <!-- MODAL -->
                        <template x-teleport="body">
                            <div x-show="showDetail" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center">
                                <!-- BACKDROP -->
                                <div x-show="showDetail" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
                                     class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="showDetail = false"></div>
                                
                                <!-- CONTENT -->
                                <div x-show="showDetail" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                                     class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[85vh] flex flex-col relative z-10 mx-4">
                                    
                                    <!-- MODAL HEADER -->
                                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50 rounded-t-2xl">
                                        <h3 class="text-lg font-bold text-slate-800">Detail Deployment</h3>
                                        <button @click="showDetail = false" class="p-2 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-slate-600 transition">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>

                                    <!-- MODAL BODY -->
                                    <div class="p-8 overflow-y-auto">
                                        
                                        <!-- SECTION 1 -->
                                        <div class="mb-8">
                                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4 pb-2 border-b border-slate-100">Informasi Pelanggan</h4>
                                            <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm">
                                                <div>
                                                    <div class="text-slate-500 text-xs mb-1">NDE JT</div>
                                                    <div class="font-medium text-slate-800">{{ $row->nde_jt ?? '-' }}</div>
                                                </div>
                                                <div>
                                                    <div class="text-slate-500 text-xs mb-1">Starclick ID</div>
                                                    <div class="font-medium text-slate-800">{{ $row->star_click_id ?? '-' }}</div>
                                                </div>
                                                <div>
                                                    <div class="text-slate-500 text-xs mb-1">Nama Pelanggan</div>
                                                    <div class="font-medium text-slate-800">{{ $row->nama_customer ?? '-' }}</div>
                                                </div>
                                                <div>
                                                    <div class="text-slate-500 text-xs mb-1">Nama Mitra</div>
                                                    <div class="font-medium text-slate-800">{{ $row->nama_mitra ?? '-' }}</div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="text-slate-500 text-xs mb-1">Alamat</div>
                                                    <div class="font-medium text-slate-800">{{ $row->alamat_pelanggan ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SECTION 2 -->
                                        <div class="mb-8">
                                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4 pb-2 border-b border-slate-100">Detail Lokasi & Teknis</h4>
                                            <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm">
                                                <div>
                                                    <div class="text-slate-500 text-xs mb-1">Datel / STO</div>
                                                    <div class="font-medium text-slate-800">{{ $row->datel ?? '-' }} / {{ $row->sto ?? '-' }}</div>
                                                </div>
                                                <div>
                                                    <div class="text-slate-500 text-xs mb-1">Tikor</div>
                                                    <div class="font-medium text-slate-800 font-mono text-xs">{{ $row->tikor_pelanggan ?? '-' }}</div>
                                                </div>
                                                <div>
                                                    <div class="text-slate-500 text-xs mb-1">Status Order</div>
                                                    <x-status-badge :value="optional($row->planning)->status_order" />
                                                </div>
                                                <div>
                                                    <div class="text-slate-500 text-xs mb-1">Status Alokasi</div>
                                                    <x-status-badge :value="optional($row->planning)->status_alokasi_alpro" />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SECTION 3: DYNAMIC DATA -->
                                        @if(!empty($row->data) && is_array($row->data))
                                        <div>
                                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4 pb-2 border-b border-slate-100">
                                                Evidence & Progres ({{ $row->progres }})
                                            </h4>
                                            <div class="space-y-4">
                                                @foreach($row->data as $key => $value)
                                                    @if($value)
                                                        <div class="flex flex-col gap-2">
                                                            <div class="text-sm font-medium text-slate-700 capitalize">{{ str_replace('_', ' ', $key) }}</div>
                                                            
                                                            @if(str_contains($key, 'evidence') && !str_starts_with($key, 'link_'))
                                                                <div class="relative group w-fit">
                                                                    <img src="{{ asset('storage/' . $value) }}" class="h-32 w-auto rounded-lg border border-slate-200 shadow-sm cursor-zoom-in" onclick="window.open(this.src)">
                                                                </div>
                                                            @elseif(str_starts_with($key, 'link_') || str_starts_with($value, 'http'))
                                                                <a href="{{ $value }}" target="_blank" class="text-blue-600 hover:text-blue-700 hover:underline text-sm break-all flex items-center gap-1">
                                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                                                    Buka Link
                                                                </a>
                                                            @else
                                                                 <div class="text-sm text-slate-600 bg-slate-50 p-3 rounded-lg border border-slate-100">
                                                                    {{ $value }}
                                                                 </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    
                                    <!-- MODAL FOOTER -->
                                    <div class="px-6 py-4 bg-slate-50 rounded-b-2xl border-t border-slate-100 flex justify-end">
                                        <button @click="showDetail = false" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 transition shadow-sm text-sm">
                                            Tutup
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </template>
                   </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="17" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-800">Tidak ada data ditemukan</h3>
                        <p class="text-slate-500 mt-1 text-sm">Coba sesuaikan filter atau kata kunci pencarian Anda.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="px-6 py-4" style="border-top: 1px solid #fef2f2; background:#fafafa;">
    {{ $rows->links('components.pagination') }}
</div>
