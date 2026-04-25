<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">

    <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
        class="w-full max-w-md bg-white rounded-2xl p-8 shadow-2xl text-center">

        <div
            class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center text-3xl text-emerald-500 mb-5">
            <span class="material-symbols-outlined">
                check_circle
            </span>
        </div>

        <h2 class="text-2xl font-bold text-slate-900 mb-3">
            Login Berhasil
        </h2>

        <p class="text-slate-500 mb-6">
            Login berhasil masuk dashboard.
        </p>

        <button @click="show=false"
            class="w-full bg-slate-900 hover:bg-slate-700 text-white py-3 rounded-xl font-semibold">
            Go Back to Dashboard
        </button>

    </div>
</div>

{{-- <div x-data="{ show: true, loading: false, success: false }" x-show="show"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">

    <div x-show="show" x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-400" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        class="w-full max-w-md bg-white rounded-2xl p-8 shadow-2xl text-center">

        <div
            class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center text-3xl text-emerald-500 mb-5">

            <span x-show="!success" class="material-symbols-outlined">
                check_circle
            </span>

            <span x-show="success" x-transition class="material-symbols-outlined">
                done_all
            </span>

        </div>

        <h2 class="text-2xl font-bold text-slate-900 mb-3">
            Login Berhasil
        </h2>

        <p class="text-slate-500 mb-6">
            Login berhasil masuk dashboard.
        </p>

        <button
            @click="
                loading = true;

                setTimeout(() => {
                    loading = false;
                    success = true;
                }, 1500);

                setTimeout(() => {
                    show = false;
                }, 2800);
            "
            :disabled="loading || success"
            class="w-full bg-slate-900 hover:bg-slate-700 disabled:bg-slate-700 text-white py-3 rounded-xl font-semibold flex items-center justify-center gap-2 transition-all duration-300">

            <svg x-show="loading" x-transition class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">

                <circle cx="12" cy="12" r="10" stroke-width="4" class="opacity-25">
                </circle>

                <path d="M4 12a8 8 0 018-8" stroke-width="4" class="opacity-75">
                </path>
            </svg>

            <span x-show="success" x-transition class="material-symbols-outlined">
                check
            </span>

            <span x-show="!loading && !success">Go Back to Dashboard</span>
            <span x-show="loading" x-transition>Loading...</span>
            <span x-show="success" x-transition>Success</span>

        </button>

    </div>
</div> --}}
