<!DOCTYPE html>
<html class="light" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Pengukuran &amp; Grafik Pertumbuhan - Sistem Pemantauan Janin</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "primary-dark": "#0e62b8",
                        "success": "#16a34a",
                        "success-hover": "#15803d",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1a2632",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                        "card-light": "#ffffff",
                        "card-dark": "#1e293b",
                        "border-light": "#e7edf3",
                        "border-dark": "#334155",
                        "text-main": "#0d141b",
                        "text-main-light": "#0d141b",
                        "text-main-dark": "#f8fafc",
                        "text-sub": "#4c739a",
                        "text-secondary-light": "#4c739a",
                        "text-secondary-dark": "#94a3b8",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent; 
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; 
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display antialiased transition-colors duration-200">
<div class="flex min-h-screen w-full flex-col overflow-x-hidden">
<nav class="fixed top-0 left-0 right-0 z-50 w-full border-b border-[#e7edf3] dark:border-slate-800 bg-surface-light dark:bg-surface-dark">
<div class="px-4 md:px-10 lg:px-40 flex justify-center py-3">
<div class="flex w-full max-w-[960px] items-center justify-between">
<div class="flex items-center gap-4 text-text-main dark:text-white">
<div class="flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-3xl">pregnant_woman</span>
</div>
<h2 class="text-text-main dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Gestational Fundus</h2>
</div>
<div class="hidden md:flex flex-1 justify-end gap-8 items-center">
<div class="flex items-center gap-6 lg:gap-9">
<a class="text-text-main dark:text-gray-300 hover:text-primary text-sm font-medium leading-normal transition-colors" href="{{ route('beranda') }}">Beranda</a>
<a class="text-text-main dark:text-gray-300 hover:text-primary text-sm font-medium leading-normal transition-colors" href="{{ route('panduan') }}">Panduan</a>
<a class="text-text-main dark:text-gray-300 hover:text-primary text-sm font-medium leading-normal transition-colors" href="{{ route('pengukuran') }}">Pengukuran</a>
<a class="text-text-main dark:text-gray-300 hover:text-primary text-sm font-medium leading-normal transition-colors" href="{{ route('bantuan') }}">Bantuan</a>
</div>
<div class="flex items-center gap-4">
<div class="relative" data-profile-menu>
<button class="group flex items-center justify-center rounded-full w-10 h-10 bg-blue-50 hover:bg-blue-100 dark:bg-slate-800 dark:hover:bg-slate-700 transition-colors" title="Profil Pengguna" type="button" data-profile-toggle>
<span class="material-symbols-outlined text-primary group-hover:text-primary-dark text-2xl">account_circle</span>
</button>
<div class="absolute right-0 mt-2 w-52 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-surface-dark shadow-lg hidden" data-profile-dropdown>
<div class="px-4 py-3 flex items-center gap-2 text-sm font-semibold text-text-main dark:text-white">
<span class="material-symbols-outlined text-primary">account_circle</span>
<span>{{ session('auth_user', 'Akun') }}</span>
</div>
<div class="border-t border-slate-200 dark:border-slate-700"></div>
<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="w-full text-left px-4 py-3 text-sm text-text-main dark:text-white hover:bg-slate-50 dark:hover:bg-slate-800 flex items-center gap-2" type="submit">
<span class="material-symbols-outlined text-base text-primary">logout</span>
<span>Logout</span>
</button>
</form>
</div>
</div>
</div>
</div>
<button class="md:hidden text-text-main dark:text-white" type="button" data-mobile-toggle>
<span class="material-symbols-outlined">menu</span>
</button>
</div>
</div>
</nav>
<div class="md:hidden hidden fixed inset-x-0 top-[56px] z-40 bg-surface-light dark:bg-surface-dark border-b border-[#e7edf3] dark:border-slate-800 shadow-sm" data-mobile-menu>
<div class="px-4 py-4 space-y-3">
<a class="block text-text-main dark:text-white text-sm font-medium" href="{{ route('beranda') }}">Beranda</a>
<a class="block text-text-main dark:text-white text-sm font-medium" href="{{ route('panduan') }}">Panduan</a>
<a class="block text-text-main dark:text-white text-sm font-medium" href="{{ route('pengukuran') }}">Pengukuran</a>
<a class="block text-text-main dark:text-white text-sm font-medium" href="{{ route('bantuan') }}">Bantuan</a>
@if(session()->has('auth_user'))
<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="mt-2 w-full text-left text-sm font-semibold text-primary">Logout</button>
</form>
@endif
</div>
</div>
<script>
    document.addEventListener('click', () => {
        document.querySelectorAll('[data-profile-dropdown]').forEach(dd => dd.classList.add('hidden'));
    });
    document.querySelectorAll('[data-profile-menu]').forEach(menu => {
        const toggle = menu.querySelector('[data-profile-toggle]');
        const dropdown = menu.querySelector('[data-profile-dropdown]');
        toggle?.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown?.classList.toggle('hidden');
        });
        dropdown?.addEventListener('click', (e) => e.stopPropagation());
    });
    document.querySelectorAll('[data-mobile-toggle]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const menu = btn.closest('nav')?.nextElementSibling;
            menu?.classList.toggle('hidden');
        });
    });
    document.addEventListener('DOMContentLoaded', () => {
        const deleteForm = document.getElementById('delete-mother-form');
        const actionTemplate = deleteForm?.dataset.actionTemplate || '';
        const currentMotherId = deleteForm?.dataset.currentId || '';

        document.querySelectorAll('[data-delete-patient]').forEach(button => {
            button.addEventListener('click', () => {
                const selectedId = document.querySelector('select[name="mother_id"]')?.value || '';
                const motherId = (selectedId || currentMotherId).trim();

                if (!motherId) {
                    alert('Pilih pasien terlebih dahulu sebelum menghapus.');
                    return;
                }

                if (!deleteForm || !actionTemplate) {
                    alert('Form hapus tidak tersedia.');
                    return;
                }

                if (!confirm('Yakin ingin menghapus data pasien ini?')) {
                    return;
                }

                deleteForm.action = actionTemplate.replace('__ID__', motherId);
                deleteForm.submit();
            });
        });
    });
