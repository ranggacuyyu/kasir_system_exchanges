<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Toko</title>
    <link rel="icon" href="/images/logo/logo.png" type="image/png" title="Atom">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-linear-color">
    <!-- Background particles -->
    <div x-data="particleField()" x-init="init()"
        class="relative w-full h-screen overflow-hidden bg-linear-color">

        <!-- Particles -->
        <template x-for="p in particles" :key="p.id">
            <div class="absolute rounded-full bg-white/60 blur-[0.5px]" :style="particleStyle(p)"></div>
        </template>

        <!-- Content di atas partikel -->
        <div class="relative z-10 flex items-center justify-center h-full text-white">


            <div class="w-full min-h-screen items-center justify-center flex">
                <div
                    class="bg-white rounded-4xl w-5xl h-143 flex backdrop-blur-3xl overflow-hidden shadow-2xl pt-3 px-3">
                    {{-- bagian kiri card --}}
                    <div
                        class="bg-liner-color w-20% h-full rounded-t-3xl justify-center items-center hidden lg:flex flex-col position-relative p-5">
                        <div
                            class="position-relative mb-6 bg-white rounded-full w-30 h-30 flex items-center justify-center animate-rotate-slow shadow-[0_10px_30px_rgba(0,0,0,0.2)]">
                            <i class="bi bi-shop text-5xl text-maroon-primary"></i>
                        </div>
                        <h1 class="text-2xl font-bold text-center position-relative my-4 text-white">Sistem Rumah Makan
                            <br>
                            lapau uda sutan
                        </h1>
                        <p class=" text-center position-relative text-white/80">Platform terintegrasi untuk mengelola
                            kasir
                            dengan lebih efisien dan modern. Kelola transaksi,
                            inventori, dan laporan dengan mudah.</p>
                    </div>

                    {{-- bagian kanan card --}}
                    <div
                        class="h-full w-full justify-center items-center flex flex-col position-relative py-5 pl-8 pr-5">

                        <!-- Mobile Logo -->
                        <div class="text-center d-lg-none mb-4 block lg:hidden">
                            <div
                                class="mb-6 bg-white rounded-full w-30 h-30 flex items-center justify-center animate-rotate-slow shadow-[0_10px_30px_rgba(0,0,0,0.2)]">
                                <i class="bi bi-shop text-5xl text-maroon-primary"></i>
                            </div>
                        </div>

                        <!-- Login Header -->
                        <div class="text-center mb-4">
                            <h2 class="text-maroon-primary text-3xl font-bold mb-0.5">Selamat Datang</h2>
                            <p class="text-gray-600 text-sm">Silakan login untuk melanjutkan</p>
                        </div>

                        <!-- Error Alert -->
                        <div id="errorAlert"
                            class="hidden items-center justify-between rounded-xl border border-red-300 bg-red-100 px-4 py-3 text-red-700 shadow-md">

                            <div class="flex items-center gap-2">
                                <i class="bi bi-exclamation-triangle-fill text-lg"></i>

                                <span id="errorMessage">
                                    Username atau password salah!
                                </span>
                                <button type="button"
                                    onclick="document.getElementById('errorAlert').classList.add('hidden')"
                                    class="text-red-500 transition hover:text-red-700">

                                    <i class="bi bi-x-lg"></i>

                                </button>
                            </div>
                        </div>

                        <!-- Login Form -->
                        <form id="loginForm" class="w-full">

                            {{-- User Type Toggle --}}
                            <div class="mb-8 w-full">

                                <div class="flex w-full gap-4">

                                    <x-login.button-select icon="bi-cash-coin" :active="true" class="w-full">
                                        Kasir
                                    </x-login.button-select>

                                    <x-login.button-select icon="bi-person-badge" class="w-full">
                                        Admin
                                    </x-login.button-select>

                                </div>

                            </div>

                        </form>

                        <!-- Username Field -->
                        <div class="space-y-6 w-full">

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
                                            py-4 pl-12 pr-4
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

                                        py-4 pl-12 pr-12

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
                        <div class="flex items-center justify-between mb-4 w-full mt-4">

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
                                class="bg-[var(--color-maroon-primary)] border-0 py-3 font-semibold text-xl rounded-xl relative w-full
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
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4" fill="none"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
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

        </div>
    </div>

    <script>
        function particleField() {
            return {
                particles: [],

                init() {
                    this.generateParticles(40);
                },

                generateParticles(count) {
                    for (let i = 0; i < count; i++) {
                        this.particles.push({
                            id: i,
                            x: Math.random() * window.innerWidth,
                            y: Math.random() * window.innerHeight,
                            size: Math.random() * 10 + 2,
                            speed: Math.random() * 0.5 + 0.2,
                            drift: Math.random() * 0.6 - 0.3,
                            opacity: Math.random() * 0.6 + 0.2
                        });
                    }

                    this.animate();
                },

                animate() {
                    setInterval(() => {
                        this.particles.forEach(p => {

                            p.y -= p.speed;
                            p.x += p.drift;

                            // reset kalau keluar layar
                            if (p.y < -10) {
                                p.y = window.innerHeight + 10;
                                p.x = Math.random() * window.innerWidth;
                            }

                            if (p.x < 0) p.x = window.innerWidth;
                            if (p.x > window.innerWidth) p.x = 0;
                        });
                    }, 16);
                },

                particleStyle(p) {
                    return {
                        left: p.x + 'px',
                        top: p.y + 'px',
                        width: p.size + 'px',
                        height: p.size + 'px',
                        opacity: p.opacity
                    }
                }
            }
        }
    </script>
</body>

</html>
