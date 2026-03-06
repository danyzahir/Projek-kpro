@extends('layouts.app')

@section('title', 'Progress Overview')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8 min-h-screen">

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-3 text-sm text-slate-500">
        <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition">Dashboard</a>
        <span>›</span>
        <span class="font-semibold text-slate-800">Progress Overview</span>
    </div>

    {{-- ===== HEADER ===== --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-6 relative overflow-hidden" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%); border-radius: 2rem;">
        {{-- Decorative blob --}}
        <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full blur-3xl opacity-30" style="background:#e32b2b;"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 rounded-full blur-3xl opacity-20" style="background:#3b82f6;"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-1">
                <div class="p-2 rounded-xl" style="background:rgba(227,43,43,0.25);">
                    <svg class="w-5 h-5" style="color:#fca5a5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-black uppercase tracking-[0.25em]" style="color:#fca5a5;">Progress Overview</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight">Monitoring Progress Deployment</h1>
            <p class="text-xs mt-1" style="color:#94a3b8;">Grafik distribusi tahapan progress seluruh deployment</p>
        </div>

        <div class="relative z-10 flex items-center gap-3">
            <div class="text-right">
                <div class="text-xs font-semibold" style="color:#94a3b8;" id="progress-date"></div>
                <div class="text-sm font-bold text-white" id="progress-time"></div>
            </div>
        </div>
    </div>



    {{-- ===== STAT CARDS ===== --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        {{-- Total Deployment --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border relative overflow-hidden group hover:-translate-y-1 transition-all duration-300" style="border-color:#fde8e8; box-shadow: 0 4px 20px rgba(227,43,43,0.06);">
            <div class="absolute -top-6 -right-6 w-20 h-20 rounded-full blur-2xl opacity-20" style="background:#e32b2b;"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-3">
                    <div class="p-2 rounded-xl" style="background:#fef2f2;">
                        <svg class="w-4 h-4" style="color:#e32b2b;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-widest" style="color:#9ca3af;">Total</span>
                </div>
                <p class="text-3xl font-black tracking-tight" style="color:#1a1a2e;">{{ number_format($totalAll) }}</p>
                <p class="text-[10px] font-bold mt-1" style="color:#9ca3af;">Seluruh Deployment</p>
            </div>
        </div>

        {{-- On Track --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border relative overflow-hidden group hover:-translate-y-1 transition-all duration-300" style="border-color:#d1fae5; box-shadow: 0 4px 20px rgba(16,185,129,0.06);">
            <div class="absolute -top-6 -right-6 w-20 h-20 rounded-full blur-2xl opacity-20" style="background:#10b981;"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-3">
                    <div class="p-2 rounded-xl" style="background:#ecfdf5;">
                        <svg class="w-4 h-4" style="color:#10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-widest" style="color:#9ca3af;">On Track</span>
                </div>
                <p class="text-3xl font-black tracking-tight" style="color:#065f46;">{{ number_format($totalOnTrack) }}</p>
                <p class="text-[10px] font-bold mt-1" style="color:#9ca3af;">Berjalan Normal</p>
            </div>
        </div>

        {{-- Selesai / Final Stages --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border relative overflow-hidden group hover:-translate-y-1 transition-all duration-300" style="border-color:#dbeafe; box-shadow: 0 4px 20px rgba(59,130,246,0.06);">
            <div class="absolute -top-6 -right-6 w-20 h-20 rounded-full blur-2xl opacity-20" style="background:#3b82f6;"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-3">
                    <div class="p-2 rounded-xl" style="background:#eff6ff;">
                        <svg class="w-4 h-4" style="color:#3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-widest" style="color:#9ca3af;">Selesai</span>
                </div>
                <p class="text-3xl font-black tracking-tight" style="color:#1e40af;">{{ number_format($totalSelesai) }}</p>
                <p class="text-[10px] font-bold mt-1" style="color:#9ca3af;">Tahap Akhir & Done</p>
            </div>
        </div>

        {{-- Kendala --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border relative overflow-hidden group hover:-translate-y-1 transition-all duration-300" style="border-color:#fee2e2; box-shadow: 0 4px 20px rgba(239,68,68,0.06);">
            <div class="absolute -top-6 -right-6 w-20 h-20 rounded-full blur-2xl opacity-20" style="background:#ef4444;"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-3">
                    <div class="p-2 rounded-xl" style="background:#fef2f2;">
                        <svg class="w-4 h-4" style="color:#ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-widest" style="color:#9ca3af;">Kendala</span>
                </div>
                <p class="text-3xl font-black tracking-tight" style="color:#991b1b;">{{ number_format($totalKendala) }}</p>
                <p class="text-[10px] font-bold mt-1" style="color:#9ca3af;">Butuh Perhatian</p>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-[2rem] p-6 sm:p-8 shadow-xl border" style="border-color:#fde8e8; box-shadow: 0 20px 40px rgba(227,43,43,0.06);">
        <div class="flex items-center gap-4 mb-6">
            <div class="p-3 rounded-2xl" style="background:#fef2f2; color:#e32b2b;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            </div>
            <div>
                <h3 class="text-xl font-extrabold tracking-tight" style="color:#1a1a2e;">Filter Data</h3>
                <p class="text-[10px] font-bold uppercase tracking-widest mt-0.5" style="color:#9ca3af;">Filter berdasarkan STO, Datel, atau Mitra</p>
            </div>
        </div>

        <form method="GET" action="{{ route('deployment.progress-overview') }}">
            <div class="flex flex-wrap items-end gap-3 p-4 rounded-2xl border" style="background:#fafafa; border-color:#f3f4f6;">
                <div class="flex-1 min-w-[120px]">
                    <label class="block text-[9px] font-bold uppercase tracking-widest mb-1" style="color:#9ca3af;">STO</label>
                    <select name="sto" class="w-full rounded-xl border-slate-200 bg-white text-xs font-semibold py-2 px-3 focus:ring-red-500 focus:border-red-500 transition">
                        <option value="">Semua STO</option>
                        @foreach($stoList as $sto)
                            <option value="{{ $sto }}" {{ $filterSto == $sto ? 'selected' : '' }}>{{ strtoupper($sto) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[120px]">
                    <label class="block text-[9px] font-bold uppercase tracking-widest mb-1" style="color:#9ca3af;">Datel</label>
                    <select name="datel" class="w-full rounded-xl border-slate-200 bg-white text-xs font-semibold py-2 px-3 focus:ring-red-500 focus:border-red-500 transition">
                        <option value="">Semua Datel</option>
                        @foreach($datelList as $datel)
                            <option value="{{ $datel }}" {{ $filterDatel == $datel ? 'selected' : '' }}>{{ $datel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[120px]">
                    <label class="block text-[9px] font-bold uppercase tracking-widest mb-1" style="color:#9ca3af;">Mitra</label>
                    <select name="mitra" class="w-full rounded-xl border-slate-200 bg-white text-xs font-semibold py-2 px-3 focus:ring-red-500 focus:border-red-500 transition">
                        <option value="">Semua Mitra</option>
                        @foreach($mitraList as $mitra)
                            <option value="{{ $mitra }}" {{ $filterMitra == $mitra ? 'selected' : '' }}>{{ $mitra }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <button type="submit" class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-wider text-white transition hover:shadow-lg hover:-translate-y-0.5" style="background: linear-gradient(135deg, #e32b2b 0%, #b91c1c 100%);">
                        Filter
                    </button>
                    @if($filterSto || $filterDatel || $filterMitra)
                    <a href="{{ route('deployment.progress-overview') }}" class="px-3 py-2 rounded-xl text-[10px] font-black uppercase tracking-wider transition hover:bg-red-50" style="color:#e32b2b; border: 1px solid #fde8e8;">
                        Reset
                    </a>
                    @endif
                </div>
            </div>
        </form>

        {{-- Filter Result Info --}}
        @if($filterSto || $filterDatel || $filterMitra)
        <div class="mt-6 pt-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4" style="border-top: 1px solid #fef2f2;">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-xl" style="background:#fef2f2;">
                    <svg class="w-5 h-5" style="color:#e32b2b;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold" style="color:#374151;">
                        Hasil Filter: <span class="text-lg font-black" style="color:#e32b2b;">{{ number_format($totalAll) }}</span> order
                    </p>
                    <p class="text-[10px] font-bold uppercase tracking-widest mt-0.5" style="color:#9ca3af;">
                        @if($filterSto) STO: {{ strtoupper($filterSto) }} @endif
                        @if($filterDatel) {{ $filterSto ? '·' : '' }} Datel: {{ $filterDatel }} @endif
                        @if($filterMitra) {{ ($filterSto || $filterDatel) ? '·' : '' }} Mitra: {{ $filterMitra }} @endif
                    </p>
                </div>
            </div>
            @if($topProgress)
            <div class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl" style="background: linear-gradient(135deg, #fef2f2 0%, #fff1f2 100%); border: 1px solid #fde8e8;">
                <svg class="w-4 h-4" style="color:#e32b2b;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                <span class="text-xs font-bold" style="color:#374151;">Terbanyak di <span class="font-black" style="color:#e32b2b;">{{ $topProgress }}</span> — {{ number_format($topProgressCount) }} order</span>
            </div>
            @endif
        </div>
        @endif
    </div>

    {{-- ===== BAR CHART ===== --}}
    <div class="bg-white rounded-[2rem] p-6 sm:p-8 shadow-xl border" style="border-color:#fde8e8; box-shadow: 0 20px 40px rgba(227,43,43,0.06);">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-2xl" style="background:#fef2f2; color:#e32b2b;">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-extrabold tracking-tight" style="color:#1a1a2e;">Progress Distribution</h3>
                    <p class="text-[10px] font-bold uppercase tracking-widest mt-0.5" style="color:#9ca3af;">Jumlah deployment per tahap progress</p>
                </div>
            </div>
            <div class="text-[10px] font-bold px-3 py-1.5 rounded-xl" style="color:#e32b2b; background:#fef2f2;">
                {{ $totalAll }} Total Deployment
            </div>
        </div>
        <div class="relative" style="min-height: 400px;">
            <canvas id="progressBarChart"></canvas>
        </div>
    </div>

    {{-- ===== RECENT UPDATES TABLE ===== --}}
    <div class="bg-white rounded-[2rem] shadow-xl border overflow-hidden" style="border-color:#fde8e8; box-shadow: 0 20px 40px rgba(227,43,43,0.06);">
        <div class="px-6 sm:px-8 py-6 sm:py-8 flex items-center justify-between" style="border-bottom: 1px solid #fef2f2;">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-2xl" style="background:#fef2f2; color:#e32b2b;">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-extrabold tracking-tight" style="color:#1a1a2e;">Update Terbaru</h3>
                    <p class="text-xs font-medium mt-0.5" style="color:#9ca3af;">10 deployment terakhir yang diperbarui</p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background:#fafafa;">
                        <th class="px-6 sm:px-8 py-4 text-left text-[10px] font-black uppercase tracking-[0.15em]" style="color:#9ca3af;">Star Click ID</th>
                        <th class="px-6 sm:px-8 py-4 text-left text-[10px] font-black uppercase tracking-[0.15em]" style="color:#9ca3af;">Customer</th>
                        <th class="px-6 sm:px-8 py-4 text-left text-[10px] font-black uppercase tracking-[0.15em]" style="color:#9ca3af;">STO</th>
                        <th class="px-6 sm:px-8 py-4 text-center text-[10px] font-black uppercase tracking-[0.15em]" style="color:#9ca3af;">Progress</th>
                        <th class="px-6 sm:px-8 py-4 text-right text-[10px] font-black uppercase tracking-[0.15em]" style="color:#9ca3af;">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentUpdates as $item)
                    @php
                        $badgeStyle = 'background:#fef2f2; color:#e32b2b;';
                        if(in_array($item->progres, ['GOLIVE','PS','SELESAI FISIK','UJI TERIMA','REKON'])) $badgeStyle = 'background:#ecfdf5; color:#065f46;';
                        elseif($item->progres === 'KENDALA') $badgeStyle = 'background:#fee2e2; color:#991b1b;';
                    @endphp
                    <tr class="hover:bg-red-50/30 transition-colors" style="border-bottom: 1px solid #fafafa;">
                        <td class="px-6 sm:px-8 py-4">
                            <p class="text-sm font-black tracking-tight" style="color:#1a1a2e;">{{ $item->star_click_id ?? '-' }}</p>
                        </td>
                        <td class="px-6 sm:px-8 py-4">
                            <p class="text-sm font-medium" style="color:#374151;">{{ $item->nama_customer ?? '-' }}</p>
                            <p class="text-[10px] font-bold uppercase mt-0.5" style="color:#9ca3af;">{{ $item->datel }}</p>
                        </td>
                        <td class="px-6 sm:px-8 py-4">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border" style="background:#fafafa; border-color:#f3f4f6;">
                                <span class="w-1.5 h-1.5 rounded-full" style="background:#e32b2b;"></span>
                                <span class="text-xs font-bold" style="color:#374151;">STO {{ strtoupper($item->sto) }}</span>
                            </div>
                        </td>
                        <td class="px-6 sm:px-8 py-4 text-center">
                            <span class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider" style="{{ $badgeStyle }}">
                                {{ $item->progres }}
                            </span>
                        </td>
                        <td class="px-6 sm:px-8 py-4 text-right">
                            <p class="text-[10px] font-black uppercase tracking-tighter" style="color:#e32b2b;">{{ $item->updated_at ? $item->updated_at->format('d M Y') : '-' }}</p>
                            <p class="text-xs font-bold tracking-tighter" style="color:#374151;">{{ $item->updated_at ? $item->updated_at->format('H:i') : '-' }}</p>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-16 text-center">
                            <div class="flex flex-col items-center gap-3" style="opacity:0.2;">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16m-7 6h7" stroke-width="2" stroke-linecap="round"></path></svg>
                                <p class="text-lg font-black uppercase tracking-widest">Belum ada data</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    function initProgressChart() {
        if (typeof Chart === 'undefined') {
            const s = document.createElement('script');
            s.src = 'https://cdn.jsdelivr.net/npm/chart.js';
            s.setAttribute('data-chartjs', '1');
            s.onload = buildChart;
            document.head.appendChild(s);
        } else {
            buildChart();
        }
    }

    function buildChart() {
        const ctx = document.getElementById('progressBarChart');
        if (!ctx) return;

        if (window._progressChart instanceof Chart) {
            window._progressChart.destroy();
            window._progressChart = null;
        }

        const labels = @json($labels);
        const values = @json($values);

        // Color mapping per stage
        const colorMap = {
            'ON DESK':          { bg: 'rgba(99,102,241,0.85)',  border: '#6366f1' },
            'SURVEY':           { bg: 'rgba(59,130,246,0.85)',  border: '#3b82f6' },
            'PERIJINAN':        { bg: 'rgba(14,165,233,0.85)',  border: '#0ea5e9' },
            'DRM':              { bg: 'rgba(20,184,166,0.85)',  border: '#14b8a6' },
            'APPROVED BY EBIS': { bg: 'rgba(16,185,129,0.85)',  border: '#10b981' },
            'MATDEV':           { bg: 'rgba(34,197,94,0.85)',   border: '#22c55e' },
            'INSTALASI':        { bg: 'rgba(132,204,22,0.85)',  border: '#84cc16' },
            'SELESAI FISIK':    { bg: 'rgba(234,179,8,0.85)',   border: '#eab308' },
            'GOLIVE':           { bg: 'rgba(245,158,11,0.85)',  border: '#f59e0b' },
            'PS':               { bg: 'rgba(249,115,22,0.85)',  border: '#f97316' },
            'KENDALA':          { bg: 'rgba(239,68,68,0.85)',   border: '#ef4444' },
            'UJI TERIMA':       { bg: 'rgba(168,85,247,0.85)',  border: '#a855f7' },
            'REKON':            { bg: 'rgba(236,72,153,0.85)',  border: '#ec4899' },
        };

        const bgColors = labels.map(l => (colorMap[l] || { bg: 'rgba(107,114,128,0.8)' }).bg);
        const borderColors = labels.map(l => (colorMap[l] || { border: '#6b7280' }).border);

        window._progressChart = new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Deployment',
                    data: values,
                    backgroundColor: bgColors,
                    borderColor: borderColors,
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                    barPercentage: 0.7,
                    categoryPercentage: 0.8,
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
                        titleFont: { weight: 'bold', size: 13 },
                        bodyFont: { size: 12 },
                        cornerRadius: 12,
                        padding: 12,
                        displayColors: true,
                        callbacks: {
                            title: (items) => `Tahap: ${items[0].label}`,
                            label: (c) => ` ${c.parsed.y} Deployment`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(243, 244, 246, 1)', drawBorder: false },
                        ticks: {
                            font: { weight: 'bold', size: 11 },
                            color: '#9ca3af',
                            stepSize: 1,
                            precision: 0,
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Deployment',
                            font: { weight: 'bold', size: 12 },
                            color: '#6b7280'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { weight: 'bold', size: 10 },
                            color: '#6b7280',
                            maxRotation: 45,
                            minRotation: 45,
                        }
                    }
                },
                animation: {
                    duration: 1200,
                    easing: 'easeOutQuart'
                }
            }
        });
    }

    // Clock
    function updateProgressClock() {
        const now = new Date();
        const dateEl = document.getElementById('progress-date');
        const timeEl = document.getElementById('progress-time');
        if (!dateEl || !timeEl) return;

        const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        dateEl.textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
        timeEl.textContent = `${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')} WIB`;
    }

    // Bootstrap
    document.addEventListener('turbo:load', initProgressChart);
    document.addEventListener('DOMContentLoaded', initProgressChart);

    updateProgressClock();
    setInterval(updateProgressClock, 60000);

    // Cleanup for Turbo
    document.addEventListener('turbo:before-cache', function() {
        if (window._progressChart instanceof Chart) {
            window._progressChart.destroy();
            window._progressChart = null;
        }
    });
</script>
@endsection
