@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">

        <div class="mb-10">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900">Proses Simple Additive Weighting</h2>
            <p class="text-slate-500 mt-2">Rincian perhitungan secara menyeluruh untuk evaluasi kinerja pegawai.</p>
        </div>
        <!-- Step Navigation -->
        <div class="grid grid-cols-4 gap-4 mb-10">
            <div class="flex items-center gap-4 p-4 rounded-xl bg-white border border-slate-200 shadow-sm opacity-60">
                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500">1
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Step 1</p>
                    <p class="text-sm font-bold text-slate-900">Data Awal</p>
                </div>
            </div>
            <div
                class="flex items-center gap-4 p-4 rounded-xl bg-white border-2 border-primary-container shadow-md ring-4 ring-primary-container/5">
                <div
                    class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center font-bold text-white">
                    2
                </div>
                <div>
                    <p class="text-xs font-semibold text-on-primary-container uppercase tracking-wider">Step 2</p>
                    <p class="text-sm font-bold text-slate-900">Normalisasi Matriks</p>
                </div>
            </div>
            <div class="flex items-center gap-4 p-4 rounded-xl bg-white border border-slate-200 shadow-sm opacity-60">
                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500">3
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Step 3</p>
                    <p class="text-sm font-bold text-slate-900">Perhitungan Bobot</p>
                </div>
            </div>
            <div class="flex items-center gap-4 p-4 rounded-xl bg-white border border-slate-200 shadow-sm opacity-60">
                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500">4
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Step 4</p>
                    <p class="text-sm font-bold text-slate-900">Hasil Akhir</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-8">
            <!-- Main Calculation View -->
            <div class="col-span-12 lg:col-span-8">
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Matriks Normalisasi (R)</h3>
                            <p class="text-sm text-slate-500">Perhitungan menggunakan rumus: r<sub>ij</sub> = x<sub>ij</sub> /
                                max(x<sub>ij</sub>)</p>
                        </div>
                        <button
                            class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-semibold hover:bg-slate-50 transition-colors">
                            <span class="material-symbols-outlined text-sm" data-icon="download">download</span>
                            Export CSV
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th class="px-6 py-4 text-xs font-bold text-slate-900 uppercase tracking-wider">
                                        Alternative
                                    </th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-900 uppercase tracking-wider text-center">
                                        C1 (Kualitas Kerja)</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-900 uppercase tracking-wider text-center">
                                        C2 (Kedisiplinan)</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-900 uppercase tracking-wider text-center">
                                        
                                        <div>C3</div>
                                        <div class="mt-1 normal-case">(Lama Lembur)</div>
                                    </th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-900 uppercase tracking-wider text-center">
                                        C4 (Perilaku)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-slate-900">A1 - Ahmad Fauzi</td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-sm font-mono font-bold">1.00</span>
                                    </td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.85</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.90</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.75</td>
                                </tr>
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-slate-900">A2 - Siti Aminah</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.80</td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-sm font-mono font-bold">1.00</span>
                                    </td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.80</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.90</td>
                                </tr>
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-slate-900">A3 - Budi Santoso</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.75</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.90</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.85</td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-sm font-mono font-bold">1.00</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-slate-900">A4 - Diana Putri</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.90</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.70</td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-sm font-mono font-bold">1.00</span>
                                    </td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.80</td>
                                </tr>
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-slate-900">A5 - Eko Prasetyo</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.85</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.80</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.75</td>
                                    <td class="px-6 py-4 text-center font-mono text-slate-600">0.85</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                        <button
                            class="px-6 py-2 rounded-lg border border-slate-300 font-semibold text-slate-700 hover:bg-white transition-all">Back
                            to Step 1</button>
                        <button
                            class="px-6 py-2 rounded-lg bg-primary-container text-white font-semibold hover:opacity-90 transition-all shadow-md">Calculate
                            Weights</button>
                    </div>
                </div>
            </div>
            <!-- Sidebar Summary Cards -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <!-- Status Card -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-widest mb-4">Process Status</h4>
                    <div class="flex items-center gap-3 p-3 bg-green-50 border border-green-100 rounded-lg">
                        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-sm font-semibold text-green-700">Calculation in progress</span>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Last updated:</span>
                            <span class="font-semibold text-slate-900">Today, 14:20</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Method applied:</span>
                            <span class="px-2 py-0.5 bg-slate-100 rounded text-xs font-bold text-slate-700">SAW</span>
                        </div>
                    </div>
                </div>
                <!-- Weights Overview -->
                <div class="bg-primary-container text-white p-6 rounded-xl shadow-lg relative overflow-hidden">
                    <div class="relative z-10">
                        <h4 class="text-sm font-bold text-on-primary-container uppercase tracking-widest mb-4">Current
                            Criteria
                            Weights</h4>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span>C1: Kualitas Kerja</span>
                                    <span class="font-bold">40%</span>
                                </div>
                                <div class="w-full bg-white/10 rounded-full h-1.5">
                                    <div class="bg-white h-1.5 rounded-full" style="width: 40%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span>C2: Kedisiplinan</span>
                                    <span class="font-bold">25%</span>
                                </div>
                                <div class="w-full bg-white/10 rounded-full h-1.5">
                                    <div class="bg-white h-1.5 rounded-full" style="width: 25%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span>C3: Lama lembur</span>
                                    <span class="font-bold">15%</span>
                                </div>
                                <div class="w-full bg-white/10 rounded-full h-1.5">
                                    <div class="bg-white h-1.5 rounded-full" style="width: 20%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span>C4: Perilaku</span>
                                    <span class="font-bold">20%</span>
                                </div>
                                <div class="w-full bg-white/10 rounded-full h-1.5">
                                    <div class="bg-white h-1.5 rounded-full" style="width: 15%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative element -->
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                </div>
                <!-- Info Card -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-secondary" data-icon="info">info</span>
                        <h4 class="text-sm font-bold text-slate-900">Quick Tips</h4>
                    </div>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Normalisasi matriks bertujuan untuk mengubah nilai asli menjadi skala yang dapat dibandingkan (0 to
                        1).
                        <strong>Benefit</strong> criteria uses Max value, while <strong>Cost</strong> criteria uses Min
                        value.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
