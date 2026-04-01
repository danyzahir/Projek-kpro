@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="flex flex-col gap-6">
        {{-- BREADCRUMB & ACTIONS --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4" x-data="{ showTeleModal: false }">
            <div class="flex items-center gap-3 text-sm text-slate-500">
                <a href="{{ route('dashboard') }}"
                    class="font-bold text-slate-800 text-xs uppercase tracking-wider">Dashboard</a>
                <span class="text-slate-300 font-bold">❯</span>
                <span class="font-bold text-slate-800 text-xs uppercase tracking-wider">Live monitoring</span>
            </div>

            <div class="flex items-center gap-3">
                <button @click="showTeleModal = true"
                    class="group relative overflow-hidden flex items-center gap-2.5 px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest text-white transition-all duration-300 shadow-xl shadow-red-200 hover:-translate-y-0.5 hover:shadow-2xl hover:shadow-red-300 active:scale-95"
                    style="background: linear-gradient(135deg, #e32b2b 0%, #ba1c1c 100%);">
                    <!-- Efek kilau saat disentuh -->
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    <svg class="w-4 h-4 relative z-10 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <span class="relative z-10">Kirim Laporan</span>
                </button>
            </div>

            {{-- CUSTOM TELEGRAM MODAL --}}
            <template x-teleport="body">
                <div x-show="showTeleModal"
                    class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>

                    <div @click.outside="showTeleModal = false"
                        class="w-full max-w-sm bg-white rounded-[2rem] shadow-2xl border border-slate-100 overflow-hidden transform transition-all"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-90 translate-y-4">

                        <div class="p-8 text-center">
                            <div
                                class="w-20 h-20 bg-red-50 rounded-3xl flex items-center justify-center mx-auto mb-6 text-red-600 shadow-inner">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-800 tracking-tight mb-2">Kirim Laporan Harian?</h3>
                            <p class="text-sm text-slate-500 leading-relaxed mb-8">
                                Rekap seluruh progress hari ini akan dikirimkan langsung ke channel Telegram. Lanjutkan?
                            </p>

                            <div class="flex flex-col gap-3">
                                <form action="{{ route('admin.telegram.daily-report') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full py-3.5 rounded-2xl text-sm font-bold text-white shadow-xl shadow-red-200 transition active:scale-95"
                                        style="background: linear-gradient(135deg, #e32b2b 0%, #991b1b 100%);">
                                        Ya, Kirim Sekarang
                                    </button>
                                </form>
                                <button @click="showTeleModal = false"
                                    class="w-full py-4 rounded-2xl text-sm font-bold text-slate-400 hover:text-slate-600 transition active:scale-95">
                                    Batalkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- ===== LIVE MONITORING HEADER ===== --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-6 relative overflow-hidden"
            style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%); border-radius: 2rem;">
            {{-- Decorative blob --}}
            <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full blur-3xl opacity-30" style="background:#e32b2b;">
            </div>

            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-1">
                    {{-- Pulsing dot --}}
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75"
                            style="background:#ef4444;"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5" style="background:#ef4444;"></span>
                    </span>
                    <span class="text-[10px] font-black uppercase tracking-[0.25em]" style="color:#fca5a5;">Live
                        Monitoring</span>
                </div>
                <p class="text-xs mt-1" style="color:#94a3b8;">Monitoring real-time seluruh aktivitas deployment</p>
            </div>

            {{-- Live Clock & Actions --}}
            <div class="relative z-10 flex flex-col sm:flex-row items-end sm:items-center gap-6 mt-4 sm:mt-0">
                <div class="text-right hidden sm:flex flex-col items-end">
                    <div id="live-date" class="text-xs font-semibold mb-1" style="color:#94a3b8;"></div>
                    <div id="live-clock" class="text-4xl font-black text-white tabular-nums tracking-tight"
                        style="font-variant-numeric: tabular-nums;"></div>
                    <div class="text-[10px] mt-1 font-bold uppercase tracking-widest" style="color:#6b7280;">WIB · Indonesia
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= HERO STATS ================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- CARD 1: OVERDUE COMMITMENTS -->
            <div class="rounded-[2.5rem] p-8 text-white relative overflow-hidden group shadow-2xl flex flex-col min-h-[300px]"
                style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);">
                <!-- Decorative Blobs -->
                <div class="absolute -top-24 -right-24 w-64 h-64 rounded-full blur-[80px] opacity-40 group-hover:scale-110 transition-transform duration-700"
                    style="background:#e32b2b;"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 rounded-full blur-[80px] opacity-20 group-hover:scale-110 transition-transform duration-700"
                    style="background:#ff6b6b;"></div>

                <div class="relative z-10 flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 rounded-xl" style="background:rgba(227,43,43,0.25);">
                            <svg class="w-5 h-5" style="color:#fca5a5;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <label class="text-xs font-bold uppercase tracking-[0.2em]" style="color:#fca5a5;">Overdue
                                Commitments</label>
                            <p class="text-[10px] mt-0.5" style="color:#6b7280;">Tanggal komitmen yang sudah terlewat</p>
                        </div>
                    </div>
                    <span class="text-xs font-black px-3 py-1 rounded-xl"
                        style="background:rgba(227,43,43,0.3); color:#fca5a5;">
                        {{ $overdueCommitments->count() }} item
                    </span>
                </div>

                <div class="relative z-10 flex-1 overflow-y-auto no-scrollbar space-y-3 max-h-[200px]">
                    @forelse($overdueCommitments as $item)
                        <a href="{{ route('deployment.edit', $item['id']) }}"
                            class="block p-3 rounded-2xl hover:bg-white/10 transition-colors cursor-pointer"
                            style="background:rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.07);">
                            <div class="flex items-start justify-between gap-2">
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-black text-white truncate">#{{ $item['star_click_id'] }}</p>
                                    <p class="text-[10px] truncate mt-0.5" style="color:#9ca3af;">
                                        {{ $item['nama_customer'] }}</p>
                                </div>
                                <!-- Days overdue badge -->
                                <span class="flex-shrink-0 text-[9px] font-black px-2 py-1 rounded-lg whitespace-nowrap"
                                    style="background:rgba(227,43,43,0.4); color:#fca5a5;">
                                    terlewat {{ $item['days_overdue'] }} hari
                                </span>
                            </div>
                            <div class="flex items-center gap-1 mt-1.5" style="color:#6b7280;">
                                <svg class="w-2.5 h-2.5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <p class="text-[9px] truncate">{{ $item['updated_by'] }} &bull;
                                    {{ \Carbon\Carbon::parse($item['commitment_date'])->format('d M Y') }}</p>
                                <span class="ml-auto flex-shrink-0 text-[8px] font-bold px-1.5 py-0.5 rounded"
                                    style="background:rgba(255,255,255,0.08); color:#9ca3af;">{{ $item['status'] }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="flex flex-col items-center justify-center py-12 opacity-30">
                            <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-xs font-bold uppercase tracking-widest">Semua On Track!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- CARD 2: LIVE TRACKING -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border flex flex-col relative overflow-hidden group min-h-[300px] transition-all duration-300 hover:-translate-y-1"
                style="border-color:#fde8e8; box-shadow: 0 20px 40px rgba(227,43,43,0.08);">
                <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full blur-3xl transition-colors duration-700"
                    style="background:rgba(227,43,43,0.06);"></div>

                <div class="flex items-center justify-between mb-6 relative">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 rounded-xl animate-pulse" style="background:#fef2f2; color:#e32b2b;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-sm font-black uppercase tracking-widest" style="color:#1a1a2e;">Live Tracking</h4>
                    </div>
                    <div class="text-[10px] font-bold px-2 py-1 rounded-lg" id="liveTrackingCount"
                        style="color:#e32b2b; background:#fef2f2;">{{ $liveTracking->count() }} Updates</div>
                </div>

                <div class="flex-1 overflow-y-auto no-scrollbar space-y-4 max-h-[160px]" id="liveTrackingContainer">
                    @forelse($liveTracking as $log)
                        <div
                            class="flex items-start gap-3 p-3 rounded-2xl hover:bg-red-50 transition-colors border border-transparent hover:border-red-100">
                            <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center text-[10px] font-bold border-2 border-white shadow-sm"
                                style="background:#fef2f2; color:#e32b2b;">
                                {{ strtoupper(substr($log->user->name ?? '?', 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-0.5">
                                    <p class="text-[11px] font-black truncate" style="color:#1a1a2e;">
                                        {{ $log->user->name ?? 'System' }}</p>
                                    <p class="text-[9px] font-bold" style="color:#9ca3af;">
                                        {{ $log->created_at->diffForHumans(null, true, true) }}</p>
                                </div>
                                <p class="text-[10px] font-medium" style="color:#6b7280;">Updated <span
                                        class="font-bold tracking-tight"
                                        style="color:#e32b2b;">#{{ $log->planning->star_click_id ?? 'N/A' }}</span></p>
                                <div class="flex items-center gap-2 mt-1.5">
                                    <span class="text-[8px] font-black uppercase tracking-tighter px-1.5 py-0.5 rounded-md"
                                        style="background:#fef2f2; color:#e32b2b;">
                                        {{ $log->progres }}
                                    </span>
                                    @if ($log->data && isset($log->data['commitment_date']))
                                        <span
                                            class="text-[8px] font-black uppercase tracking-tighter px-1.5 py-0.5 rounded-md flex items-center gap-1"
                                            style="background:#fffbeb; color:#d97706;">
                                            <svg class="w-2 h-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 0 00-2 2v12a2 0 002 2z">
                                                </path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($log->data['commitment_date'])->format('d M') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-full py-10" style="color:#d1d5db;">
                            <p class="text-[10px] font-bold uppercase tracking-widest">No Recent Activity</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-4 pt-4 flex items-center justify-between" style="border-top: 1px solid #fef2f2;">
                    <p class="text-[9px] font-bold uppercase tracking-widest italic" style="color:#9ca3af;">Global Optima
                        Sync</p>
                    <div class="flex -space-x-2">
                        @foreach ($liveTracking->take(3) as $log)
                            <div class="w-5 h-5 rounded-full border-2 border-white flex items-center justify-center text-[7px] font-bold"
                                style="background:#fde8e8; color:#e32b2b;">
                                {{ strtoupper(substr($log->user->name ?? '?', 0, 1)) }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <!-- ================= MAIN GRID: CHART & SIDEBAR ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <!-- MAIN CHART (8/12) -->
            <div class="lg:col-span-8 bg-white rounded-[2.5rem] p-8 shadow-xl border flex flex-col min-h-[500px]"
                style="border-color:#fde8e8; box-shadow: 0 20px 40px rgba(227,43,43,0.06);">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
                    <div class="flex items-center gap-4">
                        <div class="p-3 rounded-2xl" style="background:#fef2f2; color:#e32b2b;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold tracking-tight" style="color:#1a1a2e;">Deployment Trend</h3>
                            <p class="text-[10px] font-bold uppercase tracking-widest mt-0.5" style="color:#9ca3af;">Live
                                Market Data</p>
                        </div>
                    </div>
                    <div class="flex p-1.5 rounded-2xl gap-1" style="background:#f5f5f5;">
                        <button onclick="updateTrend('daily')" id="btn-daily"
                            class="filter-btn px-4 py-1.5 bg-white text-[10px] font-black uppercase tracking-wider rounded-xl shadow-sm transition-all duration-300"
                            style="color:#e32b2b;">Daily</button>
                        <button onclick="updateTrend('weekly')" id="btn-weekly"
                            class="filter-btn px-4 py-1.5 text-[10px] font-black uppercase tracking-wider rounded-xl transition-all duration-300"
                            style="color:#9ca3af;">Weekly</button>
                        <button onclick="updateTrend('monthly')" id="btn-monthly"
                            class="filter-btn px-4 py-1.5 text-[10px] font-black uppercase tracking-wider rounded-xl transition-all duration-300"
                            style="color:#9ca3af;">Monthly</button>
                    </div>
                </div>

                {{-- SEARCH FILTERS --}}
                <div class="flex flex-wrap items-end gap-3 mb-8 p-4 rounded-2xl border"
                    style="background:#fafafa; border-color:#f3f4f6;">
                    <div class="flex-1 min-w-[120px]">
                        <label class="block text-[9px] font-bold uppercase tracking-widest mb-1"
                            style="color:#9ca3af;">Datel</label>
                        <select id="trend-filter-datel" onchange="updateTrend()"
                            class="w-full rounded-xl border-slate-200 bg-white text-xs font-semibold py-2 px-3 focus:ring-red-500 focus:border-red-500 transition">
                            <option value="">Semua Datel</option>
                            @foreach ($trendFilterOptions['datels'] as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-[120px]">
                        <label class="block text-[9px] font-bold uppercase tracking-widest mb-1"
                            style="color:#9ca3af;">STO</label>
                        <select id="trend-filter-sto" onchange="updateTrend()"
                            class="w-full rounded-xl border-slate-200 bg-white text-xs font-semibold py-2 px-3 focus:ring-red-500 focus:border-red-500 transition">
                            <option value="">Semua STO</option>
                            @foreach ($trendFilterOptions['stos'] as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-[120px]">
                        <label class="block text-[9px] font-bold uppercase tracking-widest mb-1"
                            style="color:#9ca3af;">Mitra</label>
                        <select id="trend-filter-mitra" onchange="updateTrend()"
                            class="w-full rounded-xl border-slate-200 bg-white text-xs font-semibold py-2 px-3 focus:ring-red-500 focus:border-red-500 transition">
                            <option value="">Semua Mitra</option>
                            @foreach ($trendFilterOptions['mitras'] as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button onclick="resetTrendFilters()"
                        class="px-3 py-2 rounded-xl text-[10px] font-black uppercase tracking-wider transition hover:bg-red-50"
                        style="color:#e32b2b; border: 1px solid #fde8e8;">
                        Reset
                    </button>
                </div>

                <div class="relative flex-1">
                    <canvas id="deploymentTrendChart"></canvas>
                </div>
            </div>

            <!-- SIDEBAR (4/12) -->
            <div class="lg:col-span-4 space-y-10">

                <!-- TOP PARTNERS WIDGET -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border"
                    style="border-color:#fde8e8; box-shadow: 0 20px 40px rgba(227,43,43,0.06);">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-lg font-extrabold tracking-tight" style="color:#1a1a2e;">Top Mitra</h3>
                        <div class="p-2 rounded-xl" style="background:#f5f5f5;">
                            <svg class="w-5 h-5" style="color:#9ca3af;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="space-y-6">
                        @forelse($topMitras as $index => $mitra)
                            <div class="flex items-center gap-4 group cursor-default">
                                <div class="w-12 h-12 rounded-2xl flex flex-col items-center justify-center font-black group-hover:scale-105 transition-transform"
                                    style="{{ $index == 0 ? 'background:#fef2f2; color:#e32b2b;' : 'background:#f5f5f5; color:#6b7280;' }}">
                                    <span class="text-sm">#{{ $index + 1 }}</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold truncate w-32 md:w-full" style="color:#374151;">
                                        {{ $mitra['name'] }}</h4>

                                </div>
                                <div class="text-right">
                                    <span class="text-[10px] font-bold block uppercase tracking-tighter"
                                        style="color:#9ca3af;">Volume</span>
                                    <span class="text-sm font-black" style="color:#374151;">{{ $mitra['total'] }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm italic text-center py-6" style="color:#9ca3af;">No partner rankings yet.</p>
                        @endforelse
                    </div>
                </div>

                <!-- WAITING APPROVAL (Telkom Red) -->
                <div class="rounded-[2.5rem] p-8 text-white relative overflow-hidden group shadow-2xl"
                    style="background: linear-gradient(135deg, #e32b2b 0%, #c0392b 100%); box-shadow: 0 20px 40px rgba(227,43,43,0.35);">
                    <!-- Decorative -->
                    <div class="absolute top-0 right-0 w-32 h-32 rounded-bl-full group-hover:scale-110 transition-transform duration-500"
                        style="background:rgba(255,255,255,0.1);"></div>
                    <div class="absolute -bottom-8 -left-8 w-24 h-24 rounded-full"
                        style="background:rgba(255,255,255,0.05);"></div>

                    <div class="relative z-10 flex items-center justify-between mb-6">
                        <h3 class="text-lg font-extrabold tracking-tight">Pending Approval</h3>
                        <span id="waitingApprovalBadge" class="text-white text-[10px] font-black px-2.5 py-1 rounded-lg uppercase tracking-widest"
                            style="background:rgba(255,255,255,0.2);">
                            Action Required
                        </span>
                    </div>

                    <div id="waitingUsersContainer" class="relative z-10 space-y-4 max-h-[220px] overflow-y-auto no-scrollbar">
                        @forelse($waitingUsers as $user)
                            <div class="flex items-center justify-between p-3 rounded-2xl hover:bg-white/20 transition-colors border"
                                style="background:rgba(255,255,255,0.1); border-color:rgba(255,255,255,0.1);">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center font-black text-xs uppercase shadow-sm"
                                        style="background:white; color:#e32b2b;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold leading-none">{{ $user->name }}</p>
                                        @if ($user->requested_role)
                                            <span
                                                class="inline-block mt-1 text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md"
                                                style="background:rgba(255,255,255,0.2); color:rgba(255,255,255,0.9);">
                                                Request: {{ ucfirst($user->requested_role) }}
                                            </span>
                                        @endif
                                        <p class="text-[10px] mt-0.5" style="color:rgba(255,255,255,0.5);">
                                            {{ $user->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.users') }}"
                                    class="p-2 rounded-xl hover:scale-110 transition-transform shadow-lg"
                                    style="background:white; color:#e32b2b;">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-10 opacity-60">
                                <svg class="w-10 h-10 mx-auto mb-2" style="color:rgba(255,255,255,0.3);" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round"></path>
                                </svg>
                                <p class="text-xs font-bold">No users waiting</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>



    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    {{-- Chart.js dimuat secara dinamis di dalam script agar tidak ada race condition --}}

    <script>
        // =============================================
        // LIVE TRACKING POLLING
        // =============================================
        function renderLiveTracking(logs) {
            const container = document.getElementById('liveTrackingContainer');
            const countBadge = document.getElementById('liveTrackingCount');
            if (!container) return;

            if (!logs || logs.length === 0) {
                container.innerHTML = `
                <div class="flex flex-col items-center justify-center h-full py-10" style="color:#d1d5db;">
                    <p class="text-[10px] font-bold uppercase tracking-widest">No Recent Activity</p>
                </div>`;
                if (countBadge) countBadge.textContent = '0 Updates';
                return;
            }

            if (countBadge) countBadge.textContent = `${logs.length} Updates`;

            container.innerHTML = logs.map(log => `
            <div class="flex items-start gap-3 p-3 rounded-2xl hover:bg-red-50 transition-colors border border-transparent hover:border-red-100">
                <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center text-[10px] font-bold border-2 border-white shadow-sm" style="background:#fef2f2; color:#e32b2b;">
                    ${log.user_initials}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-0.5">
                        <p class="text-[11px] font-black truncate" style="color:#1a1a2e;">${log.user_name}</p>
                        <p class="text-[9px] font-bold" style="color:#9ca3af;">${log.time_ago}</p>
                    </div>
                    <p class="text-[10px] font-medium" style="color:#6b7280;">Updated <span class="font-bold tracking-tight" style="color:#e32b2b;">#${log.star_click_id}</span></p>
                    <div class="flex items-center gap-2 mt-1.5">
                        <span class="text-[8px] font-black uppercase tracking-tighter px-1.5 py-0.5 rounded-md" style="background:#fef2f2; color:#e32b2b;">
                            ${log.progres ?? '-'}
                        </span>
                        ${log.commitment_date ? `
                                <span class="text-[8px] font-black uppercase tracking-tighter px-1.5 py-0.5 rounded-md flex items-center gap-1" style="background:#fffbeb; color:#d97706;">
                                    <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    ${log.commitment_date}
                                </span>` : ''}
                    </div>
                </div>
            </div>
        `).join('');
        }

        function renderWaitingUsers(users) {
            const container = document.getElementById('waitingUsersContainer');
            const badge = document.getElementById('waitingApprovalBadge');
            if (!container) return;

            if (badge) {
                badge.textContent = users.length > 0 ? 'Action Required' : 'Clear';
                badge.style.background = users.length > 0 ? 'rgba(255,255,255,0.2)' : 'rgba(255,255,255,0.05)';
            }

            if (!users || users.length === 0) {
                container.innerHTML = `
                <div class="text-center py-10 opacity-60">
                    <svg class="w-10 h-10 mx-auto mb-2" style="color:rgba(255,255,255,0.3);" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round"></path>
                    </svg>
                    <p class="text-xs font-bold text-white">No users waiting</p>
                </div>`;
                return;
            }

            container.innerHTML = users.map(user => `
                <div class="flex items-center justify-between p-3 rounded-2xl hover:bg-white/20 transition-colors border"
                    style="background:rgba(255,255,255,0.1); border-color:rgba(255,255,255,0.1);">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-black text-xs uppercase shadow-sm"
                            style="background:white; color:#e32b2b;">
                            ${user.initial}
                        </div>
                        <div>
                            <p class="text-xs font-bold leading-none text-white">${user.name}</p>
                            ${user.requested_role ? `
                                <span class="inline-block mt-1 text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md"
                                    style="background:rgba(255,255,255,0.2); color:rgba(255,255,255,0.9);">
                                    Request: ${user.requested_role}
                                </span>` : ''}
                            <p class="text-[10px] mt-0.5" style="color:rgba(255,255,255,0.5);">
                                ${user.time_ago}</p>
                        </div>
                    </div>
                    <a href="${user.route}"
                        class="p-2 rounded-xl hover:scale-110 transition-transform shadow-lg"
                        style="background:white; color:#e32b2b;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M5 13l4 4L19 7"></path>
                        </svg>
                    </a>
                </div>
            `).join('');
        }

        async function pollLiveTracking() {
            try {
                const res = await fetch('{{ route('admin.api.live-tracking') }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (res.status === 401 || res.status === 403) {
                    if (window._liveTrackingInterval) clearInterval(window._liveTrackingInterval);
                    return;
                }
                if (!res.ok) return;
                const data = await res.json();
                
                // Mendukung versi endpoint baru
                if (data && data.activities !== undefined) {
                    renderLiveTracking(data.activities);
                    renderWaitingUsers(data.waiting || []);
                } else {
                    renderLiveTracking(data);
                }
            } catch (e) { }
        }

        // =============================================
        // DASHBOARD INIT
        // =============================================
        function initDashboard() {
            // Bersihkan interval lama jika ada
            if (window._dashboardInterval) {
                clearInterval(window._dashboardInterval);
                window._dashboardInterval = null;
            }
            if (window._liveTrackingInterval) {
                clearInterval(window._liveTrackingInterval);
                window._liveTrackingInterval = null;
            }

            // --- TREND CHART ---
            const ctxTrend = document.getElementById('deploymentTrendChart');
            if (ctxTrend) {
                // Destroy chart lama jika ada (penting untuk Turbo Drive)
                if (window._trendChart instanceof Chart) {
                    window._trendChart.destroy();
                    window._trendChart = null;
                }

                const gradient = ctxTrend.getContext('2d').createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(227, 43, 43, 0.35)');
                gradient.addColorStop(1, 'rgba(227, 43, 43, 0.01)');

                window._trendChart = new Chart(ctxTrend.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: @json($trendLabels),
                        datasets: [{
                            label: 'Volume',
                            data: @json($trendValues),
                            borderColor: '#e32b2b',
                            borderWidth: 3,
                            backgroundColor: gradient,
                            fill: true,
                            tension: 0.45,
                            pointBackgroundColor: '#fff',
                            pointBorderColor: '#e32b2b',
                            pointBorderWidth: 2,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointHoverBorderWidth: 3,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#1a1a2e',
                                titleFont: {
                                    weight: 'bold'
                                },
                                cornerRadius: 12,
                                displayColors: false,
                                callbacks: {
                                    label: (c) => ` Volume: ${c.parsed.y}`
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(243, 244, 246, 1)',
                                    drawBorder: false
                                },
                                ticks: {
                                    font: {
                                        weight: 'bold'
                                    },
                                    color: '#9ca3af',
                                    stepSize: 1
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        weight: 'bold'
                                    },
                                    color: '#9ca3af'
                                }
                            }
                        }
                    }
                });
            }

            // Restore active filter button state
            const activeFilter = window._dashboardFilter || 'monthly';
            const activeBtn = document.getElementById(`btn-${activeFilter}`);
            if (activeBtn) {
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.style.background = '';
                    btn.style.color = '#9ca3af';
                    btn.classList.remove('shadow-sm');
                });
                activeBtn.style.background = 'white';
                activeBtn.style.color = '#e32b2b';
                activeBtn.classList.add('shadow-sm');
            }

            // --- LIVE TRACKING POLLING (setiap 15 detik) ---
            pollLiveTracking(); // langsung fetch saat halaman dimuat
            window._liveTrackingInterval = setInterval(pollLiveTracking, 15000);
        }

        async function updateTrend(filter) {
            if (filter) window._dashboardFilter = filter;
            const activeFilter = window._dashboardFilter || 'daily';

            // Update button UI
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.style.background = '';
                btn.style.color = '#9ca3af';
                btn.classList.remove('shadow-sm');
            });
            const activeBtn = document.getElementById(`btn-${activeFilter}`);
            if (activeBtn) {
                activeBtn.style.background = 'white';
                activeBtn.style.color = '#e32b2b';
                activeBtn.classList.add('shadow-sm');
            }

            // Collect filter values
            const datel = document.getElementById('trend-filter-datel')?.value || '';
            const sto = document.getElementById('trend-filter-sto')?.value || '';
            const mitra = document.getElementById('trend-filter-mitra')?.value || '';

            const params = new URLSearchParams({
                filter: activeFilter
            });
            if (datel) params.set('datel', datel);
            if (sto) params.set('sto', sto);
            if (mitra) params.set('mitra', mitra);

            try {
                const response = await fetch(`{{ route('admin.api.trend-data') }}?${params.toString()}`);
                const data = await response.json();

                if (window._trendChart instanceof Chart) {
                    window._trendChart.data.labels = data.labels;
                    window._trendChart.data.datasets[0].data = data.values;
                    window._trendChart.update();
                }
            } catch (e) {
                console.error('Trend update failed', e);
            }
        }

        function resetTrendFilters() {
            const selects = ['trend-filter-datel', 'trend-filter-sto', 'trend-filter-mitra'];
            selects.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.value = '';
            });
            updateTrend();
        }

        // Cleanup sebelum Turbo meng-cache halaman — WAJIB agar chart tidak corrupt saat restore
        document.addEventListener('turbo:before-cache', function() {
            if (window._trendChart instanceof Chart) {
                window._trendChart.destroy();
                window._trendChart = null;
            }
            if (window._dashboardInterval) {
                clearInterval(window._dashboardInterval);
                window._dashboardInterval = null;
            }
            if (window._liveTrackingInterval) {
                clearInterval(window._liveTrackingInterval);
                window._liveTrackingInterval = null;
            }
        });

        // =============================================
        // BOOTSTRAP — pastikan Chart.js sudah siap sebelum init
        // =============================================
        function loadChartJsAndInit() {
            if (typeof Chart !== 'undefined') {
                initDashboard();
            } else {
                const existing = document.querySelector('script[data-chartjs]');
                if (existing) {
                    existing.addEventListener('load', initDashboard);
                } else {
                    const s = document.createElement('script');
                    s.src = 'https://cdn.jsdelivr.net/npm/chart.js';
                    s.setAttribute('data-chartjs', '1');
                    s.onload = initDashboard;
                    document.head.appendChild(s);
                }
            }
        }

        document.addEventListener('turbo:load', loadChartJsAndInit);
        document.addEventListener('DOMContentLoaded', loadChartJsAndInit);

        // =============================================
        // LIVE CLOCK
        // =============================================
        function updateClock() {
            const now = new Date();

            const timeEl = document.getElementById('live-clock');
            const dateEl = document.getElementById('live-date');
            if (!timeEl || !dateEl) return;

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            timeEl.textContent = `${hours}:${minutes}:${seconds}`;

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            dateEl.textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
        }

        // Start clock and keep it alive across Turbo navigations
        if (window._clockInterval) clearInterval(window._clockInterval);
        updateClock();
        window._clockInterval = setInterval(updateClock, 1000);

        document.addEventListener('turbo:before-cache', function() {
            if (window._clockInterval) {
                clearInterval(window._clockInterval);
                window._clockInterval = null;
            }
        });
    </script>
@endsection
