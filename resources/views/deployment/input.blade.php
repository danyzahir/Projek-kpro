@extends('layouts.app')

@section('title', 'Input Data')

@section('content')

<!-- ================= BREADCRUMB ================= -->

<div class="flex items-center gap-3 text-sm text-slate-500 mb-6">
    <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition">
        Dashboard
    </a>
    <span>›</span>
    <a href="{{ route('deployment.b2b') }}" class="hover:text-red-600 transition">
        B2B
    </a>
    <span>›</span>
    <span class="font-semibold text-slate-800">Input</span>
</div>

<div class="flex flex-col gap-6">
    <!-- ================= FORM CARD ================= -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <!-- ================= TOAST NOTIFICATION ================= -->
        <div x-show="toastOpen" x-transition.opacity x-cloak class="fixed bottom-6 right-6 z-[9999]">

            <div
                class="flex items-center gap-3
               rounded-xl bg-red-600 text-white
               px-4 py-3 shadow-lg">

                <!-- ICON -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M12 5a7 7 0 100 14 7 7 0 000-14z" />
                </svg>

                <span x-text="toastMsg" class="text-sm font-medium"></span>
            </div>
        </div>

        <form x-data="ebisForm()" x-init="formEl = $el" method="POST" action="{{ route('ebis.manual.store') }}"
            class="space-y-8">

            @csrf

            <!-- ================= IDENTITAS ================= -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- NDE JT (TIDAK WAJIB) -->
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">
                        Nomor NDE JT
                    </label>
                    <input name="nde_jt" type="text"
                        class="w-full rounded-lg border px-3 py-2 text-sm
                               focus:ring-2 focus:ring-red-500 focus:outline-none"
                        placeholder="Masukkan nomor NDE JT">

                </div>

                <!-- STARCLICK -->
                <div data-field-wrapper>
                    <label class="block text-sm font-medium text-slate-600 mb-1">
                        Starclick ID / NCX <span class="text-red-600">*</span>
                    </label>
                    <input name="star_click_id" type="text" data-required="true"
                        class="w-full rounded-lg border px-3 py-2 text-sm
                               focus:ring-2 focus:ring-red-500 focus:outline-none"
                        placeholder="Masukkan Starclick ID / NCX">
                    <!-- CLIENT SIDE ERROR (MUNCUL SETELAH SUBMIT) -->
                    <p
                        x-show="showError && errorField === 'star_click_id'"
                        x-transition
                        class="text-sm text-red-600 mt-1">
                        Data wajib diisi
                    </p>
                    @error('star_click_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            <!-- ================= PELANGGAN ================= -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nama Pelanggan -->
                <div data-field-wrapper>
                    <label class="block text-sm font-medium text-slate-600 mb-1">
                        Nama Pelanggan <span class="text-red-600">*</span>
                    </label>
                    <input name="nama_customer" type="text" data-required="true"
                        class="w-full rounded-lg border px-3 py-2 text-sm
                   focus:ring-2 focus:ring-red-500 focus:outline-none"
                        placeholder="Nama lengkap pelanggan">
                    <p
                        x-show="showError && errorField === 'nama_customer'"
                        x-transition
                        class="text-sm text-red-600 mt-1">
                        Data wajib diisi
                    </p>

                    @error('nama_customer')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Telepon -->
                <div data-field-wrapper>
                    <label class="block text-sm font-medium text-slate-600 mb-1">
                        Telepon Pelanggan <span class="text-red-600">*</span>
                    </label>
                    <input name="telepon_pelanggan" type="text" data-required="true"
                        class="w-full rounded-lg border px-3 py-2 text-sm
                   focus:ring-2 focus:ring-red-500 focus:outline-none"
                        placeholder="08xxxxxxxxxx">
                    <p
                        x-show="showError && errorField === 'telepon_pelanggan'"
                        x-transition
                        class="text-sm text-red-600 mt-1">
                        Data wajib diisi
                    </p>

                    @error('telepon_pelanggan')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tikor -->


            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div data-field-wrapper>
                    <label class="block text-sm font-medium text-slate-600 mb-1">
                        Titik Koordinat (Tikor) <span class="text-red-600">*</span>
                    </label>
                    <input name="tikor_pelanggan" type="text" data-required="true"
                        class="w-full rounded-lg border px-3 py-2 text-sm
                   focus:ring-2 focus:ring-red-500 focus:outline-none"
                        placeholder="-6.xxxxx, 108.xxxxx">
                    <p
                        x-show="showError && errorField === 'tikor_pelanggan'"
                        x-transition
                        class="text-sm text-red-600 mt-1">
                        Data wajib diisi
                    </p>

                    @error('tikor_pelanggan')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat (FULL WIDTH) -->
                <div data-field-wrapper>
                    <label class="block text-sm font-medium text-slate-600 mb-1">
                        Alamat Pelanggan <span class="text-red-600">*</span>
                    </label>
                    <input name="alamat_pelanggan" type="text" data-required="true"
                        class="w-full rounded-lg border px-3 py-2 text-sm
                   focus:ring-2 focus:ring-red-500 focus:outline-none"
                        placeholder="Alamat lengkap pelanggan">
                    <p
                        x-show="showError && errorField === 'alamat_pelanggan'"
                        x-transition
                        class="text-sm text-red-600 mt-1">
                        Data wajib diisi
                    </p>

                    @error('alamat_pelanggan')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>




            <!-- ================= LOKASI ================= -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div data-field-wrapper x-data="searchableSelect(@js($datels))" class="relative">
                    <label class="block text-sm font-medium text-slate-600 mb-1">
                        Datel <span class="text-red-600">*</span>
                    </label>

                    <input type="text" x-model="search" @focus="open = true" @click="open = true"
                        @input="open = true; clearIfEmpty();" @blur="clearIfEmpty()" placeholder="Datel"
                        class="w-full rounded-lg border px-3 py-2 text-sm
                                focus:ring-2 focus:ring-red-500 focus:outline-none"
                        required>

                    <input type="hidden" name="datel" x-model="selected" data-required="true">

                    <div x-show="open" @click.outside="open = false"
                        class="absolute z-50 mt-1 w-full bg-white border rounded-lg shadow max-h-48 overflow-y-auto">
                        <template x-for="item in filtered()" :key="item">
                            <div @click="select(item)" class="px-3 py-2 text-sm cursor-pointer hover:bg-red-50">
                                <span x-text="item"></span>
                            </div>
                        </template>

                        <div x-show="filtered().length === 0" class="px-3 py-2 text-sm text-slate-400">
                            Tidak ditemukan
                        </div>
                    </div>
                    <p
                        x-show="showError && errorField === 'datel'"
                        x-transition
                        class="text-sm text-red-600 mt-1">
                        Data wajib dipilih
                    </p>
                </div>


                <div data-field-wrapper x-data="searchableSelect(@js($stos))" class="relative">
                    <label class="block text-sm font-medium text-slate-600 mb-1">
                        STO <span class="text-red-600">*</span>
                    </label>

                    <input type="text" x-model="search" @focus="open = true" @click="open = true"
                        @input="open = true; clearIfEmpty();" @blur="clearIfEmpty()" placeholder="STO"
                        class="w-full rounded-lg border px-3 py-2 text-sm
                                focus:ring-2 focus:ring-red-500 focus:outline-none"
                        required>

                    <input type="hidden" name="sto" x-model="selected" data-required="true">

                    <div x-show="open" @click.outside="open = false"
                        class="absolute z-50 mt-1 w-full bg-white border rounded-lg shadow max-h-48 overflow-y-auto">
                        <template x-for="item in filtered()" :key="item">
                            <div @click="select(item)" class="px-3 py-2 text-sm cursor-pointer hover:bg-red-50">
                                <span x-text="item"></span>
                            </div>
                        </template>

                        <div x-show="filtered().length === 0" class="px-3 py-2 text-sm text-slate-400">
                            Tidak ditemukan
                        </div>
                    </div>
                    <p
                        x-show="showError && errorField === 'sto'"
                        x-transition
                        class="text-sm text-red-600 mt-1">
                        Data wajib dipilih
                    </p>
                </div>
            </div>
            <!-- ================= MITRA + LINK DOKUMEN ================= -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nama Mitra -->
                <div data-field-wrapper x-data="searchableSelect(@js($mitras))" class="relative">
                    <label class="block text-sm font-medium text-slate-600 mb-1">
                        Nama Mitra <span class="text-red-600">*</span>
                    </label>

                    <input
                        type="text"
                        x-model="search"
                        @focus="open = true"
                        @click="open = true"
                        @input="open = true; clearIfEmpty()"
                        @blur="clearIfEmpty()"
                        placeholder="Nama Mitra"
                        class="w-full rounded-lg border px-3 py-2 text-sm
                   focus:ring-2 focus:ring-red-500 focus:outline-none"
                        required>

                    <input type="hidden" name="nama_mitra" x-model="selected" data-required="true">

                    <div x-show="open"
                        @click.outside="open = false"
                        class="absolute z-50 mt-1 w-full bg-white border rounded-lg shadow max-h-48 overflow-y-auto">

                        <template x-for="item in filtered()" :key="item">
                            <div @click="select(item)"
                                class="px-3 py-2 text-sm cursor-pointer hover:bg-red-50">
                                <span x-text="item"></span>
                            </div>
                        </template>

                        <div x-show="filtered().length === 0"
                            class="px-3 py-2 text-sm text-slate-400">
                            Tidak ditemukan
                        </div>
                    </div>

                    <p
                        x-show="showError && errorField === 'nama_mitra'"
                        x-transition
                        class="text-sm text-red-600 mt-1">
                        Data wajib dipilih
                    </p>

                    @error('nama_mitra')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>



            <!-- ================= ACTION ================= -->
            <div class="flex justify-end">
                <button
                    type="button"
                    @click="submitForm()"
                    class="px-6 py-2 rounded-lg transition
               bg-red-600 text-white
               hover:bg-red-700">
                    Submit Data
                </button>
            </div>



            <p x-show="!valid" class="text-sm text-red-600 mt-2">

            </p>




            <!-- ================= MODAL KONFIRMASI (NO BLUR, NO OVERLAY) ================= -->
            <template x-teleport="body">
                <div x-show="confirmOpen" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center">
                    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
                        <h3 class="text-lg font-semibold text-slate-800 mb-2"> Konfirmasi Simpan Data </h3>
                        <p class="text-sm text-slate-600 mb-6"> Pastikan data yang Anda input sudah benar. Data akan
                            langsung disimpan ke sistem. </p>
                        <div class="flex justify-end gap-3">
                            <button type="button" @click="confirmOpen = false"
                                class="px-4 py-2 rounded-lg border text-slate-600 hover:bg-slate-100 transition"> Batal
                            </button> <!-- SUBMIT FORM -->
                            <button type="button" @click="submitForm()"
                                class="px-6 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                                Ya, Simpan
                            </button>

                        </div>
                    </div>
                </div>
            </template>

        </form>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script>
    function ebisForm() {
        return {
            formEl: null,
            confirmOpen: false,
            valid: true,
            toastOpen: false,
            toastMsg: '',
            invalidField: null,
            errorField: null,
            showError: false,

            checkRequired() {
                const requiredFields = [...this.formEl.querySelectorAll('[data-required=true]')];

                this.valid = true;
                this.invalidField = null;
                this.errorField = null;

                // reset
                this.formEl.querySelectorAll('[data-field-wrapper]').forEach(wrapper => {
                    wrapper.querySelector('label')?.classList.remove('text-red-600');
                    wrapper.querySelector('input')?.classList.remove('border-red-500');
                });

                for (let field of requiredFields) {
                    if (!field.value || field.value.trim() === '') {
                        this.valid = false;
                        this.invalidField = field;
                        this.errorField = field.getAttribute('name');

                        const wrapper = field.closest('[data-field-wrapper]');
                        wrapper?.querySelector('label')?.classList.add('text-red-600');

                        const target = field.type === 'hidden' ?
                            wrapper?.querySelector('input[type="text"]') :
                            field;

                        target?.classList.add('border-red-500');
                        break;
                    }
                }
            },


            scrollToInvalid() {
                if (!this.invalidField) return;

                let target = this.invalidField;

                if (this.invalidField.type === 'hidden') {
                    target = this.invalidField
                        .closest('[data-field-wrapper]')
                        ?.querySelector('input[type="text"]');
                }

                if (!target) return;

                const y = target.getBoundingClientRect().top + window.pageYOffset - 120;
                window.scrollTo({
                    top: y,
                    behavior: 'smooth'
                });


                target.focus();
                target.classList.add('ring-2', 'ring-red-500');

                setTimeout(() => {
                    target.classList.remove('ring-2', 'ring-red-500');
                }, 2000);
            },

            submitForm() {
                this.showError = true;
                this.checkRequired();

                if (!this.valid) {
                    this.showAlert(); // 🔔 POP UP DULU
                    this.confirmOpen = false;
                    return;
                }

                this.formEl.submit();
            },

            showAlert() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Harap lengkapi semua field yang wajib diisi',
                    confirmButtonText: 'OK'
                }).then(() => {
                    this.scrollToInvalid(); // 👉 baru ke field kosong
                });
            },

            showToast(msg) {
                this.toastMsg = msg;
                this.toastOpen = true;
                setTimeout(() => this.toastOpen = false, 3000);
            }
        }
    }

    // ==========================
    // SELECT SEARCHABLE (AMAN)
    // ==========================
    function searchableSelect(items) {
        return {
            open: false,
            search: '',
            selected: '',

            filtered() {
                return items.filter(item =>
                    item.toLowerCase().includes(this.search.toLowerCase())
                );
            },

            select(item) {
                this.selected = item;
                this.search = item;
                this.open = false;
            },

            clearIfEmpty() {
                if (this.search.trim() === '') {
                    this.selected = '';
                }
            }
        }
    }
</script>


@endsection