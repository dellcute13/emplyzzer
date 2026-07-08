@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        
        <!-- Header & Period Selector -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900">Hasil Perankingan Pegawai</h2>
                <p class="text-slate-500 mt-1">Berdasarkan perhitungan metode Simple Additive Weighting (SAW).</p>
            </div>
            
            <div class="flex items-center gap-3">
                <form method="GET" action="{{ route('employee-rank') }}" class="flex items-center gap-3">
                    <select name="period_id" onchange="this.form.submit()" class="bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm focus:ring-2 focus:ring-primary-container outline-none min-w-[200px]">
                        @foreach ($periods as $period)
                            <option value="{{ $period->id }}" {{ $period->id == $selectedPeriodId ? 'selected' : '' }}>
                                {{ $period->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        @if (empty($preferences))
            <!-- Empty State -->
            <div class="bg-white border border-slate-200 rounded-2xl p-12 text-center shadow-sm max-w-2xl mx-auto space-y-6">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400">
                    <span class="material-symbols-outlined text-4xl">leaderboard</span>
                </div>
                <div class="space-y-2">
                    <h3 class="text-xl font-bold text-slate-900">Belum Ada Hasil Perankingan</h3>
                    <p class="text-slate-500 text-sm max-w-md mx-auto">
                        Hasil perankingan belum terbentuk karena belum ada data penilaian yang masuk untuk periode ini. Silakan kunjungi menu Proses SAW untuk melakukan simulasi nilai.
                    </p>
                </div>
                <div>
                    <a href="{{ route('sawprocess-data', ['period_id' => $selectedPeriodId]) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-600/20">
                        <span class="material-symbols-outlined text-sm">calculate</span>
                        Buka Menu Proses SAW
                    </a>
                </div>
            </div>
        @else
            <!-- Podium Top 3 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 items-end">
                
                <!-- Rank 2 (Silver) -->
                @if (isset($preferences[1]))
                    @php $p2 = $preferences[1]; @endphp
                    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow flex flex-col items-center relative overflow-hidden group order-2 md:order-1 h-[280px] justify-center">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <span class="material-symbols-outlined text-6xl">military_tech</span>
                        </div>
                        <div class="w-16 h-16 rounded-full border-4 border-slate-200 mb-3 overflow-hidden bg-slate-100 flex items-center justify-center text-slate-400">
                            <span class="material-symbols-outlined text-3xl">person</span>
                        </div>
                        <div class="bg-slate-100 text-slate-700 text-[10px] font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">
                            RANK 2 - SILVER
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 text-center truncate max-w-full">{{ $p2['employee']->name }}</h3>
                        <p class="text-slate-500 text-xs mt-0.5 truncate max-w-full">{{ $p2['employee']->position->name ?? '-' }}</p>
                        <div class="mt-4 text-slate-800 font-extrabold text-2xl font-mono">{{ number_format($p2['total'], 4) }}</div>
                    </div>
                @endif

                <!-- Rank 1 (Gold) -->
                @if (isset($preferences[0]))
                    @php $p1 = $preferences[0]; @endphp
                    <div class="bg-white rounded-2xl p-8 border-2 border-yellow-400 shadow-xl flex flex-col items-center relative overflow-hidden group order-1 md:order-2 h-[320px] justify-center transform md:-translate-y-4">
                        <div class="absolute top-0 left-0 bg-yellow-400 text-yellow-950 text-[10px] font-extrabold px-4 py-1.5 rounded-br-lg tracking-widest">
                            BEST PERFORMER
                        </div>
                        <div class="absolute top-4 right-4 text-yellow-500">
                            <span class="material-symbols-outlined text-4xl">workspace_premium</span>
                        </div>
                        <div class="w-20 h-20 rounded-full border-4 border-yellow-400 mb-3 overflow-hidden bg-slate-100 flex items-center justify-center text-slate-400">
                            <span class="material-symbols-outlined text-4xl">person</span>
                        </div>
                        <div class="bg-yellow-100 text-yellow-800 text-[10px] font-bold px-3 py-1 rounded-full mb-3 tracking-widest uppercase">
                            RANK 1 - GOLD
                        </div>
                        <h3 class="font-extrabold text-xl text-slate-900 text-center truncate max-w-full">{{ $p1['employee']->name }}</h3>
                        <p class="text-slate-500 text-sm mt-0.5 truncate max-w-full">{{ $p1['employee']->position->name ?? '-' }}</p>
                        <div class="mt-4 text-yellow-600 font-black text-3xl font-mono">{{ number_format($p1['total'], 4) }}</div>
                    </div>
                @endif

                <!-- Rank 3 (Bronze) -->
                @if (isset($preferences[2]))
                    @php $p3 = $preferences[2]; @endphp
                    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow flex flex-col items-center relative overflow-hidden group order-3 h-[260px] justify-center">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <span class="material-symbols-outlined text-6xl">award_star</span>
                        </div>
                        <div class="w-16 h-16 rounded-full border-4 border-amber-200 mb-3 overflow-hidden bg-slate-100 flex items-center justify-center text-slate-400">
                            <span class="material-symbols-outlined text-3xl">person</span>
                        </div>
                        <div class="bg-amber-50 text-amber-800 text-[10px] font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">
                            RANK 3 - BRONZE
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 text-center truncate max-w-full">{{ $p3['employee']->name }}</h3>
                        <p class="text-slate-500 text-xs mt-0.5 truncate max-w-full">{{ $p3['employee']->position->name ?? '-' }}</p>
                        <div class="mt-4 text-slate-800 font-extrabold text-2xl font-mono">{{ number_format($p3['total'], 4) }}</div>
                    </div>
                @endif

            </div>

            <!-- Complete Ranking List -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-900">Daftar Peringkat Keseluruhan</h3>
                    <p class="text-sm text-slate-500 mt-1">Daftar semua pegawai yang dievaluasi beserta nilai akhir metode SAW.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-700 text-xs font-bold uppercase tracking-wider border-b border-slate-100">
                                <th class="px-8 py-4 w-20 text-center">Rank</th>
                                <th class="px-6 py-4">Nama Pegawai</th>
                                <th class="px-6 py-4">Jabatan</th>
                                <th class="px-6 py-4">Departemen</th>
                                <th class="px-6 py-4 text-center">Skor Akhir (V)</th>
                                <th class="px-6 py-4">Kategori Kinerja</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-600">
                            @foreach ($preferences as $index => $pref)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-4 text-center font-extrabold text-slate-950 text-sm">
                                        @if ($index == 0)
                                            <span class="w-6 h-6 rounded-full bg-yellow-400 text-yellow-955 flex items-center justify-center mx-auto text-xs">1</span>
                                        @elseif ($index == 1)
                                            <span class="w-6 h-6 rounded-full bg-slate-300 text-slate-800 flex items-center justify-center mx-auto text-xs">2</span>
                                        @elseif ($index == 2)
                                            <span class="w-6 h-6 rounded-full bg-amber-600 text-amber-50 flex items-center justify-center mx-auto text-xs">3</span>
                                        @else
                                            {{ $index + 1 }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-slate-900">{{ $pref['employee']->name }}</div>
                                        <div class="text-[10px] text-slate-400">NIP: {{ $pref['employee']->nip }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $pref['employee']->position->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $pref['employee']->department->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-center font-mono font-bold text-slate-900 text-base">
                                        {{ number_format($pref['total'], 4) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($pref['total'] >= 0.85)
                                            <span class="px-2.5 py-1 bg-green-50 text-green-700 rounded-full text-xs font-bold uppercase tracking-wider">Sangat Baik</span>
                                        @elseif ($pref['total'] >= 0.70)
                                            <span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold uppercase tracking-wider">Baik</span>
                                        @elseif ($pref['total'] >= 0.55)
                                            <span class="px-2.5 py-1 bg-yellow-50 text-yellow-700 rounded-full text-xs font-bold uppercase tracking-wider">Cukup</span>
                                        @else
                                            <span class="px-2.5 py-1 bg-red-50 text-red-700 rounded-full text-xs font-bold uppercase tracking-wider">Kurang</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </section>
@endsection
