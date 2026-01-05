<!DOCTYPE html>
<html class="light" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Panduan Perhitungan - Gestational Fundus</title>
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
</script>
<main class="flex-1 w-full pt-20">
<section class="bg-background-light dark:bg-background-dark pt-12 pb-12 lg:pt-20 lg:pb-16 px-6 text-center">
<div class="max-w-4xl mx-auto">
<div class="inline-flex items-center justify-center p-3 bg-blue-100 dark:bg-blue-900/30 text-primary rounded-2xl mb-6">
<span class="material-symbols-outlined text-4xl">menu_book</span>
</div>
<h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-text-main-light dark:text-text-main-dark mb-6 leading-tight">
                        Panduan Penggunaan
                    </h1>
<p class="text-lg text-text-secondary-light dark:text-text-secondary-dark leading-relaxed max-w-2xl mx-auto">
                        Panduan langkah-demi-langkah penggunaan website perhitungan ukuran janin untuk pemantauan yang akurat.
                    </p>
</div>
</section>
<section class="py-16 px-6 lg:px-12 bg-white dark:bg-card-dark border-y border-border-light dark:border-border-dark">
<div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
<div class="order-2 lg:order-1">
<div class="flex items-center gap-3 mb-4">
<span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white font-bold text-sm">1</span>
<h2 class="text-2xl md:text-3xl font-bold text-text-main-light dark:text-text-main-dark">Cari atau Tambah Pasien</h2>
</div>
<p class="text-text-secondary-light dark:text-text-secondary-dark mb-8 text-lg leading-relaxed">
                            Langkah pertama adalah identifikasi pasien. Anda dapat memuat data lama dari database atau membuat rekam medis baru untuk pasien yang baru berkunjung.
                        </p>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="p-5 rounded-xl bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark">
<span class="material-symbols-outlined text-primary text-3xl mb-3">search</span>
<h3 class="font-bold text-text-main-light dark:text-text-main-dark text-lg mb-1">Pasien Lama</h3>
<p class="text-sm text-text-secondary-light dark:text-text-secondary-dark">Ketik nama atau ID pasien di kotak pencarian kiri atas, lalu klik "Muat Data".</p>
</div>
<div class="p-5 rounded-xl bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark">
<span class="material-symbols-outlined text-success text-3xl mb-3">person_add</span>
<h3 class="font-bold text-text-main-light dark:text-text-main-dark text-lg mb-1">Pasien Baru</h3>
<p class="text-sm text-text-secondary-light dark:text-text-secondary-dark">Isi formulir lengkap dan klik "Simpan Pasien" untuk membuat rekam medis.</p>
</div>
</div>
</div>
<div class="order-1 lg:order-2 flex justify-center">
<div class="relative">
<div class="absolute inset-0 bg-blue-100 dark:bg-blue-900/20 rounded-full blur-3xl opacity-60"></div>
<span class="material-symbols-outlined text-primary relative z-10" style="font-size: 180px; font-variation-settings: 'FILL' 1;">person_search</span>
</div>
</div>
</div>
</section>
<section class="py-16 px-6 lg:px-12 bg-blue-50/50 dark:bg-background-dark">
<div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
<div class="flex justify-center">
<div class="relative">
<div class="absolute inset-0 bg-blue-100 dark:bg-blue-900/20 rounded-full blur-3xl opacity-60"></div>
<span class="material-symbols-outlined text-primary relative z-10" style="font-size: 180px; font-variation-settings: 'FILL' 1;">edit_document</span>
</div>
</div>
<div>
<div class="flex items-center gap-3 mb-4">
<span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white font-bold text-sm">2</span>
<h2 class="text-2xl md:text-3xl font-bold text-text-main-light dark:text-text-main-dark">Mengisi Data Pasien</h2>
</div>
<p class="text-text-secondary-light dark:text-text-secondary-dark mb-8 text-lg leading-relaxed">
                            Detail parameter yang diperlukan untuk kalkulasi akurat. Pastikan semua kolom data terisi dengan benar sebelum menyimpan.
                        </p>
