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

    {{-- Navbar --}}
    <x-kasir.navbar />

    <!-- Content -->
    <main class="pt-0 md:pt-14 pb-24 md:pb-0 px-8">

        {{-- Isi halaman --}}
        {{-- Bagian Card --}}
        <div class="w-full py-6">
            <x-kasir.card-pesanan />
        </div>

        <div class="pb-4 gap-8 flex flex-row">
            <div class=" w-4/10">
                <div class="flex flex-col bg-amber-400 p-4 rounded-2xl">
                    <div class="flex dlex-row items-center justify-between">
                        <div class="flex dlex-row">
                            <i class="fa-solid fa-list text-2xl pr-4"></i>
                            <p class="text-xl">Daftar pesanan</p>
                        </div>
                        <button class="bg-maroon-secondary px-6 py-4"> Refresh</button>
                    </div>
                    <input type="text" class="bg-white p-2 left-2 right-2 m-2 w-full rounded-xl" name="nama"
                        id="nama"placeholder="Cari Nomor Pesanan">

                </div>
            </div>
            <div class="bg-white w-6/10">testing</div>
        </div>
    </main>

</body>
