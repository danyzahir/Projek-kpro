@if (session('error'))
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
    <div class="flex items-start gap-3 bg-white border-l-4 border-red-500
                shadow-lg rounded-xl p-4 w-80">

        <!-- ICON -->
        <div class="flex-shrink-0">
            <svg class="w-6 h-6 text-red-600"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v2m0 4h.01M12 3
                         c-4.418 0-8 3.582-8 8
                         s3.582 8 8 8
                         s8-3.582 8-8
                         s-3.582-8-8-8z"/>
            </svg>
        </div>

        <!-- TEXT -->
        <div class="flex-1">
            <p class="font-semibold text-slate-800">Gagal</p>
            <p class="text-sm text-slate-600">
                {{ session('error') }}
            </p>
        </div>

        <!-- CLOSE -->
        <button @click="show = false"
                class="text-slate-400 hover:text-slate-600">
            ✕
        </button>
    </div>
</div>
@endif
