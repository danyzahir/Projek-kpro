@extends('layouts.app')

@section('title', 'Input Data ')

@section('content')
<div class="flex flex-col gap-6">

    

    <!-- ================= FORM CARD ================= -->
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-red-600"></div>

        <div class="p-8">
            <form x-data="ebisForm()" x-init="formEl = $el" method="POST" action="{{ route('ebis.manual.store') }}" class="space-y-8">
                @csrf

                <!-- ================= SECTION 1: IDENTITAS ORDER ================= -->
                <div>
                    <h3 class="flex items-center gap-2 text-lg font-bold text-slate-800 mb-6">
                        <span class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-sm">1</span>
                        Identitas Order
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NDE JT -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                Nomor NDE JT
                            </label>
                            <input name="nde_jt" type="text"
                                class="w-full rounded-xl border-slate-400 bg-slate-100 px-4 py-3 text-sm focus:bg-white
                                       focus:border-red-500 focus:ring-2 focus:ring-red-100 outline-none transition"
                                placeholder="Contoh: NDE-123/456">
                        </div>

                        <!-- STARCLICK -->
                        <div data-field-wrapper>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                Starclick ID / NCX <span class="text-red-500">*</span>
                            </label>
                            <input name="star_click_id" type="text" data-required="true"
                                class="w-full rounded-xl border-slate-400 bg-slate-100 px-4 py-3 text-sm focus:bg-white font-medium
                                       focus:border-red-500 focus:ring-2 focus:ring-red-100 outline-none transition"
                                placeholder="Masukkan ID">
                            <p x-show="showError && errorField === 'star_click_id'" x-transition class="text-xs text-red-500 mt-1 font-medium">Wajib diisi</p>
                            @error('star_click_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="w-full h-px bg-slate-100"></div>

                <!-- ================= SECTION 2: DATA PELANGGAN ================= -->
                <div>
                     <h3 class="flex items-center gap-2 text-lg font-bold text-slate-800 mb-6">
                        <span class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-sm">2</span>
                        Data Pelanggan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- NAMA -->
                        <div data-field-wrapper>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                Nama Pelanggan <span class="text-red-500">*</span>
                            </label>
                            <input name="nama_customer" type="text" data-required="true"
                                class="w-full rounded-xl border-slate-400 bg-slate-100 px-4 py-3 text-sm focus:bg-white
                                       focus:border-red-500 focus:ring-2 focus:ring-red-100 outline-none transition"
                                placeholder="Nama Lengkap">
                            <p x-show="showError && errorField === 'nama_customer'" x-transition class="text-xs text-red-500 mt-1 font-medium">Wajib diisi</p>
                            @error('nama_customer') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                         <!-- TELEPON -->
                         <div data-field-wrapper>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                Telepon <span class="text-red-500">*</span>
                            </label>
                            <input name="telepon_pelanggan" type="text" data-required="true"
                                class="w-full rounded-xl border-slate-400 bg-slate-100 px-4 py-3 text-sm focus:bg-white
                                       focus:border-red-500 focus:ring-2 focus:ring-red-100 outline-none transition"
                                placeholder="08xxxxxxxxxx">
                            <p x-show="showError && errorField === 'telepon_pelanggan'" x-transition class="text-xs text-red-500 mt-1 font-medium">Wajib diisi</p>
                            @error('telepon_pelanggan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                         <!-- ALAMAT -->
                         <div data-field-wrapper class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input name="alamat_pelanggan" type="text" data-required="true"
                                    class="w-full rounded-xl border-slate-400 bg-slate-100 pl-10 pr-4 py-3 text-sm focus:bg-white
                                           focus:border-red-500 focus:ring-2 focus:ring-red-100 outline-none transition"
                                    placeholder="Jl. Contoh No. 123">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <p x-show="showError && errorField === 'alamat_pelanggan'" x-transition class="text-xs text-red-500 mt-1 font-medium">Wajib diisi</p>
                            @error('alamat_pelanggan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                         <!-- TIKOR -->
                         <div data-field-wrapper>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                Titik Koordinat <span class="text-red-500">*</span>
                            </label>
                            <input name="tikor_pelanggan" type="text" data-required="true"
                                class="w-full rounded-xl border-slate-400 bg-slate-100 px-4 py-3 text-sm focus:bg-white font-mono text-slate-600
                                       focus:border-red-500 focus:ring-2 focus:ring-red-100 outline-none transition"
                                placeholder="-6.xxxxx, 108.xxxxx">
                            <p x-show="showError && errorField === 'tikor_pelanggan'" x-transition class="text-xs text-red-500 mt-1 font-medium">Wajib diisi</p>
                            @error('tikor_pelanggan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="w-full h-px bg-slate-100"></div>

                <!-- ================= SECTION 3: LOKASI & TEKNIS ================= -->
                <div>
                    <h3 class="flex items-center gap-2 text-lg font-bold text-slate-800 mb-6">
                       <span class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-sm">3</span>
                       Lokasi & Teknis
                   </h3>

                   <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- DATEL -->
                        <div data-field-wrapper x-data="searchableSelect(@js($datels))" class="relative">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                Datel <span class="text-red-500">*</span>
                            </label>
                            
                            <div class="relative">
                                <input type="text" x-model="search" @focus="open = true" @click="open = true" 
                                       @input="open = true; clearIfEmpty()" @blur="clearIfEmpty()"
                                       class="w-full rounded-xl border-slate-400 bg-slate-100 px-4 py-3 text-sm focus:bg-white
                                              focus:border-red-500 focus:ring-2 focus:ring-red-100 outline-none transition"
                                       placeholder="Pilih Datel">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400 absolute right-4 top-3.5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            
                            <input type="hidden" name="datel" x-model="selected" data-required="true">
                            
                            <!-- DROPDOWN -->
                            <div x-show="open" @click.outside="open = false" x-transition.opacity
                                 class="absolute z-50 mt-1 w-full bg-white border border-slate-100 rounded-xl shadow-xl max-h-48 overflow-y-auto">
                                <template x-for="item in filtered()" :key="item">
                                    <div @click="select(item)" class="px-4 py-2.5 text-sm cursor-pointer hover:bg-red-50 text-slate-700 hover:text-red-700 transition">
                                        <span x-text="item"></span>
                                    </div>
                                </template>
                                <div x-show="filtered().length === 0" class="px-4 py-3 text-sm text-slate-400 italic text-center">Tidak ditemukan</div>
                            </div>
                            
                            <p x-show="showError && errorField === 'datel'" x-transition class="text-xs text-red-500 mt-1 font-medium">Wajib dipilih</p>
                        </div>

                        <!-- STO -->
                        <div data-field-wrapper x-data="searchableSelect(@js($stos))" class="relative">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                STO <span class="text-red-500">*</span>
                            </label>
                            
                            <div class="relative">
                                <input type="text" x-model="search" @focus="open = true" @click="open = true" 
                                       @input="open = true; clearIfEmpty()" @blur="clearIfEmpty()"
                                       class="w-full rounded-xl border-slate-400 bg-slate-100 px-4 py-3 text-sm focus:bg-white
                                              focus:border-red-500 focus:ring-2 focus:ring-red-100 outline-none transition"
                                       placeholder="Pilih STO">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400 absolute right-4 top-3.5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            <input type="hidden" name="sto" x-model="selected" data-required="true">

                            <div x-show="open" @click.outside="open = false" x-transition.opacity
                                 class="absolute z-50 mt-1 w-full bg-white border border-slate-100 rounded-xl shadow-xl max-h-48 overflow-y-auto">
                                <template x-for="item in filtered()" :key="item">
                                    <div @click="select(item)" class="px-4 py-2.5 text-sm cursor-pointer hover:bg-red-50 text-slate-700 hover:text-red-700 transition">
                                        <span x-text="item"></span>
                                    </div>
                                </template>
                                <div x-show="filtered().length === 0" class="px-4 py-3 text-sm text-slate-400 italic text-center">Tidak ditemukan</div>
                            </div>

                            <p x-show="showError && errorField === 'sto'" x-transition class="text-xs text-red-500 mt-1 font-medium">Wajib dipilih</p>
                        </div>
                   </div>

                   <!-- MITRA -->
                   <div class="mt-6">
                        <div data-field-wrapper x-data="searchableSelect(@js($mitras))" class="relative">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                Mitra Pelaksana <span class="text-red-500">*</span>
                            </label>

                            <div class="relative">
                                <input type="text" x-model="search" @focus="open = true" @click="open = true" 
                                    @input="open = true; clearIfEmpty()" @blur="clearIfEmpty()"
                                    class="w-full rounded-xl border-slate-400 bg-slate-100 px-4 py-3 text-sm focus:bg-white
                                            focus:border-red-500 focus:ring-2 focus:ring-red-100 outline-none transition"
                                    placeholder="Pilih Mitra">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400 absolute right-4 top-3.5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            <input type="hidden" name="nama_mitra" x-model="selected" data-required="true">

                            <div x-show="open" @click.outside="open = false" x-transition.opacity
                                class="absolute z-50 mt-1 w-full bg-white border border-slate-100 rounded-xl shadow-xl max-h-48 overflow-y-auto">
                                <template x-for="item in filtered()" :key="item">
                                    <div @click="select(item)" class="px-4 py-2.5 text-sm cursor-pointer hover:bg-red-50 text-slate-700 hover:text-red-700 transition">
                                        <span x-text="item"></span>
                                    </div>
                                </template>
                                <div x-show="filtered().length === 0" class="px-4 py-3 text-sm text-slate-400 italic text-center">Tidak ditemukan</div>
                            </div>

                            <p x-show="showError && errorField === 'nama_mitra'" x-transition class="text-xs text-red-500 mt-1 font-medium">Wajib dipilih</p>
                            @error('nama_mitra') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                   </div>
                </div>

                <!-- ================= BUTTONS ================= -->
                <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="history.back()" 
                        class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="button" @click="initiateSubmit()"
                        class="px-8 py-3 rounded-xl bg-gradient-to-r from-red-600 to-red-500 text-white font-semibold text-sm hover:shadow-lg hover:-translate-y-0.5 transition duration-300">
                        Simpan Data
                    </button>
                </div>

                <!-- CONFIRM MODAL -->
                <template x-teleport="body">
                    <div x-show="confirmOpen" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center">
                        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="confirmOpen = false"></div>
                        <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-sm relative z-10 text-center animate-fade-in-up">
                            <div class="w-16 h-16 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M12 5a7 7 0 100 14 7 7 0 000-14z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2">Simpan Data?</h3>
                            <p class="text-slate-500 mb-6 text-sm">Pastikan semua data yang diinput sudah benar. Data akan tersimpan di sistem.</p>
                            <div class="flex gap-3 justify-center">
                                <button type="button" @click="confirmOpen = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50 transition">Batal</button>
                                <button type="button" @click="finalSubmit()" class="px-5 py-2.5 rounded-xl bg-red-600 text-white text-sm font-semibold hover:bg-red-700 transition">Ya, Simpan</button>
                            </div>
                        </div>
                    </div>
                </template>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script>
    function ebisForm() {
        return {
            formEl: null,
            confirmOpen: false,
            valid: true,
            showError: false,
            errorField: null,
            invalidField: null,

            checkRequired() {
                const requiredFields = [...this.formEl.querySelectorAll('[data-required=true]')];
                this.valid = true;
                this.invalidField = null;
                this.errorField = null;

                // Reset styles
                this.formEl.querySelectorAll('[data-field-wrapper]').forEach(wrapper => {
                    const input = wrapper.querySelector('input');
                    if(input) input.classList.remove('border-red-500', 'ring-2', 'ring-red-100');
                });

                for (let field of requiredFields) {
                    if (!field.value || field.value.trim() === '') {
                        this.valid = false;
                        this.invalidField = field;
                        this.errorField = field.getAttribute('name');
                        
                        // Style the visible input
                        const wrapper = field.closest('[data-field-wrapper]');
                        const target = field.type === 'hidden' ? wrapper?.querySelector('input[type="text"]') : field;
                        
                        target?.classList.add('border-red-500', 'ring-2', 'ring-red-100');
                        break;
                    }
                }
            },

            scrollToInvalid() {
                if (!this.invalidField) return;
                let target = this.invalidField;
                if (this.invalidField.type === 'hidden') {
                    target = this.invalidField.closest('[data-field-wrapper]')?.querySelector('input[type="text"]');
                }
                
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    setTimeout(() => target.focus(), 500);
                }
            },

            initiateSubmit() {
                this.showError = true;
                this.checkRequired();

                if (!this.valid) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Belum Lengkap',
                        text: 'Mohon lengkapi semua field bertanda bintang (*)',
                        confirmButtonColor: '#dc2626',
                        confirmButtonText: 'OK'
                    }).then(() => this.scrollToInvalid());
                    return;
                }
                this.confirmOpen = true;
            },

            finalSubmit() {
                this.formEl.submit();
            }
        }
    }

    function searchableSelect(items) {
        return {
            open: false,
            search: '',
            selected: '',

            filtered() {
                return items.filter(item => item.toLowerCase().includes(this.search.toLowerCase()));
            },

            select(item) {
                this.selected = item;
                this.search = item;
                this.open = false;
            },

            clearIfEmpty() {
                if (this.search.trim() === '') this.selected = '';
            }
        }
    }
</script>
@endsection