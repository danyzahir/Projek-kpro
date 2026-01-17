@extends('layouts.app')

@section('title', 'B2B')

@section('content')
<div class="max-w-6xl mx-auto">

    <!-- ================= PAGE HEADER ================= -->
    <div class="mb-12">
        <h1 class="text-3xl font-semibold text-slate-800 tracking-tight">
            Deployment <span class="text-slate-400 font-normal">– B2B</span>
        </h1>
        <p class="text-slate-500 mt-2 max-w-2xl">
            Kelola proses deployment B2B melalui menu berikut.
        </p>
    </div>

    <!-- ================= DASHBOARD CARDS ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        <!-- ================= UPLOAD ================= -->
        <a href="{{ route('deployment.upload') }}"
           class="group rounded-3xl bg-white p-6
                  border border-slate-200
                  hover:border-green-300 hover:shadow-lg
                  transition-all duration-300">

            <div class="w-12 h-12 flex items-center justify-center
                        rounded-2xl bg-green-100 text-green-600 mb-5
                        group-hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 16V4m0 0l-4 4m4-4l4 4M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-slate-800">Upload</h3>
            <p class="text-sm text-slate-500 mt-1">
                Upload data B2B secara massal.
            </p>
        </a>

        <!-- ================= INPUT (PRIMARY) ================= -->
        <a href="{{ route('deployment.input') }}"
           class="group relative rounded-3xl p-6
                  bg-gradient-to-br from-red-600 to-red-500
                  text-white shadow-md
                  hover:shadow-xl transition-all duration-300">

            <div class="w-12 h-12 flex items-center justify-center
                        rounded-2xl bg-white/20 mb-5
                        group-hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16.862 3.487a2.121 2.121 0 013 3L7.5 18.85l-4 1 1-4L16.862 3.487z" />
                </svg>
            </div>

            <h3 class="text-lg font-semibold">Input</h3>
            <p class="text-sm text-red-100 mt-1">
                Input dan perbarui data manual.
            </p>

            <span class="absolute top-4 right-4 text-xs font-semibold
                         bg-white/20 px-2 py-1 rounded-full">
                Utama
            </span>
        </a>

        <!-- ================= UPDATE ================= -->
        <a href="{{ route('deployment.update.list') }}"
           class="group rounded-3xl bg-white p-6
                  border border-slate-200
                  hover:border-amber-300 hover:shadow-lg
                  transition-all duration-300">

            <div class="w-12 h-12 flex items-center justify-center
                        rounded-2xl bg-amber-100 text-amber-600 mb-5
                        group-hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16.862 3.487a2.121 2.121 0 013 3L7.5 18.85l-4 1 1-4L16.862 3.487z" />
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-slate-800">Update</h3>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui status & progres data.
            </p>
        </a>

        <!-- ================= REKAP ================= -->
        <a href="{{ route('deployment.rekap') }}"
           class="group rounded-3xl bg-white p-6
                  border border-slate-200
                  hover:border-blue-300 hover:shadow-lg
                  transition-all duration-300">

            <div class="w-12 h-12 flex items-center justify-center
                        rounded-2xl bg-blue-100 text-blue-600 mb-5
                        group-hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h18M3 8h18M3 13h6m4 4h8M3 18h8" />
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-slate-800">Rekap</h3>
            <p class="text-sm text-slate-500 mt-1">
                Ringkasan & laporan data.
            </p>
        </a>

    </div>

</div>
@endsection
