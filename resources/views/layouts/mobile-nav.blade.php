<nav x-data="{ b2bOpen: false }" class="block lg:hidden">

    {{-- BACKDROP --}}
    <div x-show="b2bOpen" 
         @click="b2bOpen = false"
         x-transition.opacity.duration.200ms
         class="fixed inset-0 z-40 bg-black/60"
         style="display: none;">
    </div>

    {{-- MENU CARD --}}
    <div x-cloak x-show="b2bOpen" 
         @click.outside="b2bOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-8 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-8 scale-95"
         class="fixed z-50 w-80 bg-white rounded-3xl shadow-2xl p-6 border border-slate-100"
         style="left: 50%; transform: translateX(-50%); bottom: calc(4.5rem + env(safe-area-inset-bottom, 0px)); display: none;">
        
        {{-- Arrow --}}
        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white rotate-45 border-b border-r border-slate-100"></div>

        <div class="text-center mb-5">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Menu Pintas</h3>
            <div class="w-8 h-1 bg-red-100 rounded-full mx-auto mt-2"></div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            {{-- 1. Input --}}
            <a href="{{ route('deployment.input') }}" class="flex flex-col items-center gap-3 p-4 rounded-2xl active:scale-95 transition-all group text-center relative overflow-hidden" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border: 1px solid #bfdbfe;">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-md" style="background: linear-gradient(135deg, #3b82f6, #2563eb); box-shadow: 0 4px 12px rgba(59,130,246,0.4);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </div>
                <span class="text-xs font-black text-blue-700 tracking-wide">Input</span>
            </a>

            {{-- 2. Lihat --}}
            <a href="{{ route('deployment.lihat-data') }}" class="flex flex-col items-center gap-3 p-4 rounded-2xl active:scale-95 transition-all group text-center relative overflow-hidden" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #bbf7d0;">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-md" style="background: linear-gradient(135deg, #22c55e, #16a34a); box-shadow: 0 4px 12px rgba(34,197,94,0.4);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <span class="text-xs font-black text-green-700 tracking-wide">Lihat</span>
            </a>

            {{-- 3. Update --}}
            <a href="{{ route('deployment.update') }}" class="flex flex-col items-center gap-3 p-4 rounded-2xl active:scale-95 transition-all group text-center relative overflow-hidden" style="background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%); border: 1px solid #fed7aa;">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-md" style="background: linear-gradient(135deg, #f97316, #ea580c); box-shadow: 0 4px 12px rgba(249,115,22,0.4);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                </div>
                <span class="text-xs font-black text-orange-700 tracking-wide">Update</span>
            </a>

            {{-- 4. Upload --}}
            <a href="{{ route('deployment.upload') }}" class="flex flex-col items-center gap-3 p-4 rounded-2xl active:scale-95 transition-all group text-center relative overflow-hidden" style="background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%); border: 1px solid #e9d5ff;">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-md" style="background: linear-gradient(135deg, #a855f7, #9333ea); box-shadow: 0 4px 12px rgba(168,85,247,0.4);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                </div>
                <span class="text-xs font-black text-purple-700 tracking-wide">Upload</span>
            </a>
        </div>
    </div>

    {{-- FLOATING BUTTON (posisi seperti footer, menempel di bawah) --}}
    <button @click="b2bOpen = !b2bOpen"
            class="fixed z-50 w-16 h-16 rounded-full shadow-[0_4px_20px_rgba(220,38,38,0.4)] flex flex-col items-center justify-center text-white border-4 border-slate-50 transition-all duration-300 active:scale-90"
            style="left: 50%; transform: translateX(-50%); bottom: calc(0.5rem + env(safe-area-inset-bottom, 0px));"
            :class="b2bOpen ? 'bg-slate-800 border-slate-800' : 'bg-red-600'">

        <svg x-show="!b2bOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h6v6H4zM14 6h6v6h-6zM4 16h6v6H4zM14 16h6v6h-6z" />
        </svg>
        
        <svg x-show="b2bOpen" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display: none;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>

        <span x-show="!b2bOpen" class="text-[9px] font-black uppercase tracking-widest leading-none">MENU</span>
    </button>

</nav>
