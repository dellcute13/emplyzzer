@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-50 bg-emerald-500 text-white px-6 py-4 rounded-2xl shadow-xl">

        <div class="flex items-center gap-3">
            <span>✅</span>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-50 bg-red-500 text-white px-6 py-4 rounded-2xl shadow-xl">

        <div class="flex items-center gap-3">
            <span>❌</span>
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif
