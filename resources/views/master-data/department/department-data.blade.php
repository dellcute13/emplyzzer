@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Data Departemen</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Kelola master data yang ada dalam sistem.</p>
        </div>
        <a class="flex items-center justify-center bg-primary text-on-primary px-4 py-2.5 sm:px-6 sm:py-3 rounded-lg font-medium hover:opacity-90 transition-all active:scale-95 w-full sm:w-auto text-center"
            href="{{ route('master-data.department-add') }}">
            <span class="material-symbols-outlined mr-2" data-icon="add">add</span>
            Tambah Departemen
        </a>
    </div>
    <!-- Dashboard Content -->
    <div class="bg-white rounded-xl border border-slate-200 custom-shadow overflow-hidden">
        <!-- Modern Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-900 font-headline-md border-b border-slate-100">
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-xs font-bold uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-xs font-bold uppercase tracking-wider">Nama Departemen</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-xs font-bold uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($departments as $department)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-4 py-3 sm:px-6 sm:py-4 font-data-tabular">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 font-data-tabular text-slate-600">
                            {{ $department->name }}
                        </td>

                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-right">
                            <div class="flex justify-end space-x-2">

                                <a href="{{ route('master-data.department-edit', $department->id) }}"
                                    class="p-2 text-slate-400 hover:text-primary transition-colors"
                                    title="Edit">

                                    <span class="material-symbols-outlined text-sm">
                                        edit
                                    </span>
                                </a>

                                <form action="{{ route('master-data.department-delete', $department->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this department?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="p-2 text-slate-400 hover:text-error transition-colors"
                                        title="Delete">
                                        <span class="material-symbols-outlined text-sm">
                                            delete
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center text-slate-400">
                            Belum ada data departemen
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="px-4 py-3.5 sm:px-6 sm:py-4 border-t border-slate-100 bg-slate-50 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="font-body-md text-body-md text-slate-500">Showing {{ $departments->firstItem() }} -
                {{ $departments->lastItem() }} of {{ $departments->total() }} departments
            </p>
            <div class="flex space-x-2">

                @if ($departments->onFirstPage())
                <button disabled
                    class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-400">
                    Previous
                </button>
                @else
                <a href="{{ $departments->previousPageUrl() }}"
                    class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-600 hover:bg-slate-50">
                    Previous
                </a>
                @endif

                @if ($departments->hasMorePages())
                <a href="{{ $departments->nextPageUrl() }}"
                    class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-600 hover:bg-slate-50">
                    Next
                </a>
                @else
                <button disabled
                    class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-400">
                    Next
                </button>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection