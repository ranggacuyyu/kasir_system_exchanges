@extends('layouts.kasir.sideBar')

@section('content')
    {{-- Bagian Card --}}
    <div class="w-full p-4">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- Card 1 -->
        <div class="bg-maroon-light rounded-xl border-t-4 border-maroon-primary shadow-md hover:shadow-lg transition p-4 flex items-center gap-4">

            <div class="hidden md:flex w-14 h-14 rounded-full bg-maroon-primary items-center justify-center">
                <i class="fa-solid fa-cart-shopping text-2xl text-white"></i>
            </div>

            <div class="flex flex-col">
                <h2 class="text-2xl font-bold text-white">0</h2>
                <p class="text-sm text-gray-200">
                    Total Pesanan Hari Ini
                </p>
            </div>

        </div>

        <!-- Card 2 -->
        <div class="bg-maroon-light rounded-xl border-t-4 border-maroon-primary shadow-md hover:shadow-lg transition p-4 flex items-center gap-4">

            <div class="hidden md:flex w-14 h-14 rounded-full bg-maroon-primary items-center justify-center">
                <i class="fa-solid fa-calculator text-2xl text-white"></i>
            </div>

            <div class="flex flex-col">
                <h2 class="text-2xl font-bold text-white">0</h2>
                <p class="text-sm text-gray-200">
                    Pesanan Sudah Dibuat
                </p>
            </div>

        </div>

        <!-- Card 3 -->
        <div class="bg-maroon-light rounded-xl border-t-4 border-maroon-primary shadow-md hover:shadow-lg transition p-4 flex items-center gap-4">

            <div class="hidden md:flex w-14 h-14 rounded-full bg-maroon-primary items-center justify-center">
                <i class="fa-solid fa-money-bill-wave text-2xl text-white"></i>
            </div>

            <div class="flex flex-col">
                <h2 class="text-2xl font-bold text-white">Rp 0</h2>
                <p class="text-sm text-gray-200">
                    Pendapatan Hari Ini
                </p>
            </div>

        </div>

        <!-- Card 4 -->
        <div class="bg-maroon-light rounded-xl border-t-4 border-maroon-primary shadow-md hover:shadow-lg transition p-4 flex items-center gap-4">

            <div class="hidden md:flex w-14 h-14 rounded-full bg-maroon-primary items-center justify-center">
                <i class="fa-solid fa-users text-2xl text-white"></i>
            </div>

            <div class="flex flex-col">
                <h2 class="text-2xl font-bold text-white">0</h2>
                <p class="text-sm text-gray-200">
                    Total Pelanggan
                </p>
            </div>

        </div>

    </div>
</div>
@endsection
