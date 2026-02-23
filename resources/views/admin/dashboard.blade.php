@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10 min-h-screen">

    {{-- ===== LIVE MONITORING HEADER ===== --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-6 relative overflow-hidden" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%); border-radius: 2rem;">
        {{-- Decorative blob --}}
        <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full blur-3xl opacity-30" style="background:#e32b2b;"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-1">
                {{-- Pulsing dot --}}
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" style="background:#ef4444;"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5" style="background:#ef4444;"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-[0.25em]" style="color:#fca5a5;">Live Monitoring</span>
            </div>
            <p class="text-xs mt-1" style="color:#94a3b8;">Monitoring real-time seluruh aktivitas deployment</p>
        </div>

        {{-- Live Clock --}}
        <div class="relative z-10 flex flex-col items-end">
            <div id="live-date" class="text-xs font-semibold mb-1" style="color:#94a3b8;"></div>
            <div id="live-clock" class="text-4xl font-black text-white tabular-nums tracking-tight" style="font-variant-numeric: tabular-nums;"></div>
            <div class="text-[10px] mt-1 font-bold uppercase tracking-widest" style="color:#6b7280;">WIB · Indonesia</div>
        </div>
    </div>

    <!-- ================= HERO STATS ================= -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- CARD 1: OVERDUE COMMITMENTS -->
        <div class="rounded-[2.5rem] p-8 text-white relative overflow-hidden group shadow-2xl flex flex-col min-h-[300px]" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);">
            <!-- Decorative Blobs -->
            <div class="absolute -top-24 -right-24 w-64 h-64 rounded-full blur-[80px] opacity-40 group-hover:scale-110 transition-transform duration-700" style="background:#e32b2b;"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 rounded-full blur-[80px] opacity-20 group-hover:scale-110 transition-transform duration-700" style="background:#ff6b6b;"></div>

            <div class="relative z-10 flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl" style="background:rgba(227,43,43,0.25);">
                        <svg class="w-5 h-5" style="color:#fca5a5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase tracking-[0.2em]" style="color:#fca5a5;">Overdue Commitments</label>
                        <p class="text-[10px] mt-0.5" style="color:#6b7280;">Tanggal komitmen yang sudah terlewat</p>
                    </div>
                </div>
                <span class="text-xs font-black px-3 py-1 rounded-xl" style="background:rgba(227,43,43,0.3); color:#fca5a5;">
                    {{ $overdueCommitments->count() }} item
                </span>
            </div>

            <div class="relative z-10 flex-1 overflow-y-auto no-scrollbar space-y-3 max-h-[200px]">
                @forelse($overdueCommitments as $item)
                <div class="p-3 rounded-2xl" style="background:rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.07);">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-black text-white truncate">#{{ $item['star_click_id'] }}</p>
                            <p class="text-[10px] truncate mt-0.5" style="color:#9ca3af;">{{ $item['nama_customer'] }}</p>
                        </div>
                        <!-- Days overdue badge -->
                        <span class="flex-shrink-0 text-[9px] font-black px-2 py-1 rounded-lg whitespace-nowrap" style="background:rgba(227,43,43,0.4); color:#fca5a5;">
                            terlewat {{ $item['days_overdue'] }} hari
                        </span>
                    </div>
                    <div class="flex items-center gap-1 mt-1.5" style="color:#6b7280;">
                        <svg class="w-2.5 h-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <p class="text-[9px] truncate">{{ $item['updated_by'] }} &bull; {{ \Carbon\Carbon::parse($item['commitment_date'])->format('d M Y') }}</p>
                        <span class="ml-auto flex-shrink-0 text-[8px] font-bold px-1.5 py-0.5 rounded" style="background:rgba(255,255,255,0.08); color:#9ca3af;">{{ $item['status'] }}</span>
                    </div>
                </div>
                @empty
                <div class="flex flex-col items-center justify-center py-12 opacity-30">
                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-xs font-bold uppercase tracking-widest">Semua On Track!</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- CARD 2: LIVE TRACKING -->
        <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border flex flex-col relative overflow-hidden group min-h-[300px] transition-all duration-300 hover:-translate-y-1" style="border-color:#fde8e8; box-shadow: 0 20px 40px rgba(227,43,43,0.08);">
            <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full blur-3xl transition-colors duration-700" style="background:rgba(227,43,43,0.06);"></div>

            <div class="flex items-center justify-between mb-6 relative">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl animate-pulse" style="background:#fef2f2; color:#e32b2b;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-sm font-black uppercase tracking-widest" style="color:#1a1a2e;">Live Tracking</h4>
                </div>
                <div class="text-[10px] font-bold px-2 py-1 rounded-lg" id="liveTrackingCount" style="color:#e32b2b; background:#fef2f2;">{{ $liveTracking->count() }} Updates</div>
            </div>

            <div class="flex-1 overflow-y-auto no-scrollbar space-y-4 max-h-[160px]" id="liveTrackingContainer">
                @forelse($liveTracking as $log)
                <div class="flex items-start gap-3 p-3 rounded-2xl hover:bg-red-50 transition-colors border border-transparent hover:border-red-100">
                    <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center text-[10px] font-bold border-2 border-white shadow-sm" style="background:#fef2f2; color:#e32b2b;">
                        {{ strtoupper(substr($log->user->name ?? '?', 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-0.5">
                            <p class="text-[11px] font-black truncate" style="color:#1a1a2e;">{{ $log->user->name ?? 'System' }}</p>
                            <p class="text-[9px] font-bold" style="color:#9ca3af;">{{ $log->created_at->diffForHumans(null, true, true) }}</p>
                        </div>
                        <p class="text-[10px] font-medium" style="color:#6b7280;">Updated <span class="font-bold tracking-tight" style="color:#e32b2b;">#{{ $log->planning->star_click_id ?? 'N/A' }}</span></p>
                        <div class="flex items-center gap-2 mt-1.5">
                            <span class="text-[8px] font-black uppercase tracking-tighter px-1.5 py-0.5 rounded-md" style="background:#fef2f2; color:#e32b2b;">
                                {{ $log->progres }}
                            </span>
                            @if($log->data && isset($log->data['commitment_date']))
                            <span class="text-[8px] font-black uppercase tracking-tighter px-1.5 py-0.5 rounded-md flex items-center gap-1" style="background:#fffbeb; color:#d97706;">
                                <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 0 00-2 2v12a2 0 002 2z"></path></svg>
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
                <p class="text-[9px] font-bold uppercase tracking-widest italic" style="color:#9ca3af;">Global Optima Sync</p>
                <div class="flex -space-x-2">
                    @foreach($liveTracking->take(3) as $log)
                    <div class="w-5 h-5 rounded-full border-2 border-white flex items-center justify-center text-[7px] font-bold" style="background:#fde8e8; color:#e32b2b;">
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
        <div class="lg:col-span-8 bg-white rounded-[2.5rem] p-8 shadow-xl border flex flex-col min-h-[500px]" style="border-color:#fde8e8; box-shadow: 0 20px 40px rgba(227,43,43,0.06);">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-10 gap-4">
                <div class="flex items-center gap-4">
                    <div class="p-3 rounded-2xl" style="background:#fef2f2; color:#e32b2b;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold tracking-tight" style="color:#1a1a2e;">Deployment Trend</h3>
                        <p class="text-[10px] font-bold uppercase tracking-widest mt-0.5" style="color:#9ca3af;">Live Market Data</p>
                    </div>
                </div>
                <div class="flex p-1.5 rounded-2xl gap-1" style="background:#f5f5f5;">
                    <button onclick="updateTrend('daily')" id="btn-daily" class="filter-btn px-4 py-1.5 bg-white text-[10px] font-black uppercase tracking-wider rounded-xl shadow-sm transition-all duration-300" style="color:#e32b2b;">Daily</button>
                    <button onclick="updateTrend('weekly')" id="btn-weekly" class="filter-btn px-4 py-1.5 text-[10px] font-black uppercase tracking-wider rounded-xl transition-all duration-300" style="color:#9ca3af;">Weekly</button>
                    <button onclick="updateTrend('monthly')" id="btn-monthly" class="filter-btn px-4 py-1.5 text-[10px] font-black uppercase tracking-wider rounded-xl transition-all duration-300" style="color:#9ca3af;">Monthly</button>
                </div>
            </div>
            <div class="relative flex-1">
                <canvas id="deploymentTrendChart"></canvas>
            </div>
        </div>

        <!-- SIDEBAR (4/12) -->
        <div class="lg:col-span-4 space-y-10">

            <!-- TOP PARTNERS WIDGET -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border" style="border-color:#fde8e8; box-shadow: 0 20px 40px rgba(227,43,43,0.06);">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-extrabold tracking-tight" style="color:#1a1a2e;">Top Partners</h3>
                    <div class="p-2 rounded-xl" style="background:#f5f5f5;">
                        <svg class="w-5 h-5" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                    </div>
                </div>
                <div class="space-y-6">
                    @forelse($topMitras as $index => $mitra)
                    <div class="flex items-center gap-4 group cursor-default">
                        <div class="w-12 h-12 rounded-2xl flex flex-col items-center justify-center font-black group-hover:scale-105 transition-transform" style="{{ $index == 0 ? 'background:#fef2f2; color:#e32b2b;' : 'background:#f5f5f5; color:#6b7280;' }}">
                            <span class="text-sm">#{{ $index + 1 }}</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold truncate w-32 md:w-full" style="color:#374151;">{{ $mitra['name'] }}</h4>

                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-bold block uppercase tracking-tighter" style="color:#9ca3af;">Volume</span>
                            <span class="text-sm font-black" style="color:#374151;">{{ $mitra['total'] }}</span>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm italic text-center py-6" style="color:#9ca3af;">No partner rankings yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- WAITING APPROVAL (Telkom Red) -->
            <div class="rounded-[2.5rem] p-8 text-white relative overflow-hidden group shadow-2xl" style="background: linear-gradient(135deg, #e32b2b 0%, #c0392b 100%); box-shadow: 0 20px 40px rgba(227,43,43,0.35);">
                <!-- Decorative -->
                <div class="absolute top-0 right-0 w-32 h-32 rounded-bl-full group-hover:scale-110 transition-transform duration-500" style="background:rgba(255,255,255,0.1);"></div>
                <div class="absolute -bottom-8 -left-8 w-24 h-24 rounded-full" style="background:rgba(255,255,255,0.05);"></div>

                <div class="relative z-10 flex items-center justify-between mb-6">
                    <h3 class="text-lg font-extrabold tracking-tight">Pending Approval</h3>
                    <span class="text-white text-[10px] font-black px-2.5 py-1 rounded-lg uppercase tracking-widest" style="background:rgba(255,255,255,0.2);">
                        Action Required
                    </span>
                </div>

                <div class="relative z-10 space-y-4 max-h-[220px] overflow-y-auto no-scrollbar">
                    @forelse($waitingUsers as $user)
                    <div class="flex items-center justify-between p-3 rounded-2xl hover:bg-white/20 transition-colors border" style="background:rgba(255,255,255,0.1); border-color:rgba(255,255,255,0.1);">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-black text-xs uppercase shadow-sm" style="background:white; color:#e32b2b;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-xs font-bold leading-none">{{ $user->name }}</p>
                                <p class="text-[10px] mt-1" style="color:rgba(255,255,255,0.6);">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.users') }}" class="p-2 rounded-xl hover:scale-110 transition-transform shadow-lg" style="background:white; color:#e32b2b;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </a>
                    </div>
                    @empty
                    <div class="text-center py-10 opacity-60">
                        <svg class="w-10 h-10 mx-auto mb-2" style="color:rgba(255,255,255,0.3);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round"></path></svg>
                        <p class="text-xs font-bold">No users waiting</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- ================= RECENT ACTIVITY TABLE ================= -->
    <div class="bg-white rounded-[2.5rem] shadow-xl border overflow-hidden" style="border-color:#fde8e8; box-shadow: 0 20px 40px rgba(227,43,43,0.06);">
        <div class="px-8 py-8 flex items-center justify-between" style="border-bottom: 1px solid #fef2f2;">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-2xl" style="background:#fef2f2; color:#e32b2b;">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-extrabold tracking-tight" style="color:#1a1a2e;">Recent Activity</h3>
                    <p class="text-xs font-medium mt-0.5" style="color:#9ca3af;">Live monitoring dari semua channel input</p>
                </div>
            </div>
            <div class="flex items-center gap-2 p-1.5 rounded-2xl border" style="border-color:#fde8e8;">
                <button class="text-white px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider shadow-lg" style="background:#e32b2b; box-shadow: 0 4px 12px rgba(227,43,43,0.3);">Live</button>
                <button class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider hover:bg-red-50 transition" style="color:#9ca3af;">Log Archive</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background:#fafafa;">
                        <th class="px-8 py-4 text-left text-[10px] font-black uppercase tracking-[0.15em]" style="color:#9ca3af;">Deployment (NDE / SC)</th>
                        <th class="px-8 py-4 text-left text-[10px] font-black uppercase tracking-[0.15em]" style="color:#9ca3af;">Location STO</th>
                        <th class="px-8 py-4 text-left text-[10px] font-black uppercase tracking-[0.15em]" style="color:#9ca3af;">Partner / Mitra</th>
                        <th class="px-8 py-4 text-center text-[10px] font-black uppercase tracking-[0.15em]" style="color:#9ca3af;">Status Order</th>
                        <th class="px-8 py-4 text-right text-[10px] font-black uppercase tracking-[0.15em]" style="color:#9ca3af;">Input Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentDeployments as $deploy)
                    @php
                        $status = optional($deploy->planning)->status_order ?? 'Unknown';
                        $pillStyle = 'background:#f3f4f6; color:#6b7280;';
                        if(stripos($status, 'Success') !== false)       $pillStyle = 'background:#d1fae5; color:#065f46;';
                        elseif(stripos($status, 'Pending') !== false || stripos($status, 'Wait') !== false) $pillStyle = 'background:#fef3c7; color:#92400e;';
                        elseif(stripos($status, 'Kendala') !== false || stripos($status, 'Gagal') !== false) $pillStyle = 'background:#fee2e2; color:#991b1b;';
                        elseif(stripos($status, 'Progress') !== false)  $pillStyle = 'background:#fef2f2; color:#e32b2b;';
                    @endphp
                    <tr class="hover:bg-red-50/30 transition-colors group" style="border-bottom: 1px solid #fafafa;">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="p-2.5 rounded-xl font-mono text-[10px] border transition-colors" style="background:#f5f5f5; color:#6b7280; border-color:transparent;">
                                    {{ $deploy->nde_jt ? 'NDE' : 'SC' }}
                                </div>
                                <div>
                                    <p class="text-sm font-black tracking-tight" style="color:#1a1a2e;">{{ $deploy->star_click_id ?: ($deploy->nde_jt ?: '-') }}</p>
                                    <p class="text-[10px] font-bold uppercase mt-0.5 tracking-tighter" style="color:#9ca3af;">{{ $deploy->nama_customer ?? 'Private Client' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border" style="background:#fafafa; border-color:#f3f4f6;">
                                <span class="w-1.5 h-1.5 rounded-full" style="background:#e32b2b;"></span>
                                <span class="text-xs font-bold" style="color:#374151;">STO {{ strtoupper($deploy->sto) }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-sm font-bold" style="color:#374151;">{{ $deploy->nama_mitra }}</p>
                            <p class="text-[10px] uppercase font-black tracking-widest mt-0.5" style="color:#9ca3af;">{{ $deploy->datel }}</p>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider border-b-2 border-black/5" style="{{ $pillStyle }}">
                                {{ $status }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex flex-col items-end">
                                <p class="text-[10px] font-black uppercase tracking-tighter mb-1" style="color:#e32b2b;">{{ $deploy->created_at ? $deploy->created_at->format('d M Y') : '-' }}</p>
                                <p class="text-xs font-bold tracking-tighter" style="color:#374151;">{{ $deploy->created_at ? $deploy->created_at->format('H:i A') : '-' }}</p>
                                <p class="text-[10px] font-medium" style="color:#9ca3af;">{{ $deploy->created_at ? $deploy->created_at->diffForHumans(null, true, true) : '' }}</p>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-20 text-center">
                            <div class="flex flex-col items-center gap-3" style="opacity:0.2;">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16m-7 6h7" stroke-width="2" stroke-linecap="round"></path></svg>
                                <p class="text-lg font-black uppercase tracking-widest">No activity found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 flex justify-center" style="background:#fafafa;">
            <a href="{{ route('deployment.lihat-data') }}" class="text-xs font-black uppercase tracking-[0.2em] flex items-center gap-2 hover:gap-4 transition-all duration-300 group" style="color:#e32b2b;">
                View Full Deployment Logs
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>

</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
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

    async function pollLiveTracking() {
        try {
            const res = await fetch('{{ route('admin.api.live-tracking') }}', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            // Stop polling jika session habis / tidak punya akses
            if (res.status === 401 || res.status === 403) {
                if (window._liveTrackingInterval) {
                    clearInterval(window._liveTrackingInterval);
                    window._liveTrackingInterval = null;
                }
                return;
            }
            if (!res.ok) return;
            const logs = await res.json();
            renderLiveTracking(logs);
        } catch (e) {
            // Diam saja jika fetch gagal (offline/navigasi)
        }
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
                    interaction: { intersect: false, mode: 'index' },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1a1a2e',
                            titleFont: { weight: 'bold' },
                            cornerRadius: 12,
                            displayColors: false,
                            callbacks: { label: (c) => ` Volume: ${c.parsed.y}` }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(243, 244, 246, 1)', drawBorder: false },
                            ticks: { font: { weight: 'bold' }, color: '#9ca3af', stepSize: 1 }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { weight: 'bold' }, color: '#9ca3af' }
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
        window._dashboardFilter = filter;

        // Update button UI
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.style.background = '';
            btn.style.color = '#9ca3af';
            btn.classList.remove('shadow-sm');
        });
        const activeBtn = document.getElementById(`btn-${filter}`);
        if (activeBtn) {
            activeBtn.style.background = 'white';
            activeBtn.style.color = '#e32b2b';
            activeBtn.classList.add('shadow-sm');
        }

        try {
            const response = await fetch(`{{ route('admin.api.trend-data') }}?filter=${filter}`);
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

    // Cleanup sebelum Turbo meng-cache halaman — WAJIB agar chart tidak corrupt saat restore
    document.addEventListener('turbo:before-cache', function () {
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

        const hours   = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        timeEl.textContent = `${hours}:${minutes}:${seconds}`;

        const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        dateEl.textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
    }

    // Start clock and keep it alive across Turbo navigations
    if (window._clockInterval) clearInterval(window._clockInterval);
    updateClock();
    window._clockInterval = setInterval(updateClock, 1000);

    document.addEventListener('turbo:before-cache', function () {
        if (window._clockInterval) {
            clearInterval(window._clockInterval);
            window._clockInterval = null;
        }
    });
</script>
@endsection
