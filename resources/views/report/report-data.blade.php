@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1" x-data="{ previewModal: false, reportName: '', reportDate: '', reportType: '', reportBy: '' }">
        <section class="bg-white p-lg rounded-xl custom-shadow border border-slate-100">
            <form action="{{ route('report-generate') }}" method="POST">
                @csrf
                <div class="flex flex-col md:flex-row gap-lg items-end">
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-md w-full">
                        <div class="space-y-sm">
                            <div x-data="{ open: false, selected: 'Ringkasan Kinerja Bulanan' }" class="space-y-2 relative">
                                <label class="font-label-sm text-slate-700 uppercase">Report Type</label>
                                <input type="hidden" name="report_type" :value="selected">
                                <button type="button" @click="open = !open" @click.away="open = false"
                                    class="w-full bg-slate-50 border-slate-200 border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none transition-all flex items-center justify-between hover:border-indigo-600 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600 h-11">
                                    <span class="text-left"
                                        x-text="selected">
                                    </span>
                                    <span class="material-symbols-outlined text-slate-400 transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''">
                                        expand_more
                                    </span>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                                    class="absolute z-50 mt-2 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl">
                                    <button type="button" @click="selected='Ringkasan Kinerja Bulanan'; open=false"
                                        class="w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 transition">
                                        Ringkasan Kinerja Bulanan
                                    </button>
                                    <button type="button" @click="selected='Audit Eksekutif Tahunan'; open=false"
                                        class="w-full px-4 py-3 text-left text-sm text-slate-700 border-t border-slate-100 hover:bg-slate-50 transition">
                                        Audit Eksekutif Tahunan
                                    </button>
                                    <button type="button" @click="selected='Perbandingan SAW Berkala'; open=false"
                                        class="w-full px-4 py-3 text-left text-sm text-slate-700 border-t border-slate-100 hover:bg-slate-50 transition">
                                        Perbandingan SAW Berkala
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-sm">
                            <label class="font-label-sm text-slate-500 uppercase">
                                Periode Tanggal
                            </label>

                            <div class="relative">

                                <input id="date_range" name="date_range" type="text" placeholder="Pilih rentang tanggal"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 pr-11 text-body-md focus:ring-2 focus:ring-indigo-600 h-11 outline-none transition-all">

                                <button type="button" tabindex="-1"
                                    class="absolute right-3 top-2.5 text-outline hover:text-primary transition-colors pointer-events-none">
                                    <span class="material-symbols-outlined">
                                        date_range
                                    </span>
                                </button>

                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="bg-indigo-600 text-white px-xl h-11 rounded-lg font-data-tabular hover:bg-indigo-700 transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">filter_alt</span>
                        Generate Report
                    </button>
                </div>
            </form>
        </section>
        <!-- Summary Cards Bento Grid -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-lg">
            <!-- Total Reports -->
            <div class="bg-white p-lg rounded-xl custom-shadow border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="font-label-sm text-slate-500 uppercase mb-1">Total Laporan Dibuat</p>
                    <h3 class="font-display-xl text-slate-900 font-bold">{{ number_format($totalReports) }}</h3>
                    <p class="text-xs text-success flex items-center gap-1 mt-2">
                        <span class="material-symbols-outlined text-sm">trending_up</span>
                        <span class="text-green-600 font-semibold">+100% dari awal</span>
                    </p>
                </div>
                <div class="w-14 h-14 bg-slate-50 rounded-full flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined text-3xl">summarize</span>
                </div>
            </div>
            <!-- Last Generated -->
            <div class="bg-white p-lg rounded-xl custom-shadow border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="font-label-sm text-slate-500 uppercase mb-1">Laporan Terakhir Dibuat</p>
                    <h3 class="font-bold text-slate-950 text-sm truncate max-w-[200px]" title="{{ $lastReport ? $lastReport->file_name : '-' }}">
                        {{ $lastReport ? $lastReport->file_name : 'Belum ada' }}
                    </h3>
                    <p class="text-xs text-slate-500 mt-2">{{ $lastReport ? $lastReport->created_at->diffForHumans() : '-' }}</p>
                </div>
                <div class="w-14 h-14 bg-slate-50 rounded-full flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined text-3xl">schedule</span>
                </div>
            </div>
            <!-- High Performing Dept -->
            <div class="bg-white p-lg rounded-xl custom-shadow border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="font-label-sm text-slate-500 uppercase mb-1">Divisi/Unit Kinerja Terbaik</p>
                    <h3 class="font-bold text-slate-900 text-sm truncate max-w-[200px]" title="{{ $bestDeptName }}">
                        {{ $bestDeptName }}
                    </h3>
                    <p class="text-xs text-slate-500 mt-2">{{ $bestDeptScore > 0 ? 'Score: ' . number_format($bestDeptScore, 3) . ' (SAW)' : '-' }}</p>
                </div>
                <div class="w-14 h-14 bg-green-50 rounded-full flex items-center justify-center text-green-600">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">stars</span>
                </div>
            </div>
        </section>
        <!-- Visual Analytics & History Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">
            <!-- Bar Chart Comparison (Visual Analytics) -->
            <section class="lg:col-span-4 bg-white p-lg rounded-xl custom-shadow border border-slate-100">
                <div class="flex justify-between items-center mb-xl">
                    <h4 class="font-headline-md text-slate-900">Analisis Visual</h4>
                    <span class="material-symbols-outlined text-slate-400">more_horiz</span>
                </div>
                <p class="text-body-md text-slate-500 mb-lg leading-relaxed">Perbandingan indeks kinerja antar divisi berdasarkan kriteria SAW.</p>
                <div class="space-y-6 mt-4">
                    @forelse ($deptAverages as $deptName => $score)
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-semibold uppercase tracking-wider text-slate-600">
                                <span>{{ $deptName }}</span>
                                <span>{{ round($score * 100) }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                                <div class="bg-indigo-900 h-full rounded-full" style="width: {{ round($score * 100) }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic">Belum ada analisis data</p>
                    @endforelse
                </div>
                <div class="mt-xl pt-lg border-t border-slate-100">
                    <a href="{{ route('employee-rank') }}" class="text-indigo-600 font-semibold text-sm hover:underline flex items-center gap-1">
                        Lihat Analisis Detail <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </section>
            <!-- Report History Table -->
            <section class="lg:col-span-8 bg-white rounded-xl custom-shadow border border-slate-100 overflow-hidden">
                <div class="p-lg flex justify-between items-center border-b border-slate-100">
                    <div>
                        <h4 class="font-headline-md text-slate-900">Riwayat Laporan</h4>
                        <p class="text-xs text-slate-500 mt-1">Log audit seluruh laporan sistem</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2 border border-slate-200 rounded-lg hover:bg-slate-50"><span
                                class="material-symbols-outlined">search</span></button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider">Nama Laporan
                                </th>
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider">Dibuat Oleh
                                </th>
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider text-right">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($reports as $report)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-lg py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-slate-400">
                                                {{ $report->file_type === 'XLSX' ? 'table_chart' : 'picture_as_pdf' }}
                                            </span>
                                            <span class="font-data-tabular text-slate-900 truncate max-w-[200px]" title="{{ $report->file_name }}">
                                                {{ $report->file_name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-4 text-body-md text-slate-600">
                                        {{ $report->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-lg py-4">
                                        <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-semibold">
                                            {{ $report->employee->name ?? 'System' }}
                                        </span>
                                    </td>
                                    <td class="px-lg py-4">
                                        <div class="flex justify-end gap-3">
                                            <button type="button" @click="
                                                reportName = '{{ $report->file_name }}';
                                                reportDate = '{{ $report->created_at->format('M d, Y H:i') }}';
                                                reportType = '{{ $report->file_type }}';
                                                reportBy = '{{ $report->employee->name ?? 'System' }}';
                                                previewModal = true;
                                            " class="text-slate-400 hover:text-indigo-600 transition-colors" title="View">
                                                <span class="material-symbols-outlined text-xl">visibility</span>
                                            </button>
                                            <button type="button" @click="
                                                downloadReportFile('{{ $report->file_name }}', 'LAPORAN SISTEM SAW EMPLYZZER\n============================\nNama Laporan: {{ $report->file_name }}\nTanggal Dibuat: {{ $report->created_at->format('M d, Y H:i') }}\nTipe File: {{ $report->file_type }}\nPegawai Terkait: {{ $report->employee->name ?? 'System' }}\n\nLaporan ini dibuat secara otomatis oleh sistem evaluasi SAW Emplyzzer.');
                                            " class="text-slate-400 hover:text-indigo-600 transition-colors" title="Download">
                                                <span class="material-symbols-outlined text-xl">download</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-lg py-8 text-center text-sm text-slate-400 italic">
                                        Belum ada riwayat laporan yang dibuat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-lg bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs text-slate-500 font-medium">
                        Showing {{ $reports->firstItem() ?? 0 }} to {{ $reports->lastItem() ?? 0 }} of {{ $reports->total() }} reports
                    </span>
                    <div class="flex items-center">
                        {{ $reports->links() }}
                    </div>
                </div>
            </section>
        </div>

        <!-- Preview Modal Dialog -->
        <div x-show="previewModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
            <div x-show="previewModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100 flex flex-col max-h-[85vh]">
                
                <!-- Modal Header -->
                <div class="px-6 py-4 bg-indigo-900 text-white flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-base">Preview Dokumen Laporan</h3>
                        <p class="text-[11px] text-indigo-200 mt-0.5 truncate max-w-lg" x-text="reportName"></p>
                    </div>
                    <button @click="previewModal = false" class="w-8 h-8 rounded-lg hover:bg-white/10 flex items-center justify-center text-white transition">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>

                <!-- Modal Body: Document Preview -->
                <div class="p-8 overflow-y-auto bg-slate-50 flex-1">
                    <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm space-y-6 min-h-[400px] flex flex-col justify-between">
                        <div class="space-y-6">
                            <!-- Doc Header -->
                            <div class="flex justify-between items-start border-b border-slate-200 pb-4">
                                <div>
                                    <h4 class="font-extrabold text-slate-800 text-base">EMPLYZER REPORT SYSTEM</h4>
                                    <p class="text-xs text-slate-500">Sistem Pendukung Keputusan Metode SAW</p>
                                </div>
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-bold rounded" x-text="reportType"></span>
                            </div>

                            <!-- Doc Metadata -->
                            <div class="grid grid-cols-2 gap-4 text-xs bg-slate-50 p-4 rounded-xl">
                                <div>
                                    <p class="text-slate-400">Nama Laporan</p>
                                    <p class="font-bold text-slate-800" x-text="reportName"></p>
                                </div>
                                <div>
                                    <p class="text-slate-400">Tanggal Pembuatan</p>
                                    <p class="font-bold text-slate-800" x-text="reportDate"></p>
                                </div>
                                <div>
                                    <p class="text-slate-400">Karyawan / Detail</p>
                                    <p class="font-bold text-slate-800" x-text="reportBy"></p>
                                </div>
                                <div>
                                    <p class="text-slate-400">Status Validasi</p>
                                    <p class="font-bold text-green-600 flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Verified by System
                                    </p>
                                </div>
                            </div>

                            <!-- Doc Content Mockup -->
                            <div class="space-y-3">
                                <h5 class="text-xs font-bold uppercase tracking-wider text-slate-600">Ringkasan Evaluasi</h5>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    Dokumen ini memuat data rekapitulasi penilaian kinerja karyawan yang dihitung secara matematis menggunakan model Simple Additive Weighting (SAW). Peringkat dibentuk berdasarkan normalisasi matriks kriteria benefit dan cost yang sah.
                                </p>
                                <div class="border border-slate-105 rounded-lg p-3 bg-slate-50/50 text-[11px] text-slate-400 leading-relaxed">
                                    *Catatan: Dokumen ini diterbitkan secara elektronik oleh Emplyzer SAW Method System dan dilindungi secara logistik pada database server.
                                </div>
                            </div>
                        </div>

                        <!-- Signatures Mockup -->
                        <div class="flex justify-end pt-4 border-t border-slate-100 text-xs">
                            <div class="text-center space-y-8">
                                <p class="text-slate-400">Dibuat Oleh,</p>
                                <div class="font-bold text-slate-800 border-t border-slate-300 pt-1" x-text="reportBy"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 bg-slate-100 border-t border-slate-200 flex justify-end gap-3">
                    <button @click="previewModal = false" class="px-5 py-2 rounded-xl text-slate-600 border border-slate-300 hover:bg-white font-semibold transition text-sm">
                        Tutup
                    </button>
                    <button @click="
                        downloadReportFile(reportName, 'LAPORAN SISTEM SAW EMPLYZZER\n============================\nNama Laporan: ' + reportName + '\nTanggal Dibuat: ' + reportDate + '\nTipe File: ' + reportType + '\nPegawai Terkait: ' + reportBy + '\n\nLaporan ini dibuat secara otomatis oleh sistem evaluasi SAW Emplyzzer.');
                        previewModal = false;
                    " class="px-6 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow transition text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">download</span>
                        Download PDF / Excel
                    </button>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#date_range", {
                mode: "range",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d M Y",
                conjunction: " to ",
                locale: "id"
                appendTo: document.body,
            });
        });
    </script> --}}
    <script>
        function downloadReportFile(fileName, content) {
            const blob = new Blob([content], { type: 'text/plain' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.setAttribute('href', url);
            a.setAttribute('download', fileName);
            a.click();
            window.URL.revokeObjectURL(url);
        }

        document.addEventListener('DOMContentLoaded', function() {

            flatpickr("#date_range", {
                mode: "range",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d M Y",
                conjunction: " to ",
                locale: "id",
                appendTo: document.body,
            });

        });
    </script>
@endpush