</script>
<main class="flex-1 px-4 lg:px-8 py-6 w-full max-w-[1440px] mx-auto mt-12">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
<div class="col-span-12 lg:col-span-4 flex flex-col gap-6">
<div class="bg-card-light dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark shadow-sm overflow-hidden p-5">
<div class="flex justify-between items-center mb-4">
<div>
<p class="text-xs text-text-secondary-light dark:text-text-secondary-dark font-medium">Cari Pasien</p>
<h3 class="text-text-main-light dark:text-text-main-dark text-lg font-bold">Database Ibu Hamil</h3>
</div>
<span class="bg-primary text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $motherList->count() }} terdaftar</span>
</div>
<form class="flex flex-col gap-4" method="GET" action="{{ route('pengukuran') }}">
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Nama pasien</label>
<input class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_name" list="mother-options" placeholder="Ketik nama..." value="{{ request('mother_name', $mother->mother_name ?? '') }}"/>
<datalist id="mother-options">
                            @foreach($motherList as $item)
                                <option value="{{ $item->mother_name }}"></option>
                            @endforeach
                        </datalist>
</div>
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Atau pilih ID</label>
<select class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_id">
<option value="">-- pilih --</option>
                                @foreach($motherList as $item)
                                    <option value="{{ $item->mother_id }}" @selected(request('mother_id') == $item->mother_id || ($mother?->mother_id === $item->mother_id))>
                                        {{ $item->mother_name }}
                                    </option>
                                @endforeach
</select>
<div class="grid grid-cols-2 gap-3 mt-1">
<button class="bg-primary hover:bg-primary-dark text-white font-medium text-sm h-10 rounded-lg transition-colors flex items-center justify-center" type="submit">
                                        Muat data
                                    </button>
<button class="bg-primary hover:bg-primary-dark text-white font-medium text-sm h-10 rounded-lg transition-colors flex items-center justify-center" type="button" data-delete-patient>
                                        Hapus Data
                                    </button>
</div>
</div>
</form>
<form class="hidden" id="delete-mother-form" method="POST" data-action-template="{{ route('patients.destroy', ['mother' => '__ID__']) }}" data-current-id="{{ $mother?->mother_id }}">
@csrf
@method('DELETE')
</form>
</div>
<div class="bg-card-light dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark shadow-sm overflow-hidden p-5">
<h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold mb-4">Tambah Pasien Baru</h3>
<form class="flex flex-col gap-4" method="POST" action="{{ route('patients.store') }}">
@csrf
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Nama</label>
<input class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_name" required type="text"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Alamat</label>
<textarea class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-20 p-3 text-sm resize-none" name="mother_address" rows="2"></textarea>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">EDD</label>
<input class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_edd" type="date"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Kelamin Janin</label>
<select class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="kelamin">
<option value="-1">Belum diketahui</option>
<option value="1">Laki-laki</option>
<option value="0">Perempuan</option>
</select>
</div>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Etnis</label>
<select class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_etnis">
<option value="0">Indian</option>
<option value="1">Pakistani</option>
<option value="2">Bangladeshi</option>
<option value="3">African Caribbean</option>
<option value="4">African (sub Sahara)</option>
<option value="5">Middle East</option>
<option value="6">Far East Asian</option>
<option value="7" selected>South East Asia</option>
<option value="8">Other</option>
</select>
</div>
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Parity</label>
<select class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_parity">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3+</option>
</select>
</div>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Tinggi (cm)</label>
<input class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_height" required step="0.01" type="number"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Berat (kg)</label>
<input class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_weight" required step="0.01" type="number"/>
</div>
</div>
<button class="bg-primary hover:bg-primary-dark text-white font-medium h-10 rounded-lg transition-colors flex items-center justify-center mt-2 w-full" type="submit">
                                Simpan Pasien
                            </button>
