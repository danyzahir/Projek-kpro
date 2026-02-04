@extends('layouts.app')

@section('title', 'Edit Data Deployment')

@section('content')
<div class="flex flex-col gap-6">

    <!-- ================= BREADCRUMB ================= -->
    <div class="flex items-center gap-3 text-sm text-slate-500">
        <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition">Dashboard</a>
        <span>›</span>
        <a href="{{ route('deployment.update') }}" class="hover:text-red-600 transition">Update Data</a>
        <span>›</span>
        <span class="font-semibold text-slate-800">Edit</span>
    </div>

    <!-- ================= FORM ================= -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

        <form action="{{ route('deployment.update.process', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- ================= DATA PELANGGAN ================= -->
            <h2 class="text-sm font-semibold text-slate-700 mb-4">Data Pelanggan</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-medium text-slate-600">Starclick / NCX</label>
                    <input type="text" value="{{ $data->star_click_id }}" readonly
                        class="w-full mt-2 rounded-xl bg-slate-100 border border-slate-200
                               px-4 py-3 text-base text-slate-700 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600">Nama Pelanggan</label>
                    <input type="text" value="{{ $data->nama_customer }}" readonly
                        class="w-full mt-2 rounded-xl bg-slate-100 border border-slate-200
                               px-4 py-3 text-base text-slate-700 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600">Datel</label>
                    <input type="text" value="{{ $data->datel }}" readonly
                        class="w-full mt-2 rounded-xl bg-slate-100 border border-slate-200
                               px-4 py-3 text-base text-slate-700 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600">STO</label>
                    <input type="text" value="{{ $data->sto }}" readonly
                        class="w-full mt-2 rounded-xl bg-slate-100 border border-slate-200
                               px-4 py-3 text-base text-slate-700 cursor-not-allowed">
                </div>
            </div>

            <!-- ================= DATA DEPLOYMENT ================= -->
            <h2 class="text-sm font-semibold text-slate-700 mb-4">Data Deployment</h2>

            <!-- STATUS ORDER & TIPE DESAIN -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-medium text-slate-600">Status Order</label>
                    <input type="text"
                        value="{{ optional($data->planning)->status_order ?? '-' }}"
                        readonly
                        class="w-full mt-2 rounded-xl bg-slate-100 border border-slate-200
                               px-4 py-3 text-base text-slate-700 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600">Tipe Desain</label>
                    <input type="text"
                        value="{{ optional($data->planning)->tipe_desain ?? '-' }}"
                        readonly
                        class="w-full mt-2 rounded-xl bg-slate-100 border border-slate-200
                               px-4 py-3 text-base text-slate-700 cursor-not-allowed">
                </div>
            </div>

            <!-- PROGRES -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-slate-600">
                    Progres <span class="text-red-600">*</span>
                </label>
                <select name="progres" id="progres"
                    class="w-full mt-2 rounded-xl border border-slate-300
                           px-4 py-3 text-base focus:ring-2 focus:ring-red-500">
                    <option value="">Pilih Progres</option>
                    @php
                    $listProgress = [
                    'ON DESK','SURVEY','PERIJINAN','DRM','APPROVED BY EBIS',
                    'MATDEV','INSTALASI','SELESAI FISIK','GOLIVE',
                    'PS','KENDALA','UJI TERIMA','REKON'
                    ];
                    @endphp
                    @foreach ($listProgress as $progress)
                    <option value="{{ $progress }}"
                        {{ old('progres', $data->progres) == $progress ? 'selected' : '' }}>
                        {{ $progress }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- ================= DYNAMIC FIELD ================= -->
            <div id="dynamic-fields" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8"></div>

            <!-- ================= KETERANGAN ================= -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-slate-600">Keterangan Progress</label>
                <textarea name="keterangan" rows="3"
                    class="w-full mt-2 rounded-xl border border-slate-300
                           px-4 py-3 text-base"
                    placeholder="Keterangan tambahan (opsional)">{{ old('keterangan', $data->keterangan) }}</textarea>
            </div>

            <!-- ================= ACTION ================= -->
            <div class="flex justify-end gap-3 pt-6 border-t">
                <a href="{{ route('deployment.update') }}"
                    class="px-4 py-2 rounded-lg border">Batal</a>
                <button type="submit"
                    class="px-6 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    Update Data
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    const progressConfig = {
        "ON DESK": [{
            name: "boq_on_desk",
            label: "BoQ On Desk",
            type: "number"
        }],
        "SURVEY": [{
            name: "boq_survey",
            label: "BoQ Survey",
            type: "number"
        }],
        "PERIJINAN": [{
            name: "evidence_perijinan",
            label: "Upload Foto Evidence",
            type: "file"
        }],
        "DRM": [{
            name: "boq_drm",
            label: "BoQ DRM",
            type: "number"
        }],
        "APPROVED BY EBIS": [{
            name: "evidence_approved",
            label: "Upload Foto Evidence",
            type: "file"
        }],
        "MATDEV": [{
            name: "evidence_matdev",
            label: "Upload Foto Evidence",
            type: "file"
        }],
        "INSTALASI": [{
            name: "evidence_instalasi",
            label: "Upload Foto Evidence",
            type: "file"
        }],
        "SELESAI FISIK": [{
            name: "evidence_selesai_fisik",
            label: "Upload Foto Evidence",
            type: "file"
        }],
        "GOLIVE": [{
                name: "nama_odp",
                label: "Nama ODP Golive",
                type: "text"
            },
            {
                name: "id_smallworld",
                label: "ID Smallworld",
                type: "text"
            }
        ],
        "PS": [{
                name: "nomor_order_ps",
                label: "Nomor Order PS",
                type: "text"
            },
            {
                name: "tanggal_ps",
                label: "Tanggal PS",
                type: "date"
            }
        ],
        "KENDALA": [{
            name: "jenis_kendala",
            label: "Jenis Kendala",
            type: "select",
            options: [
                "PS di SC lain",
                "Cancel Pelanggan",
                "Pending Pelanggan",
                "Perijinan",
                "Distribusi Habis",
                "Feeder Habis",
                "Akses Tidak Layak",
                "Bisa PT1"
            ]
        }],
        "UJI TERIMA": [{
            name: "status",
            label: "Status",
            type: "select",
            options: ["DITERIMA", "TIDAK DITERIMA"]
        }],
        "REKON": [{
            name: "boq_rekon",
            label: "BoQ Rekon",
            type: "number"
        }]
    };

     const progressSelect = document.getElementById('progres');
    const dynamicFields = document.getElementById('dynamic-fields');

    function renderDynamicFields(progress, existingData = {}) {
    dynamicFields.innerHTML = '';
    if (!progressConfig[progress]) return;

    progressConfig[progress].forEach(field => {
        const value = existingData[field.name] ?? '';

        // ===== SELECT =====
        if (field.type === 'select') {
            dynamicFields.insertAdjacentHTML('beforeend', `
                <div>
                    <label class="block text-sm font-medium mb-1">${field.label}</label>
                    <select name="${field.name}" class="w-full border px-3 py-2 rounded-lg">
                        <option value="">-- Pilih --</option>
                        ${field.options.map(opt =>
                            `<option value="${opt}" ${opt === value ? 'selected' : ''}>${opt}</option>`
                        ).join('')}
                    </select>
                </div>
            `);
        }

        // ===== FILE (UPLOAD + LINK DI SEBELAH) =====
        else if (field.type === 'file') {
            const linkName = `link_${field.name}`;
            const linkValue = existingData[linkName] ?? '';

            dynamicFields.insertAdjacentHTML('beforeend', `
                <div>
                    <label class="block text-sm font-medium mb-1">Upload Foto Evidence</label>
                    <input type="file"
                        name="${field.name}"
                        class="w-full border px-3 py-2 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Link Dokumen</label>
                    <input type="text"
                        name="${linkName}"
                        value="${linkValue}"
                        class="w-full border px-3 py-2 rounded-lg"
                        placeholder="Contoh: https://docs.google.com/...">
                </div>
            `);
        }

        // ===== INPUT BIASA =====
        else {
            dynamicFields.insertAdjacentHTML('beforeend', `
                <div>
                    <label class="block text-sm font-medium mb-1">${field.label}</label>
                    <input type="${field.type}"
                        name="${field.name}"
                        value="${value}"
                        class="w-full border px-3 py-2 rounded-lg">
                </div>
            `);
        }
    });
}

    progressSelect.addEventListener('change', function () {
        renderDynamicFields(this.value);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const currentProgress = "{{ old('progres', $data->progres) }}";
        const existingData = {!! json_encode($data->data ?? []) !!};

        if (currentProgress) {
            renderDynamicFields(currentProgress, existingData);
        }
    });
</script>

@endsection