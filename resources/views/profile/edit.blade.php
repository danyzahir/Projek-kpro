@extends('layouts.app')

@section('title', 'Profile Saya')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div class="mb-2">
        <h1 class="text-2xl font-bold text-slate-800">Profile Saya</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola informasi akun dan keamanan Anda</p>
    </div>


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
