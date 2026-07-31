<div class="w-full min-h-screen items-center justify-center flex p-4 sm:p-6 lg:p-8">
    <div class="bg-white rounded-3xl sm:rounded-4xl w-full max-w-5xl min-h-fit lg:h-[570px] flex flex-col lg:flex-row backdrop-blur-3xl overflow-hidden shadow-2xl p-2 sm:p-3">
        {{-- bagian kiri card --}}
        <div
            class="bg-liner-color w-full lg:w-[36%] xl:w-2/5 rounded-2xl lg:rounded-3xl justify-center items-center hidden lg:flex flex-col relative p-6 lg:p-8">
            <div class="relative mb-6 bg-white rounded-full w-28 h-28 lg:w-30 lg:h-30 flex items-center justify-center animate-rotate-slow shadow-[0_10px_30px_rgba(0,0,0,0.2)]">
                <i class="bi bi-shop text-4xl lg:text-5xl text-maroon-primary"></i>
            </div>
            <h1 class="text-xl lg:text-2xl font-bold text-center relative my-4 text-white">Sistem Rumah Makan
                <br>
                lapau uda sutan
            </h1>
            <p class="text-center relative text-white/80 text-xs lg:text-sm leading-relaxed">Platform terintegrasi untuk mengelola
                kasir
                dengan lebih efisien dan modern. Kelola transaksi,
                inventori, dan laporan dengan mudah.</p>
        </div>

        {{-- bagian kanan card --}}
        <div class="h-full w-full lg:w-[64%] xl:w-3/5 justify-center items-center flex flex-col relative py-4 sm:py-6 px-4 sm:px-8 lg:px-10 my-auto">
            
            <!-- Login Header -->
            <div class="text-center mb-4 sm:mb-6">
                <h2 class="text-maroon-primary text-2xl sm:text-3xl font-bold mb-0.5">Selamat Datang</h2>
                <p class="text-gray-600 text-xs sm:text-sm">Silakan login untuk melanjutkan</p>
            </div>

            <!-- Error Alert -->
            <div id="errorAlert"
                class="hidden items-center justify-between rounded-xl border border-red-300 bg-red-100 px-4 py-3 text-red-700 shadow-md w-full mb-4">

                <div class="flex items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill text-lg"></i>

                    <span id="errorMessage">
                        Username atau password salah!
                    </span>
                    <button type="button" onclick="document.getElementById('errorAlert').classList.add('hidden')"
                        class="text-red-500 transition hover:text-red-700">

                        <i class="bi bi-x-lg"></i>

                    </button>
                </div>
            </div>

            <!-- Login Form -->
            <form wire:submit.prevent="login" class="w-full" x-data="{ selected: @js($user_type) }">
                @csrf
                {{-- User Type Toggle --}}
                <div class="mb-5 sm:mb-6 w-full">

                    <div class="flex w-full gap-3 sm:gap-4">
                        <x-login.button-select value="kasir" icon="bi-cash-coin">
                            Kasir
                        </x-login.button-select>

                        <x-login.button-select value="admin" icon="bi-person-badge">
                            Admin
                        </x-login.button-select>

                    </div>

                </div>

                <!-- Username Field -->
                <div class="space-y-4 sm:space-y-5 w-full">

                    <!-- Username -->
                    <div class="relative">

                        <div class="relative">

                            <i
                                class="bi bi-person
                                    absolute left-4 top-1/2 -translate-y-1/2
                                    text-maroon-primary
                                    transition-colors duration-200
                                    peer-focus:text-[var(--color-maroon-primary)]
                                "></i>

                            <input type="text" id="username" placeholder=" " required
                                class="
                                            peer w-full
                                            rounded-xl
                                            border-2 border-[var(--color-maroon-primary)]
                                            bg-white
                                            py-3.5 sm:py-4 pl-12 pr-4
                                            text-sm text-maroon-primary

                                            outline-none
                                            transition-all duration-200

                                            focus:border-[var(--color-maroon-primary)]
                                            focus:ring-4
                                            focus:ring-[rgba(155,32,44,0.26)]
                                        ">

                            <label for="username"
                                class="
                                    absolute left-12 top-1/2
                                    -translate-y-1/2
                                    bg-white px-1

                                    text-slate-700
                                    transition-all duration-200

                                    peer-placeholder-shown:text-[var(--color-maroon-primary)]
                                    peer-focus:top-0
                                    peer-focus:text-sm
                                    peer-focus:text-[var(--color-maroon-primary)]

                                    peer-[:not(:placeholder-shown)]:top-0
                                    peer-[:not(:placeholder-shown)]:text-sm
                                ">
                                Username
                            </label>

                        </div>

                    </div>

                    <!-- Password -->
                    <div x-data="{ show: false }" class="relative">

                        <div class="relative">

                            <i
                                class="bi bi-lock
                                    absolute left-4 top-1/2 -translate-y-1/2
                                    text-[var(--color-maroon-primary)]
                                    transition-colors duration-200
                                    peer-focus:text-[var(--color-maroon-primary)]
                                "></i>

                            <input :type="show ? 'text' : 'password'" id="password" placeholder=" " required
                                class="
                                        peer w-full
                                        rounded-xl
                                        border-2 border-[var(--color-maroon-primary)]
                                        bg-white

                                        py-3.5 sm:py-4 pl-12 pr-12

                                        text-sm text-[var(--color-maroon-primary)]

                                        outline-none
                                        transition-all duration-200

                                        focus:border-[var(--color-maroon-primary)]
                                        focus:ring-4
                                        focus:ring-[rgba(114,28,36,0.15)]
                                    ">

                            <label for="password"
                                class="
                                    absolute left-12 top-1/2
                                    -translate-y-1/2
                                    bg-white px-1

                                    text-[var(--color-maroon-primary)]
                                    transition-all duration-200

                                    peer-placeholder-shown:text-[var(--color-maroon-primary)]
                                    peer-focus:top-0
                                    peer-focus:text-sm
                                    peer-focus:text-[var(--color-maroon-primary)]

                                    peer-[:not(:placeholder-shown)]:top-0
                                    peer-[:not(:placeholder-shown)]:text-sm
                                ">
                                Password
                            </label>

                            <!-- Toggle -->
                            <button type="button" @click="show = !show"
                                class="
                                    absolute right-4 top-1/2
                                    -translate-y-1/2

                                    text-slate-400
                                    hover:text-[var(--color-maroon-primary)]

                                    transition-colors duration-200
                                ">

                                <i class="bi" :class="show ? 'bi-eye-slash' : 'bi-eye'"></i>

                            </button>

                        </div>

                    </div>

                </div>

                <!-- Remember & Forgot -->
                <div class="flex flex-wrap items-center justify-between gap-2 mb-4 sm:mb-5 w-full mt-4">

                    <!-- Remember Me -->
                    <label class="flex items-center gap-3 cursor-pointer select-none">

                        <input type="checkbox" id="rememberMe"
                            class=" h-4 w-4 rounded
                                border-slate-300
                                text-[var(--maroon-primary)]
                                focus:ring-2
                                focus:ring-[rgba(114,28,36,0.2)]
                            ">

                        <span class="text-sm text-slate-600">
                            Ingat saya
                        </span>

                    </label>

                    <!-- Forgot Password -->
                    <a href="#"
                        class="
                            text-sm font-medium
                            text-[var(--maroon-primary)]
                            transition-all duration-200
                            hover:opacity-80
                            hover:underline
                        ">
                        Lupa password?
                    </a>

                </div>

                <!-- Login Button -->
                <div x-data="{ loading: false }" class="w-full">

                    <button type="submit" id="loginBtn" @click="loading = true" x-on:disabled="loading"
                        class="bg-[var(--color-maroon-primary)] border-0 py-3 font-semibold text-lg sm:text-xl rounded-xl relative w-full
                                            text-white transition-all duration-300 ease-in-out overflow-hidden
                                            hover:shadow-[0_10px_25px_rgba(114,28,36,0.3)] hover:translate-y-[-3px]
                                            active:shadow-none active:translate-y-0
                                            before:content-['']
                                            before:absolute
                                            before:top-0
                                            before:left-[-100%]
                                            before:w-full
                                            before:h-full

                                            before:bg-gradient-to-r
                                            before:from-transparent
                                            before:via-white/30
                                            before:to-transparent

                                            before:transition-all
                                            before:duration-700

                                            hover:before:left-full

                                            disabled:opacity-80
                                            disabled:pointer-events-none">
                        <span id="btnText" x-show="!loading">Masuk</span>
                        <span x-show="loading" class="flex items-center justify-center gap-2">
                            Memproses...

                            <!-- Spinner -->
                            <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4" fill="none"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>

            <!-- Additional Info -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="bi bi-shield-check me-1"></i>
                    Login Anda dilindungi dengan enkripsi
                </small>
            </div>

        </div>
    </div>
</div>
