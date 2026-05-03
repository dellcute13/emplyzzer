<!-- Side Navigation Shell -->
<aside
    class="fixed left-0 top-0 h-screen w-[260px] bg-white border-r border-slate-200 shadow-sm flex flex-col py-6 z-50">
    <div class="px-6 mb-8 flex items-center gap-3">
        <div class="w-10 h-10 bg-primary-container rounded-lg flex items-center justify-center">
            <span class="material-symbols-outlined text-white" data-icon="analytics">analytics</span>
        </div>
        <div>
            <h1 class="text-xl font-bold text-slate-900 leading-tight">Emplyzer</h1>
            <p class="text-[10px] uppercase tracking-wider text-on-primary-container font-semibold">SAW Method
                System</p>
        </div>
    </div>
    <nav class="flex-1 space-y-1 px-3">
        <!-- Dashboard (Active) -->
        <a class="flex items-center rounded-md gap-3 px-4 py-3 text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors duration-200 {{ set_active('dashboard') }}"
            href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
            <span class="font-sans text-sm tracking-tight">Dashboard</span>
        </a>
        <a class="flex items-center rounded-md gap-3 px-4 py-3 text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors duration-200 {{ set_active(['employee.employee-data', 'employee.employee-add']) }}"
            href="{{ route('employee.employee-data') }}">
            <span class="material-symbols-outlined" data-icon="groups">groups</span>
            <span class="font-sans text-sm tracking-tight">Data Pegawai</span>
        </a>
        <a class="flex items-center rounded-md gap-3 px-4 py-3 text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors duration-200 {{ set_active(['criteria.criteria-data', 'criteria.criteria-add']) }}"
            href="{{ route('criteria.criteria-data') }}">
            <span class="material-symbols-outlined" data-icon="format_list_bulleted">format_list_bulleted</span>
            <span class="font-sans text-sm tracking-tight">Kriteria Penilaian</span>
        </a>
        <a class="flex items-center rounded-md gap-3 px-4 py-3 text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors duration-200 {{ set_active('employee-grade') }}"
            href="{{ route('employee-grade') }}">
            <span class="material-symbols-outlined" data-icon="edit_note">edit_note</span>
            <span class="font-sans text-sm tracking-tight">Nilai Pegawai</span>
        </a>
        <a class="flex items-center rounded-md gap-3 px-4 py-3 text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors duration-200  {{ set_active('sawprocess-data') }}"
            href="{{ route('sawprocess-data') }}">
            <span class="material-symbols-outlined" data-icon="calculate">calculate</span>
            <span class="font-sans text-sm tracking-tight">Proses SAW</span>
        </a>
        <a class="flex items-center rounded-md gap-3 px-4 py-3 text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors duration-200  {{ set_active('employee-rank') }}"
            href="{{ route('employee-rank') }}">
            <span class="material-symbols-outlined" data-icon="leaderboard">leaderboard</span>
            <span class="font-sans text-sm tracking-tight">Hasil Ranking</span>
        </a>
        <a class="flex items-center rounded-md gap-3 px-4 py-3 text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors duration-200 {{ set_active('report-data') }}"
            href="{{ route('report-data') }}">
            <span class="material-symbols-outlined" data-icon="description">description</span>
            <span class="font-sans text-sm tracking-tight">Laporan</span>
        </a>
        <div class="pt-4 mt-4 border-t border-slate-100">
            <a class="flex items-center rounded-md gap-3 px-4 py-3 text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors duration-200 {{ set_active(['users.user-data', 'users.user-add']) }}"
                href="{{ route('users.user-data') }}">
                <span class="material-symbols-outlined" data-icon="person_manage">person</span>
                <span class="font-sans text-sm tracking-tight">Pengguna</span>
            </a>
            <button @click="logoutModal = true" 
                class="flex items-center rounded-md gap-3 px-4 py-3 text-error hover:bg-error-container/10 transition-colors duration-200">

                <span class="material-symbols-outlined" data-icon="logout">logout</span>
                <span class="font-sans text-sm tracking-tight">Logout</span>
            </button>
        </div>
    </nav>
    <div class="px-6 mt-auto">
        <div class="p-4 bg-slate-200/80 rounded-xl flex items-center gap-3">
            <img alt="Admin" class="w-10 h-10 rounded-full"
                data-alt="professional portrait of a male executive in a suit with a neutral expression and clean background"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBhcONJfdm3mKvJfPFw6yKA5S8c5QMldk1Xd77GN2-qGdf71Udry4tDnsriaUpAEin2jRsDTJDp80Nly1Zi7qUtAB9Zbk8Y3ljtdYApleusj2n4ryZgs_AD6qIhJQG4e-bvY1oAxd9XduhTvqDoFlLCkGBS9UdzcecWmCVskQqZamReLvTuTqpooyKOKngamfcGi7N9b8ksv3r1eym3NdCveNA1ERySYqhOjhK4fiN461WEGrzV4irua7xVxFiaAZsEzMIrMQ-AqPk5" />
            <div class="overflow-hidden">
                <p class="text-xs font-bold text-on-primary-fixed truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-on-primary-fixed-variant">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </div>
</aside>