</form>
</div>

                    @if($mother)
                        <div class="bg-card-light dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark shadow-sm overflow-hidden p-5">
<div class="flex items-center justify-between mb-4">
<h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold">Perbarui Data Pasien</h3>
<span class="text-xs font-semibold text-text-secondary-light dark:text-text-secondary-dark">ID: {{ $mother->mother_id }}</span>
</div>
<form class="flex flex-col gap-4" method="POST" action="{{ route('patients.update', $mother) }}">
@csrf
@method('PUT')
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Nama</label>
<input class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_name" required type="text" value="{{ old('mother_name', $mother->mother_name) }}"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Alamat</label>
<textarea class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-20 p-3 text-sm resize-none" name="mother_address" rows="2">{{ old('mother_address', $mother->mother_address) }}</textarea>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">EDD</label>
<input class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_edd" type="date" value="{{ old('mother_edd', optional($embrio?->embrio_edd)->format('Y-m-d')) }}"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Kelamin Janin</label>
<select class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="kelamin">
<option value="-1" @selected(optional($embrio)->embrio_sex === -1)>Belum diketahui</option>
<option value="1" @selected(optional($embrio)->embrio_sex === 1)>Laki-laki</option>
<option value="0" @selected(optional($embrio)->embrio_sex === 0)>Perempuan</option>
</select>
</div>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Etnis</label>
<select class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_etnis">
<option value="0" @selected($mother->mother_etnis === 0)>Indian</option>
<option value="1" @selected($mother->mother_etnis === 1)>Pakistani</option>
<option value="2" @selected($mother->mother_etnis === 2)>Bangladeshi</option>
<option value="3" @selected($mother->mother_etnis === 3)>African Caribbean</option>
<option value="4" @selected($mother->mother_etnis === 4)>African (sub Sahara)</option>
<option value="5" @selected($mother->mother_etnis === 5)>Middle East</option>
<option value="6" @selected($mother->mother_etnis === 6)>Far East Asian</option>
<option value="7" @selected($mother->mother_etnis === 7)>South East Asia</option>
<option value="8" @selected($mother->mother_etnis === 8)>Other</option>
</select>
</div>
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Parity</label>
<select class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_parity">
<option value="0" @selected($mother->mother_parity === 0)>0</option>
<option value="1" @selected($mother->mother_parity === 1)>1</option>
<option value="2" @selected($mother->mother_parity === 2)>2</option>
<option value="3" @selected($mother->mother_parity >= 3)>3+</option>
</select>
</div>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Tinggi (cm)</label>
<input class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_height" required step="0.01" type="number" value="{{ $mother->mother_height }}"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Berat (kg)</label>
<input class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="mother_weight" required step="0.01" type="number" value="{{ $mother->mother_weight }}"/>
</div>
</div>
<button class="bg-primary hover:bg-primary-dark text-white font-medium h-10 rounded-lg transition-colors flex items-center justify-center mt-2 w-full" type="submit">
                                Update Data
                            </button>
</form>
</div>

                        <div class="bg-card-light dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark shadow-sm overflow-hidden p-5">
<div class="flex items-start justify-between mb-4">
<div>
<h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold">Pengukuran Tinggi Fundus</h3>
<p class="text-xs text-text-secondary-light dark:text-text-secondary-dark">Isi pengukuran terbaru untuk memperbarui grafik.</p>
</div>
</div>
<form class="grid grid-cols-1 md:grid-cols-2 gap-3" method="POST" action="{{ route('measurements.store', $mother) }}">
@csrf
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Tanggal</label>
<input class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="measurement_date" required type="date" value="{{ now()->format('Y-m-d') }}"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="text-text-main-light dark:text-text-main-dark text-sm font-medium">Tinggi Fundus (cm)</label>
<input class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-primary h-10 px-3 text-sm" name="measurement_height" placeholder="0" required step="0.1" type="number"/>
</div>
<div class="md:col-span-2 flex">
<button class="bg-success hover:bg-success-hover text-white font-semibold h-10 px-4 rounded-lg transition-colors w-full md:w-auto" type="submit">
                                    Simpan Pengukuran
                                </button>
