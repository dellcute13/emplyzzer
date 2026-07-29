<!-- Detail Employee Modal -->
<div x-show="detailModalOpen" 
     x-cloak 
     class="fixed inset-0 z-[100] overflow-y-auto" 
     aria-labelledby="modal-title" 
     role="dialog" 
     aria-modal="true"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <!-- Modal panel -->
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl"
             x-show="detailModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             @click.outside="detailModalOpen = false">
            
            <!-- Header -->
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900" id="modal-title">Detail Informasi Pegawai</h3>
                    <p class="text-xs text-slate-500">Profil lengkap dan riwayat nilai kinerja kriteria</p>
                </div>
                <button @click="detailModalOpen = false" class="text-slate-400 hover:text-slate-600 rounded-lg p-1 hover:bg-slate-100 transition">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>

            <!-- Content -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-12 gap-6" x-show="selectedEmployee">
                <!-- Left: Profile Info (4 cols) -->
                <div class="md:col-span-5 space-y-4 border-r border-slate-100 pr-0 md:pr-6">
                    <div class="flex flex-col items-center text-center p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                        <img :src="selectedEmployee?.photo" :alt="selectedEmployee?.name" class="w-24 h-24 rounded-full object-cover shadow-md border-2 border-white ring-4 ring-slate-100 mb-3">
                        <h4 class="font-bold text-slate-900 text-lg leading-snug" x-text="selectedEmployee?.name"></h4>
                        <span class="text-xs font-mono bg-slate-200 text-slate-700 px-2.5 py-1 rounded-full mt-1.5" x-text="'NIP: ' + selectedEmployee?.nip"></span>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between py-2 border-b border-slate-50">
                            <span class="text-slate-400">Jabatan</span>
                            <span class="font-semibold text-slate-800" x-text="selectedEmployee?.position"></span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-slate-50">
                            <span class="text-slate-400">Divisi/Unit</span>
                            <span class="font-semibold text-slate-800" x-text="selectedEmployee?.department"></span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-slate-50">
                            <span class="text-slate-400">Jenis Kelamin</span>
                            <span class="font-semibold text-slate-800" x-text="selectedEmployee?.gender"></span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-slate-50">
                            <span class="text-slate-400">Status</span>
                            <span class="font-semibold text-slate-800" x-text="selectedEmployee?.status"></span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-slate-400">Tanggal Bergabung</span>
                            <span class="font-semibold text-slate-800" x-text="selectedEmployee?.join_date"></span>
                        </div>
                    </div>
                </div>

                <!-- Right: Evaluation Scores (7 cols) -->
                <div class="md:col-span-7 space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="font-bold text-slate-900 text-md">Riwayat Nilai Kinerja</h4>
                        <!-- Period Selector -->
                        <div x-show="Object.keys(evaluationsGroupedByPeriod).length > 0">
                            <select x-model="activePeriod" class="text-xs bg-slate-50 border border-slate-200 rounded-lg px-2 py-1.5 font-semibold text-slate-700 focus:outline-none focus:ring-1 focus:ring-primary">
                                <template x-for="period in Object.keys(evaluationsGroupedByPeriod)" :key="period">
                                    <option :value="period" x-text="period"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <!-- Scores Table / Empty State -->
                    <div>
                        <!-- When evaluations exist for selected period -->
                        <div x-show="activePeriod && evaluationsGroupedByPeriod[activePeriod]" class="border border-slate-100 rounded-xl overflow-hidden shadow-sm">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-slate-50 text-xs font-bold text-slate-600 uppercase">
                                    <tr>
                                        <th class="px-4 py-3">Kode</th>
                                        <th class="px-4 py-3">Kriteria</th>
                                        <th class="px-4 py-3 text-right">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <template x-for="item in evaluationsGroupedByPeriod[activePeriod]" :key="item.criteria_code">
                                        <tr class="hover:bg-slate-50/50 transition">
                                            <td class="px-4 py-3 font-semibold text-slate-800">
                                                <span class="px-2 py-0.5 text-xs bg-slate-100 rounded" x-text="item.criteria_code"></span>
                                            </td>
                                            <td class="px-4 py-3 text-slate-600" x-text="item.criteria_name"></td>
                                            <td class="px-4 py-3 text-right font-bold text-slate-900" x-text="item.score"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div class="bg-slate-50/80 px-4 py-3 border-t border-slate-100 flex justify-between items-center text-xs font-bold text-slate-700">
                                <span>Rata-Rata Nilai</span>
                                <span class="text-sm text-primary font-bold" x-text="averageScoreForActivePeriod()"></span>
                            </div>
                        </div>

                        <!-- Empty state when no evaluations exist -->
                        <div x-show="Object.keys(evaluationsGroupedByPeriod).length === 0" class="flex flex-col items-center justify-center p-12 text-center bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                            <span class="material-symbols-outlined text-slate-300 text-5xl mb-2">assignment_late</span>
                            <h5 class="font-bold text-slate-700 text-sm">Belum Ada Penilaian</h5>
                            <p class="text-xs text-slate-400 mt-1">Pegawai ini belum dinilai untuk kriteria periode berjalan.</p>
                            @can('write-data')
                                <a :href="'{{ route('evaluation.evaluation-add') }}?employee_id=' + selectedEmployee?.id" class="mt-4 px-4 py-2 bg-primary text-white text-xs font-semibold rounded-lg hover:opacity-90 transition active:scale-95">
                                    Input Nilai Sekarang
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex justify-end">
                <button type="button" @click="detailModalOpen = false" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg text-sm font-semibold transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
