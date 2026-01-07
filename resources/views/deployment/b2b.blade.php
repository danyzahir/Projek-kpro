@extends('layouts.app')

@section('title', 'B2B')
@section('content')
<div class="max-w-6xl mx-auto">

    <!-- Page Header -->
    <div class="mb-10">
        <h1 class="text-3xl font-semibold text-slate-800">
            Development – B2B
        </h1>
        <p class="text-slate-500 mt-1">
            Kelola proses upload, input, dan rekap data B2B
        </p>
    </div>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

        <!-- UPLOAD -->
        <a href="#"
           class="group relative bg-white rounded-2xl p-6 shadow-sm
                  hover:shadow-xl hover:-translate-y-1
                  transition-all duration-300">

            <div class="flex items-center justify-center w-12 h-12
                        rounded-xl bg-green-100 text-green-600 mb-4">
                <!-- Upload Icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 16V4m0 0l-4 4m4-4l4 4M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-slate-800">
                Upload
            </h3>
            <p class="text-sm text-slate-500 mt-1">
                Upload file atau data B2B
            </p>
        </a>

        <!-- INPUT (PRIMARY) -->
        <a href="{{ route('deployment.input') }}"
           class="group relative bg-red-600 rounded-2xl p-6 shadow-sm
                  hover:shadow-xl hover:-translate-y-1
                  transition-all duration-300 text-white">

            <div class="flex items-center justify-center w-12 h-12
                        rounded-xl bg-white/20 mb-4">
                <!-- Input Icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16.862 3.487a2.121 2.121 0 013 3L7.5 18.85l-4 1 1-4L16.862 3.487z" />
                </svg>
            </div>

            <h3 class="text-lg font-semibold">
                Input
            </h3>
            <p class="text-sm text-red-100 mt-1">
                Input data secara manual
            </p>
        </a>

        <!-- REKAP -->
        <a href="#"
           class="group relative bg-white rounded-2xl p-6 shadow-sm
                  hover:shadow-xl hover:-translate-y-1
                  transition-all duration-300">

            <div class="flex items-center justify-center w-12 h-12
                        rounded-xl bg-blue-100 text-blue-600 mb-4">
                <!-- Rekap Icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h18M3 8h18M3 13h6m4 4h8M3 18h8" />
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-slate-800">
                Rekap Data
            </h3>
            <p class="text-sm text-slate-500 mt-1">
                Laporan & ringkasan data
            </p>
        </a>

    </div>

</div>
@endsection
