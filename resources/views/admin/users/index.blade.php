@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4">

    <!-- ================= HEADER ================= -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-slate-800">
            Manajemen Akun
        </h1>
    </div>

    @if(session('success'))
    <div class="mb-4 rounded-lg bg-green-100 text-green-700 px-4 py-3">
        {{ session('success') }}
    </div>
    @endif

    <!-- ================= CARD ================= -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="px-5 py-3 text-left font-medium">Nama</th>
                    <th class="px-5 py-3 text-left font-medium">Email</th>
                    <th class="px-5 py-3 text-left font-medium">Role</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach($users as $user)

                @php
                $isSelfAdmin = auth()->id() === $user->id && $user->role === 'admin';
                @endphp

                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-3 font-medium text-slate-800">
                        {{ $user->name }}

                        @if($isSelfAdmin)
                        <span class="ml-2 text-xs px-2 py-0.5 rounded-full bg-red-100 text-red-600">
                            Anda
                        </span>
                        @endif
                    </td>

                    <td class="px-5 py-3 text-slate-600">
                        {{ $user->email }}
                    </td>

                    <td class="px-5 py-3">
                        <form action="/admin/users/{{ $user->id }}/role" method="POST">
                            @csrf

                            <select name="role"
                                onchange="this.form.submit()"
                                @disabled($isSelfAdmin)
                                class="rounded-lg border px-3 py-1.5 text-sm
                        focus:ring-2 focus:ring-red-500 focus:outline-none
                        disabled:opacity-50 disabled:cursor-not-allowed
                        @if($user->role=='admin') bg-red-50 text-red-700 border-red-300
                        @elseif($user->role=='user_optima') bg-blue-50 text-blue-700 border-blue-300
                        @else bg-yellow-50 text-yellow-700 border-yellow-300
                        @endif
                        ">
                                <option value="waiting" @selected($user->role=='waiting')>Waiting</option>
                                <option value="user_optima" @selected($user->role=='user_optima')>User Optima</option>
                                <option value="admin" @selected($user->role=='admin')>Admin</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>


        </table>
    </div>
</div>
@endsection