<ul class="space-y-6">
<li class="flex gap-4">
<div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-white dark:bg-card-dark shadow-sm text-primary">
<span class="material-symbols-outlined">calendar_month</span>
</div>
<div>
<h3 class="font-bold text-lg text-text-main-light dark:text-text-main-dark">Informasi Kehamilan</h3>
<p class="text-text-secondary-light dark:text-text-secondary-dark mt-1">Isi Hari Perkiraan Lahir (HPL), Jenis Kelamin Janin, dan Etnis Ibu dengan akurat.</p>
</div>
</li>
<li class="flex gap-4">
<div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-white dark:bg-card-dark shadow-sm text-primary">
<span class="material-symbols-outlined">straighten</span>
</div>
<div>
<h3 class="font-bold text-lg text-text-main-light dark:text-text-main-dark">Fisik &amp; Riwayat</h3>
<p class="text-text-secondary-light dark:text-text-secondary-dark mt-1">Masukkan data Tinggi &amp; Berat Badan Ibu saat ini atau pra-hamil, serta Paritas.</p>
</div>
</li>
<li class="flex gap-4">
<div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-white dark:bg-card-dark shadow-sm text-success">
<span class="material-symbols-outlined">save</span>
</div>
<div>
<h3 class="font-bold text-lg text-text-main-light dark:text-text-main-dark">Simpan Data</h3>
<p class="text-text-secondary-light dark:text-text-secondary-dark mt-1">Pastikan menekan tombol "Simpan Pasien" di bagian bawah form agar data terekam.</p>
</div>
</li>
</ul>
</div>
</div>
</section>
<section class="py-16 px-6 lg:px-12 bg-white dark:bg-card-dark border-t border-border-light dark:border-border-dark">
<div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
<div class="order-2 lg:order-1">
<div class="flex items-center gap-3 mb-4">
<span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white font-bold text-sm">3</span>
<h2 class="text-2xl md:text-3xl font-bold text-text-main-light dark:text-text-main-dark">Lihat Hasil &amp; Grafik</h2>
</div>
<p class="text-text-secondary-light dark:text-text-secondary-dark mb-8 text-lg leading-relaxed">
                            Setelah data pasien dimuat, sistem secara otomatis memproses dan menampilkan visualisasi pertumbuhan janin.
                        </p>
<ul class="space-y-6">
<li class="flex gap-4">
<div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-background-light dark:bg-background-dark shadow-sm border border-border-light dark:border-border-dark text-primary">
<span class="material-symbols-outlined">trending_up</span>
</div>
<div>
<h3 class="font-bold text-lg text-text-main-light dark:text-text-main-dark">Grafik Pertumbuhan Otomatis</h3>
<p class="text-text-secondary-light dark:text-text-secondary-dark mt-1">Kurva terbentuk berdasarkan Usia Kehamilan (GA) 24-42 minggu sesuai standar WHO.</p>
</div>
</li>
<li class="flex gap-4">
<div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-background-light dark:bg-background-dark shadow-sm border border-border-light dark:border-border-dark text-success">
<span class="material-symbols-outlined">verified</span>
</div>
<div>
<h3 class="font-bold text-lg text-text-main-light dark:text-text-main-dark">Verifikasi Status Aktif</h3>
<p class="text-text-secondary-light dark:text-text-secondary-dark mt-1">Pastikan nama pasien muncul di pojok kanan atas layar sebagai tanda sesi aktif.</p>
</div>
</li>
</ul>
</div>
<div class="order-1 lg:order-2 flex justify-center">
<div class="relative">
<div class="absolute inset-0 bg-green-100 dark:bg-green-900/20 rounded-full blur-3xl opacity-60"></div>
<span class="material-symbols-outlined text-success relative z-10" style="font-size: 180px; font-variation-settings: 'FILL' 1;">show_chart</span>
</div>
</div>
</div>
</section>
<section class="py-12 px-6 bg-background-light dark:bg-background-dark border-t border-border-light dark:border-border-dark">
<div class="max-w-3xl mx-auto text-center">
<p class="text-text-secondary-light dark:text-text-secondary-dark mb-4 font-medium">Butuh bantuan lebih lanjut?</p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-4">
<button class="flex items-center gap-2 px-6 py-3 bg-white dark:bg-card-dark border border-border-light dark:border-border-dark rounded-lg text-primary font-bold shadow-sm hover:shadow-md hover:border-primary transition-all">
<span class="material-symbols-outlined text-xl">description</span>
                            Download Manual PDF Lengkap
                        </button>
<a class="flex items-center gap-2 px-6 py-3 bg-white dark:bg-card-dark border border-border-light dark:border-border-dark rounded-lg text-text-secondary-light dark:text-text-secondary-dark font-semibold shadow-sm hover:shadow-md hover:text-text-main-light transition-all" href="{{ route('bantuan') }}">
<span class="material-symbols-outlined text-xl">support_agent</span>
                            Hubungi Tim Teknis
                        </a>
</div>
</div>
</section>
</main>
</div>
</body></html>