</div>
</form>
<div class="mt-4 border-t border-border-light dark:border-border-dark pt-4">
<div class="overflow-hidden rounded-lg border border-border-light dark:border-border-dark">
<table class="min-w-full divide-y divide-border-light dark:divide-border-dark text-sm">
<thead class="bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark">
<tr>
<th class="px-4 py-2 text-left font-semibold" style="width:60px;">#</th>
<th class="px-4 py-2 text-left font-semibold">Tanggal</th>
<th class="px-4 py-2 text-left font-semibold">Tinggi Fundus</th>
</tr>
</thead>
<tbody class="divide-y divide-border-light dark:divide-border-dark">
                                    @forelse($measurements as $index => $item)
                                        <tr class="text-text-main-light dark:text-text-main-dark">
<td class="px-4 py-2 font-semibold">{{ $index + 1 }}</td>
<td class="px-4 py-2">{{ $item->measurement_date?->format('Y-m-d') }}</td>
<td class="px-4 py-2 font-semibold">{{ rtrim(rtrim(number_format($item->measurement_height, 1, '.', ''), '0'), '.') }} cm</td>
</tr>
                                    @empty
                                        <tr>
<td class="px-4 py-3 text-center text-text-secondary-light dark:text-text-secondary-dark" colspan="3">Belum ada data pengukuran</td>
</tr>
                                    @endforelse
</tbody>
</table>
</div>
</div>
</div>
                    @endif
</div>

<div class="col-span-12 lg:col-span-8 flex flex-col gap-6 h-full">
<div class="bg-card-light dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark p-5 shadow-sm">
<p class="text-xs text-text-secondary-light dark:text-text-secondary-dark font-medium mb-1">Status Pasien</p>
<div class="flex items-start justify-between gap-4">
<div>
<h3 class="text-text-main-light dark:text-text-main-dark text-lg font-bold">{{ $mother?->mother_name ?? 'Belum ada pasien dipilih' }}</h3>
                            @if($mother && $tow)
                                <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm">Estimasi TOW: <strong class="text-text-main-light dark:text-text-main-dark">{{ number_format($tow, 0, ',', '.') }} gram</strong></p>
                            @endif
</div>
                        @if($mother)
                            <div class="text-right">
<div class="text-xs text-text-secondary-light dark:text-text-secondary-dark mb-1">EDD</div>
<div class="text-text-main-light dark:text-text-main-dark font-semibold">{{ optional($embrio?->embrio_edd)->format('Y-m-d') ?? 'Belum diisi' }}</div>
</div>
                        @endif
</div>
</div>
<div class="bg-card-light dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark shadow-sm flex-1 flex flex-col min-h-[600px] relative">
<div class="px-6 py-4 border-b border-border-light dark:border-border-dark flex justify-between items-center">
<h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold">Grafik Pertumbuhan Janin</h3>
<span class="text-xs font-bold text-text-main-light dark:text-text-main-dark bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">GA 24 - 42 minggu</span>
</div>
<div class="flex-1 flex flex-col items-center justify-center p-8 bg-white dark:bg-[#1a202c] rounded-b-xl relative">
                        @if($mother && $embrio)
                            <div class="w-full max-w-4xl mx-auto aspect-[4/3]">
<img alt="Grafik pertumbuhan" class="w-full h-full object-contain rounded-lg border border-border-light dark:border-border-dark" loading="lazy" src="{{ route('patients.chart', $mother) }}?t={{ time() }}">
</div>
<p class="text-text-secondary-light dark:text-text-secondary-dark text-xs mt-3 text-center">Grafik menyesuaikan faktor tinggi/berat ibu, etnis, paritas, dan jenis kelamin janin.</p>
                        @else
                            <div class="flex flex-col items-center justify-center text-center max-w-sm">
<div class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 rounded-lg flex items-center justify-center mb-4 text-primary">
<span class="material-symbols-outlined text-4xl">show_chart</span>
</div>
<p class="text-text-secondary-light dark:text-text-secondary-dark text-sm">Cari atau tambahkan pasien untuk menampilkan grafik pertumbuhan.</p>
</div>
                        @endif
</div>
</div>
</div>
</div>
</main>
</div>
</body></html>
