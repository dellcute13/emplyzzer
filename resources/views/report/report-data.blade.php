@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <section class="bg-white p-lg rounded-xl custom-shadow border border-slate-100">
            <div class="flex flex-col md:flex-row gap-lg items-end">
                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-md w-full">
                    <div class="space-y-sm">
                        <div x-data="{ open: false, selected: 'Monthly Performance Summary' }" class="space-y-2 relative">
                            <label class="font-label-sm text-slate-700 uppercase">Report Type</label>
                            <input type="hidden" name="department" :value="selected">
                            <button type="button" @click="open = !open" @click.away="open = false"
                                class="w-full bg-slate-50 border-slate-200 border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:border-primary-container focus:ring-2 focus:ring-primary-container h-11">
                                <span class="text-left"
                                    :class="selected == 'Monthly Performance Summary' ? 'text-slate-700' : 'text-slate-800'"
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
                                <button type="button" @click="selected='Monthly Performance Summary'; open=false"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 transition">
                                    Monthly Performance Summary
                                </button>
                                <button type="button" @click="selected='Annual Executive Audit'; open=false"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 border-t border-slate-100 hover:bg-slate-50 transition">
                                    Annual Executive Audit
                                </button>
                                <button type="button" @click="selected='Periodical SAW Comparison'; open=false"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 border-t border-slate-100 hover:bg-slate-50 transition">
                                    Periodical SAW Comparison
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-sm">
                        <label class="font-label-sm text-slate-500 uppercase">
                            Periode Tanggal
                        </label>

                        <div class="relative">

                            <input id="date_range" type="text" placeholder="Pilih rentang tanggal"
                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 pr-11 text-body-md focus:ring-2 focus:ring-primary-container h-11 outline-none transition-all">

                            <button type="button" tabindex="-1"
                                class="absolute right-3 top-2.5 text-outline hover:text-primary transition-colors pointer-events-none">
                                <span class="material-symbols-outlined">
                                    date_range
                                </span>
                            </button>

                        </div>
                    </div>
                </div>
                <button
                    class="bg-primary-container text-white px-xl h-11 rounded-lg font-data-tabular hover:bg-slate-800 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">filter_alt</span>
                    Generate Report
                </button>
            </div>
        </section>
        <!-- Summary Cards Bento Grid -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-lg">
            <!-- Total Reports -->
            <div class="bg-white p-lg rounded-xl custom-shadow border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="font-label-sm text-slate-500 uppercase mb-1">Total Reports Generated</p>
                    <h3 class="font-display-xl text-slate-900">1,284</h3>
                    <p class="text-xs text-success flex items-center gap-1 mt-2">
                        <span class="material-symbols-outlined text-sm">trending_up</span>
                        <span class="text-green-600 font-semibold">+12% from last month</span>
                    </p>
                </div>
                <div class="w-14 h-14 bg-slate-50 rounded-full flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined text-3xl">summarize</span>
                </div>
            </div>
            <!-- Last Generated -->
            <div class="bg-white p-lg rounded-xl custom-shadow border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="font-label-sm text-slate-500 uppercase mb-1">Last Generated Report</p>
                    <h3 class="font-headline-lg text-slate-900">Oct 2023 Payroll</h3>
                    <p class="text-xs text-slate-500 mt-2">Generated 2 hours ago</p>
                </div>
                <div class="w-14 h-14 bg-slate-50 rounded-full flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined text-3xl">schedule</span>
                </div>
            </div>
            <!-- High Performing Dept -->
            <div class="bg-white p-lg rounded-xl custom-shadow border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="font-label-sm text-slate-500 uppercase mb-1">Top Performing Dept</p>
                    <h3 class="font-headline-lg text-slate-900">R&amp;D Engineering</h3>
                    <p class="text-xs text-slate-500 mt-2">Score: 0.942 (SAW Index)</p>
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
                    <h4 class="font-headline-md text-slate-900">Visual Analytics</h4>
                    <span class="material-symbols-outlined text-slate-400">more_horiz</span>
                </div>
                <p class="text-body-md text-slate-500 mb-lg leading-relaxed">Performance index comparison across major
                    departments based on current SAW criteria.</p>
                <div class="space-y-6 mt-4">
                    <!-- Bar 1 -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-semibold uppercase tracking-wider text-slate-600">
                            <span>R&amp;D Engineering</span>
                            <span>94%</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-primary-container h-full rounded-full" style="width: 94%"></div>
                        </div>
                    </div>
                    <!-- Bar 2 -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-semibold uppercase tracking-wider text-slate-600">
                            <span>Finance &amp; Audit</span>
                            <span>82%</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-primary-container h-full rounded-full" style="width: 82%"></div>
                        </div>
                    </div>
                    <!-- Bar 3 -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-semibold uppercase tracking-wider text-slate-600">
                            <span>Human Resources</span>
                            <span>78%</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-primary-container h-full rounded-full" style="width: 78%"></div>
                        </div>
                    </div>
                    <!-- Bar 4 -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-semibold uppercase tracking-wider text-slate-600">
                            <span>Sales Operations</span>
                            <span>65%</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-primary-container h-full rounded-full" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-xl pt-lg border-t border-slate-100">
                    <button class="text-secondary font-semibold text-sm hover:underline flex items-center gap-1">
                        View detailed analytics <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </button>
                </div>
            </section>
            <!-- Report History Table -->
            <section class="lg:col-span-8 bg-white rounded-xl custom-shadow border border-slate-100 overflow-hidden">
                <div class="p-lg flex justify-between items-center border-b border-slate-100">
                    <div>
                        <h4 class="font-headline-md text-slate-900">Report History</h4>
                        <p class="text-xs text-slate-500 mt-1">Audit log of all system reports</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2 border border-slate-200 rounded-lg hover:bg-slate-50"><span
                                class="material-symbols-outlined">search</span></button>
                        <button class="p-2 border border-slate-200 rounded-lg hover:bg-slate-50"><span
                                class="material-symbols-outlined">file_download</span></button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider">Report Name
                                </th>
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider">Date</th>
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider">Generated By
                                </th>
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider text-right">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-lg py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-slate-400">picture_as_pdf</span>
                                        <span class="font-data-tabular text-slate-900">Q3_Perf_Review_2023.pdf</span>
                                    </div>
                                </td>
                                <td class="px-lg py-4 text-body-md text-slate-600">Oct 24, 2023</td>
                                <td class="px-lg py-4">
                                    <span
                                        class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-semibold">Admin_01</span>
                                </td>
                                <td class="px-lg py-4">
                                    <div class="flex justify-end gap-3">
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="View"><span
                                                class="material-symbols-outlined text-xl">visibility</span></button>
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="Download"><span
                                                class="material-symbols-outlined text-xl">download</span></button>
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="Print"><span
                                                class="material-symbols-outlined text-xl">print</span></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-lg py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-slate-400">table_chart</span>
                                        <span
                                            class="font-data-tabular text-slate-900">Annual_Ranking_List_Final.xlsx</span>
                                    </div>
                                </td>
                                <td class="px-lg py-4 text-body-md text-slate-600">Oct 20, 2023</td>
                                <td class="px-lg py-4">
                                    <span
                                        class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-semibold">Admin_01</span>
                                </td>
                                <td class="px-lg py-4">
                                    <div class="flex justify-end gap-3">
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="View"><span
                                                class="material-symbols-outlined text-xl">visibility</span></button>
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="Download"><span
                                                class="material-symbols-outlined text-xl">download</span></button>
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="Print"><span
                                                class="material-symbols-outlined text-xl">print</span></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-lg py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-slate-400">picture_as_pdf</span>
                                        <span class="font-data-tabular text-slate-900">Monthly_Audit_Sept_2023.pdf</span>
                                    </div>
                                </td>
                                <td class="px-lg py-4 text-body-md text-slate-600">Sep 30, 2023</td>
                                <td class="px-lg py-4">
                                    <span
                                        class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-semibold">System_Task</span>
                                </td>
                                <td class="px-lg py-4">
                                    <div class="flex justify-end gap-3">
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="View"><span
                                                class="material-symbols-outlined text-xl">visibility</span></button>
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="Download"><span
                                                class="material-symbols-outlined text-xl">download</span></button>
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="Print"><span
                                                class="material-symbols-outlined text-xl">print</span></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-lg py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-slate-400">picture_as_pdf</span>
                                        <span class="font-data-tabular text-slate-900">Dept_Comparison_Aug_Rev.pdf</span>
                                    </div>
                                </td>
                                <td class="px-lg py-4 text-body-md text-slate-600">Aug 28, 2023</td>
                                <td class="px-lg py-4">
                                    <span
                                        class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-semibold">Manager_B</span>
                                </td>
                                <td class="px-lg py-4">
                                    <div class="flex justify-end gap-3">
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="View"><span
                                                class="material-symbols-outlined text-xl">visibility</span></button>
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="Download"><span
                                                class="material-symbols-outlined text-xl">download</span></button>
                                        <button class="text-slate-400 hover:text-primary transition-colors"
                                            title="Print"><span
                                                class="material-symbols-outlined text-xl">print</span></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-lg bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs text-slate-500 font-medium">Showing 4 of 1,284 reports</span>
                    <div class="flex gap-1">
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded border border-slate-200 bg-white text-slate-500 hover:bg-slate-50 transition-colors"><span
                                class="material-symbols-outlined text-sm">chevron_left</span></button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded bg-primary-container text-white text-xs font-bold">1</button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded border border-slate-200 bg-white text-slate-500 hover:bg-slate-50 transition-colors text-xs font-bold">2</button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded border border-slate-200 bg-white text-slate-500 hover:bg-slate-50 transition-colors text-xs font-bold">3</button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded border border-slate-200 bg-white text-slate-500 hover:bg-slate-50 transition-colors"><span
                                class="material-symbols-outlined text-sm">chevron_right</span></button>
                    </div>
                </div>
            </section>
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
