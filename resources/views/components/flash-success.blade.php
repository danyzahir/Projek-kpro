@if (session('success'))
<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)"
    x-transition:enter="transform ease-out duration-300"
    x-transition:enter-start="translate-y-2 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transform ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-[72px] right-5 z-50"


>
    <div class="flex items-start gap-3 bg-white border-l-4 border-green-500
                shadow-lg rounded-xl p-4 w-80">

        
        <div class="flex-shrink-0">
            <svg class="w-6 h-6 text-green-600"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        
        <div class="flex-1">
            <p class="font-semibold text-slate-800">Berhasil</p>
            <p class="text-sm text-slate-600">
                {{ session('success') }}
            </p>
        </div>

        
        <button @click="show = false"
                class="text-slate-400 hover:text-slate-600">
            ✕
        </button>
    </div>
</div>
@endif
