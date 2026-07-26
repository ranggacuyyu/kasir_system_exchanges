<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Sistem Toko</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="min-h-screen">

    <!-- Navbar -->
    <div class="fixed z-50 md:flex w-auto flex-row bg-gradient-to-r md:right-0 md:left-0 from-maroon-primary to-maroon-dark md:mb-0 mb-4 left-4 right-4 bottom-0 md:top-0 md:bottom-auto rounded-3xl md:rounded-none shadow-md md:shadow-none">

        <div class="p-4 text-zinc-100 font-bold text-lg pl-8 hidden md:block">
            <a href="{{ route('kasir.dashboard') }}">
                Cashier System
            </a>
        </div>

        <div class="flex-1 flex justify-evenly flex-wrap md:justify-end items-center p-2 text-white font-bold gap-16 text-sm md:text-lg md:pr-12">

            <!-- Pesanan -->
            <div class="flex flex-col items-center gap-2 hover:text-warning cursor-pointer">
                <div class="block md:hidden">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>

                <a href="#" title="Mengatur pesanan" aria-label="Menuju halaman pesanan">
                    Pesanan
                </a>
            </div>

            <!-- Hitung -->
            <div class="flex flex-col items-center gap-2 hover:text-warning cursor-pointer">
                <div class="block md:hidden">
                    <i class="fa-solid fa-calculator"></i>
                </div>

                <a href="#" title="Mengatur hitungan" aria-label="Menuju halaman hitungan">
                    Hitung
                </a>
            </div>

            <!-- Stok -->
            <div class="flex flex-col items-center gap-2 hover:text-warning cursor-pointer">
                <div class="block md:hidden">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>

                <a href="#" title="Mengatur stok" aria-label="Menuju halaman stok">
                    Stok
                </a>
            </div>

        </div>
    </div>

    <!-- Content -->
    <main class="pt-0 md:pt-14 pb-24 md:pb-0">

        {{-- Isi halaman --}}
        @yield('content')
        
    </main>

</body>
