<div x-data="{
    show: true,
    showDetail: false
}">

    <!-- ✅ SUCCESS ALERT -->
    <div x-init="setTimeout(() => show = false, 5000)" x-show="show"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">

        <div x-show="show" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-400" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
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

            <button @click="show = false"
                class="w-full bg-slate-900 hover:bg-slate-700 text-white py-3 rounded-xl font-semibold">

                Go Back to Dashboard

            </button>

        </div>

    </div>

    <!-- 🔥 BUTTON DETAIL -->
    <button @click="showDetail = true" class="px-4 py-2 bg-slate-900 text-white rounded-lg text-sm">

        Detail Employee

    </button>

    <!-- 🔥 DETAIL EMPLOYEE MODAL -->
    <div x-show="showDetail" x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">

        <!-- CARD -->
        <div x-show="showDetail" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-90 translate-y-6"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="relative w-full max-w-xl bg-white rounded-[2rem] p-6 shadow-2xl">

            <!-- CLOSE -->
            <button @click="showDetail = false"
                class="absolute top-5 right-5 w-10 h-10 rounded-full hover:bg-slate-100 flex items-center justify-center transition">

                <span class="material-symbols-outlined text-slate-500">
                    close
                </span>

            </button>

            <!-- TOP -->
            <div class="flex gap-5">

                <!-- PHOTO -->
                <div class="w-40 h-40 rounded-3xl overflow-hidden bg-slate-100 flex-shrink-0">

                    <img src="https://i.pravatar.cc/300" class="w-full h-full object-cover">

                </div>

                <!-- INFO -->
                <div class="flex-1">

                    <!-- STATUS -->
                    <div
                        class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-xs font-semibold mb-3">

                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                        Online

                    </div>

                    <!-- NAME -->
                    <h2 class="text-3xl font-bold text-slate-900 leading-tight">
                        Dr. Putri Anggraheni
                    </h2>

                    <!-- POSITION -->
                    <p class="text-slate-500 text-lg mt-1">
                        Primary Care Doctor
                    </p>

                    <!-- META -->
                    <div class="flex items-center gap-4 mt-5">

                        <div class="flex items-center gap-1 text-orange-400">

                            <span class="material-symbols-outlined text-[20px]">
                                star
                            </span>

                            <span class="font-bold text-lg">
                                4.85
                            </span>

                            <span class="text-slate-400">
                                (255)
                            </span>

                        </div>

                        <div class="w-1 h-1 rounded-full bg-slate-300"></div>

                        <span class="text-slate-500">
                            16.8km
                        </span>

                    </div>

                    <!-- VIDEO -->
                    <div class="flex items-center gap-2 mt-4 text-indigo-500 font-medium">

                        <span class="material-symbols-outlined">
                            videocam
                        </span>

                        Provide video visit

                    </div>

                </div>

            </div>

        </div>

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
