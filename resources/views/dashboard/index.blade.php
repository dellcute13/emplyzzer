@extends('layouts.app')

@section('content')
    <div class="p-4 sm:p-6 md:p-8 space-y-6 md:space-y-8">
        <!-- Header Section -->
        <div class="flex flex-col gap-1">
            <h2 class="font-headline-lg text-headline-lg text-slate-900">Dashboard Overview</h2>
            <p class="text-on-primary-container text-body-md">Sistem Pendukung Keputusan Pemilihan Pegawai Terbaik -
                Metode SAW</p>
        </div>
        <!-- Stat Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
            <!-- Card 1 -->
            <div class="bg-white p-lg rounded-xl border border-slate-200 ambient-shadow flex items-start justify-between">
                <div class="space-y-sm">
                    <p class="text-label-sm text-on-primary-container font-label-sm uppercase tracking-wider">Total
                        Pegawai</p>
                    <h3 class="text-display-xl font-display-xl text-slate-900">{{ $totalEmployees }}</h3>
                    <p class="text-[10px] text-secondary font-medium flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs" data-icon="trending_up">trending_up</span>
                        +{{ $newEmployeesThisMonth }} New this month
                    </p>
                </div>
                <div class="w-12 h-12 bg-primary-fixed rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-slate-900" data-icon="person">person</span>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-lg rounded-xl border border-slate-200 ambient-shadow flex items-start justify-between">
                <div class="space-y-sm">
                    <p class="text-label-sm text-on-primary-container font-label-sm uppercase tracking-wider">Total
                        Kriteria</p>
                    <h3 class="text-display-xl font-display-xl text-slate-900">{{ $totalCriteria }}</h3>
                    <p class="text-[10px] text-on-primary-container font-medium">Standardized Evaluation</p>
                </div>
                <div class="w-12 h-12 bg-tertiary-fixed rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-tertiary-fixed" data-icon="rule">rule</span>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white p-lg rounded-xl border border-slate-200 ambient-shadow flex items-start justify-between">
                <div class="space-y-sm">
                    <p class="text-label-sm text-on-primary-container font-label-sm uppercase tracking-wider">
                        Pegawai Terbaik</p>
                    <h3 class="text-headline-md font-headline-md text-slate-900 mt-2 truncate max-w-[150px]" title="{{ $bestEmployee ? $bestEmployee['name'] : 'Belum Ada' }}">{{ $bestEmployee ? $bestEmployee['name'] : 'N/A' }}</h3>
                    <p class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full inline-block font-bold">
                        Top Score: {{ $bestEmployee ? number_format($bestEmployee['total'], 3) : '0.000' }}</p>
                </div>
                <div class="w-12 h-12 bg-secondary-fixed rounded-full flex items-center justify-center overflow-hidden">
                    @if($bestEmployee && $bestEmployee['photo'] && $bestEmployee['photo'] !== 'assets/images/default-user.png')
                        <img alt="{{ $bestEmployee['name'] }}" class="w-full h-full object-cover"
                            src="{{ asset($bestEmployee['photo']) }}" />
                    @else
                        <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-sm">
                            {{ $bestEmployee ? strtoupper(substr($bestEmployee['name'], 0, 2)) : '-' }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- Card 4 -->
            <div class="bg-white p-lg rounded-xl border border-slate-200 ambient-shadow flex items-start justify-between">
                <div class="space-y-sm">
                    <p class="text-label-sm text-on-primary-container font-label-sm uppercase tracking-wider">
                        Rata-rata Nilai</p>
                    <h3 class="text-display-xl font-display-xl text-slate-900">{{ number_format($averageScore, 1) }}</h3>
                    <p class="text-[10px] text-on-primary-container font-medium">Global performance average</p>
                </div>
                <div class="w-12 h-12 bg-surface-container-highest rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-slate-900" data-icon="avg_time">avg_time</span>
                </div>
            </div>
            <!-- Card 5 --->
            <div class="bg-white p-lg rounded-xl border border-slate-200 ambient-shadow">
                <div class="space-y-sm mb-4">
                    <p class="text-label-sm text-on-primary-container font-label-sm uppercase tracking-wider">
                        Gender Pegawai
                    </p>
                    <h3 class="text-display-xl font-display-xl text-slate-900">{{ $totalEmployees }}</h3>
                    <p class="text-[10px] text-on-primary-container font-medium">
                        Total berdasarkan jenis kelamin
                    </p>
                </div>

                <!-- Bawah -->
                <div class="grid grid-cols-2 gap-2 mt-3">
                    <div class="bg-pink-50 rounded-lg p-3 text-center">
                        <span class="material-symbols-outlined text-pink-500 text-xl">female</span>
                        <p class="text-sm font-semibold text-slate-800">Perempuan</p>
                        <p class="text-lg font-bold text-pink-600">{{ $femaleEmployees }}</p>
                    </div>

                    <div class="bg-blue-50 rounded-lg p-3 text-center">
                        <span class="material-symbols-outlined text-blue-500 text-xl">male</span>
                        <p class="text-sm font-semibold text-slate-800">Laki-laki</p>
                        <p class="text-lg font-bold text-blue-600">{{ $maleEmployees }}</p>
                    </div>
                </div>
            </div>


        </div>
        <!-- Main Section: Charts & Tables -->
        <div class="grid grid-cols-12 gap-gutter">
            <!-- Large Area Chart Container -->
            <div class="col-span-12 lg:col-span-8 bg-white p-lg rounded-xl border border-slate-200 ambient-shadow">
                <div class="flex items-center justify-between mb-lg">
                    <div>
                        <h4 class="text-headline-md font-headline-md text-slate-900">Grafik Ranking Pegawai</h4>
                        <p class="text-sm text-on-primary-container">Top performances trends (Monthly normalized
                            score)</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('report-data') }}"
                            class="px-4 py-2 text-xs font-bold bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors flex items-center justify-center">Laporan</a>
                        <a href="{{ route('sawprocess-data') }}"
                            class="px-4 py-2 text-xs font-bold bg-primary-container text-white rounded-lg active:opacity-80 transition-all flex items-center justify-center">Update
                            Calculations</a>
                    </div>
                </div>
                <div class="h-64 relative mt-8">
                    <!-- Dynamic Chart Visualization -->
                    <div class="absolute inset-0 flex items-end gap-2 px-2">
                        @forelse($chartEmployees as $index => $pref)
                            @php
                                $colors = [
                                    0 => 'bg-primary-container',
                                    1 => 'bg-primary-fixed',
                                    2 => 'bg-secondary-fixed',
                                    3 => 'bg-tertiary-fixed-dim',
                                    4 => 'bg-slate-200',
                                    5 => 'bg-slate-100',
                                    6 => 'bg-slate-50'
                                ];
                                $colorClass = $colors[$index] ?? 'bg-slate-50';
                                $heightPercent = round($pref['total'] * 100);
                            @endphp
                            <div class="w-full {{ $colorClass }} rounded-t-md relative group transition-all duration-500 hover:opacity-90" style="height: {{ max($heightPercent, 10) }}%;">
                                <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 shadow-md">
                                    {{ $pref['name'] }}: {{ number_format($pref['total'], 4) }}
                                </div>
                            </div>
                        @empty
                            <div class="w-full text-center text-slate-400 text-sm py-8">
                                Belum ada data perhitungan pada periode ini.
                            </div>
                        @endforelse
                    </div>
                    <!-- Axis lines -->
                    <div class="absolute inset-0 border-b border-l border-slate-100 pointer-events-none"></div>
                </div>
                <div class="flex justify-between mt-4 text-[9px] font-bold text-on-primary-container px-2 gap-2 text-center">
                    @foreach($chartEmployees as $pref)
                        @php
                            $firstName = explode(' ', $pref['name'])[0];
                        @endphp
                        <span class="w-full truncate" title="{{ $pref['name'] }}">{{ strtoupper($firstName) }}</span>
                    @endforeach
                </div>
            </div>
            <!-- Latest Activities Sidebar -->
            <div class="col-span-12 lg:col-span-4 bg-white p-lg rounded-xl border border-slate-200 ambient-shadow flex flex-col justify-between">
                <div>
                    <h4 class="text-headline-md font-headline-md text-slate-900 mb-lg">Aktivitas Terbaru</h4>
                    <div class="space-y-6">
                        @forelse($recentActivities as $activity)
                            <div class="flex gap-4 items-start">
                                <div class="w-8 h-8 {{ $activity['icon_bg'] }} rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">{{ $activity['icon'] }}</span>
                                </div>
                                <div>
                                    <p class="text-body-md font-semibold text-slate-900 leading-tight">{{ $activity['title'] }}</p>
                                    <p class="text-xs text-on-primary-container mt-0.5 leading-snug">{{ $activity['message'] }}</p>
                                    <span class="text-[10px] text-slate-400 mt-1 block">
                                        {{ $activity['time']->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-400 text-center py-4">Belum ada aktivitas terbaru.</p>
                        @endforelse
                    </div>
                </div>
                <a href="{{ route('report-data') }}"
                    class="w-full mt-lg py-3 text-sm font-bold text-secondary border border-secondary rounded-lg hover:bg-secondary/5 transition-colors text-center block">
                    Lihat Semua Aktivitas
                </a>
            </div>
            <!-- Top 10 Pegawai Table -->
            <div class="col-span-12 bg-white rounded-xl border border-slate-200 ambient-shadow overflow-hidden">
                <div class="p-lg border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h4 class="text-headline-md font-headline-md text-slate-900">Top 10 Pegawai</h4>
                        <p class="text-sm text-on-primary-container">Ranking teratas berdasarkan perhitungan SAW
                            periode berjalan</p>
                    </div>
                    <button class="p-2 hover:bg-slate-50 rounded-lg">
                        <span class="material-symbols-outlined text-slate-400" data-icon="more_vert">more_vert</span>
                    </button>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                    <thead class="bg-slate-50">
                        <tr>
                            <th
                                class="px-lg py-4 text-label-sm font-label-sm text-on-primary-container uppercase tracking-wider">
                                Rank</th>
                            <th
                                class="px-lg py-4 text-label-sm font-label-sm text-on-primary-container uppercase tracking-wider">
                                Pegawai</th>
                            <th
                                class="px-lg py-4 text-label-sm font-label-sm text-on-primary-container uppercase tracking-wider">
                                Divisi/Unit</th>
                            <th
                                class="px-lg py-4 text-label-sm font-label-sm text-on-primary-container uppercase tracking-wider">
                                Nilai Akhir</th>
                            <th
                                class="px-lg py-4 text-label-sm font-label-sm text-on-primary-container uppercase tracking-wider text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($topEmployees as $index => $pref)
                            @php
                                $rank = $index + 1;
                                $rankPad = str_pad($rank, 2, '0', STR_PAD_LEFT);
                                if ($rank === 1) {
                                    $rankBg = 'bg-yellow-100 text-yellow-700';
                                } elseif ($rank === 2) {
                                    $rankBg = 'bg-slate-200 text-slate-700';
                                } elseif ($rank === 3) {
                                    $rankBg = 'bg-orange-100 text-orange-700';
                                } else {
                                    $rankBg = 'bg-slate-100 text-slate-600';
                                }
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-lg py-4">
                                    <span class="w-8 h-8 rounded-full {{ $rankBg }} flex items-center justify-center font-bold text-xs">{{ $rankPad }}</span>
                                </td>
                                <td class="px-lg py-4">
                                    <div class="flex items-center gap-3">
                                        @if($pref['photo'] && $pref['photo'] !== 'assets/images/default-user.png')
                                            <img alt="{{ $pref['name'] }}" class="w-10 h-10 rounded-full object-cover"
                                                src="{{ asset($pref['photo']) }}" />
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 font-bold text-xs flex items-center justify-center border border-slate-200">
                                                {{ strtoupper(substr($pref['name'], 0, 2)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-slate-900 leading-tight">{{ $pref['name'] }}</p>
                                            <p class="text-xs text-on-primary-container">NIP: {{ $pref['nip'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-lg py-4 text-sm font-medium text-slate-600">{{ $pref['department'] }} ({{ $pref['position'] }})</td>
                                <td class="px-lg py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">{{ number_format($pref['total'], 4) }}</span>
                                </td>
                                <td class="px-lg py-4 text-right">
                                    <a href="{{ route('employee.employee-data') }}?search={{ urlencode($pref['name']) }}" class="text-secondary text-xs font-bold hover:underline">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-slate-400">
                                    Belum ada data perhitungan peringkat pegawai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
                <div class="px-lg py-4 bg-slate-50 flex items-center justify-between">
                    <p class="text-xs text-on-primary-container font-medium">Showing 1 to {{ count($topEmployees) }} of {{ count($topEmployees) }} entries</p>
                    <div class="flex gap-2">
                        <button
                            class="px-3 py-1 border border-slate-300 rounded text-xs font-bold text-slate-600 disabled:opacity-50"
                            disabled="">Prev</button>
                        <button
                            class="px-3 py-1 border border-slate-300 rounded text-xs font-bold text-slate-600 disabled:opacity-50"
                            disabled="">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
