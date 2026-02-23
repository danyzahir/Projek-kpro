@extends('layouts.app')

@section('title', 'Profile Saya')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div class="mb-2">
        <h1 class="text-2xl font-bold text-slate-800">Profile Saya</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola informasi akun dan keamanan Anda</p>
    </div>

    {{-- INBOX NOTIFIKASI --}}
    @if(isset($overdueOrders) && $overdueOrders->count() > 0)
    <div id="inbox" class="bg-white rounded-2xl shadow-sm border border-red-200 overflow-hidden">
        <div class="px-6 py-4 bg-red-50 border-b border-red-200 flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-red-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-red-800">Inbox Notifikasi</h2>
                <p class="text-xs text-red-600">{{ $overdueOrders->count() }} order melewati tanggal komitmen</p>
            </div>
        </div>

        <div class="divide-y divide-slate-100">
            @foreach($overdueOrders as $order)
            <div class="px-6 py-4 flex items-center justify-between hover:bg-red-50/50 transition">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-slate-800">
                            {{ $order->star_click_id }} — {{ $order->nama_customer }}
                        </div>
                        <div class="text-xs text-slate-500 mt-0.5">
                            Komitmen: <span class="text-red-600 font-medium">{{ \Carbon\Carbon::parse($order->data['commitment_date'])->format('d M Y') }}</span>
                            · STO: {{ $order->sto ?? '-' }}
                        </div>
                    </div>
                </div>
                <a href="{{ route('deployment.edit', $order->id) }}"
                   class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition ring-1 ring-red-200">
                    Update
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- PROFILE INFO & AVATAR CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="bg-gradient-to-r from-red-600 to-red-500 h-24 relative">
            <div class="absolute -bottom-8 left-6">
                <div class="w-16 h-16 rounded-2xl bg-white shadow-lg flex items-center justify-center
                            text-2xl font-bold text-red-600 border-4 border-white">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
        <div class="pt-12 pb-6 px-6">
            <h2 class="text-lg font-semibold text-slate-800">{{ auth()->user()->name }}</h2>
            <p class="text-sm text-slate-500">{{ auth()->user()->email }}</p>
            <span class="inline-flex mt-2 items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase
                {{ auth()->user()->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                {{ auth()->user()->role }}
            </span>
        </div>
    </div>

    {{-- UPDATE PROFILE INFO --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        @include('profile.partials.update-profile-information-form')
    </div>

    {{-- UPDATE PASSWORD --}}
    <div id="password" class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        @include('profile.partials.update-password-form')
    </div>

    {{-- DELETE ACCOUNT --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        @include('profile.partials.delete-user-form')
    </div>

</div>
@endsection
