<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan & Pembayaran — Meja {{ $meja }} | Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --maroon-dark:    #5d1a1a;
            --maroon-primary: #721c24;
            --maroon-sec:     #a52834;
            --base:           #f9f3ed;
            --amber:          #f59e0b;
        }
        [x-cloak] { display: none !important; }

        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--base); }

        .top-bar {
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--maroon-primary) 60%, var(--maroon-sec) 100%);
        }

        .card { background:#fff; border:1.5px solid #e8e3dc; border-radius:22px; }

        /* Payment option card */
        .pay-card {
            border: 1.5px solid #e4ddd4;
            border-radius: 18px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .pay-card:hover { border-color: #a52834; background: #fdf8f7; }
        .pay-card.active {
            border-color: var(--maroon-primary);
            background: linear-gradient(135deg, #fdf5f5 0%, #fff9f5 100%);
            box-shadow: 0 0 0 3px rgba(114,28,36,0.12);
        }

        /* QRIS Display */
        .qris-box {
            background: linear-gradient(135deg, #fafafa 0%, #f5f0eb 100%);
            border: 1.5px solid #e8e3dc;
            border-radius: 16px;
        }

        .cta-order {
            background: linear-gradient(135deg, var(--maroon-sec) 0%, var(--maroon-primary) 55%, var(--maroon-dark) 100%);
            box-shadow: 0 8px 28px rgba(114,28,36,0.40);
            border-radius: 18px;
            transition: all 0.22s ease;
        }
        .cta-order:hover  { transform: translateY(-2px); box-shadow: 0 12px 36px rgba(114,28,36,0.50); }
        .cta-order:active { transform: none; box-shadow: 0 4px 16px rgba(114,28,36,0.30); }

        @keyframes slide-up {
            from { opacity:0; transform:translateY(22px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .s1 { animation: slide-up 0.4s ease both; }
        .s2 { animation: slide-up 0.4s 0.08s ease both; }
        .s3 { animation: slide-up 0.4s 0.16s ease both; }
        .s4 { animation: slide-up 0.4s 0.24s ease both; }

        @keyframes qr-appear {
            from { opacity:0; transform: scale(0.88); }
            to   { opacity:1; transform: scale(1); }
        }
        .qr-appear { animation: qr-appear 0.35s ease both; }
    </style>
</head>

<body class="min-h-screen pb-10" x-data="checkoutOrderSystem('{{ $meja }}')">

    {{-- ═══════════ HEADER ═══════════ --}}
    <header class="top-bar sticky top-0 z-40 px-4 py-3 flex items-center gap-3 border-b border-amber-400/20 shadow-xl">
        <a href="{{ route('order.menu', ['meja' => $meja]) }}"
           class="w-8 h-8 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center border border-white/15 transition shrink-0">
            <i class="fa-solid fa-arrow-left text-amber-300 text-xs"></i>
        </a>
        <div class="flex-1">
            <p class="text-[9px] font-extrabold tracking-[0.15em] text-amber-400 uppercase">Konfirmasi & Bayar</p>
            <h1 class="text-sm font-black text-white leading-tight">Detail Pemesanan</h1>
        </div>
        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-amber-400/30">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-[11px] font-extrabold text-amber-300" x-text="'Meja ' + meja"></span>
        </div>
    </header>


    {{-- ═══════════ CONTENT ═══════════ --}}
    <main class="max-w-lg mx-auto px-4 pt-5 space-y-4">

        {{-- 1. RINGKASAN PESANAN --}}
        <div class="s1 card p-5 space-y-3">
            <div class="flex items-center justify-between pb-3 border-b border-zinc-100">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-xl bg-[#721c24]/10 flex items-center justify-center">
                        <i class="fa-solid fa-receipt text-[#721c24] text-xs"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-zinc-900">Rincian Pesanan</h3>
                        <p class="text-[10px] text-zinc-400" x-text="'Meja ' + meja"></p>
                    </div>
                </div>
                <a href="{{ route('order.menu', ['meja' => $meja]) }}"
                   class="text-xs font-extrabold text-[#721c24] hover:underline flex items-center gap-1">
                    <i class="fa-solid fa-pen-to-square text-[10px]"></i> Edit
                </a>
            </div>

            <div class="space-y-2.5 text-xs">
                <template x-for="item in orderItems" :key="item.id">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 rounded-xl bg-[#f9f3ed] flex items-center justify-center shrink-0 border border-[#e8e3dc]">
                                <i class="fa-solid fa-bowl-food text-[#a52834] text-xs"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="font-bold text-zinc-900 truncate" x-text="item.name"></p>
                                <p class="text-[10px] text-zinc-400" x-text="item.qty + ' porsi × ' + formatRupiah(item.price)"></p>
                            </div>
                        </div>
                        <span class="font-extrabold text-zinc-900 shrink-0" x-text="formatRupiah(item.qty * item.price)"></span>
                    </div>
                </template>
            </div>
        </div>


        {{-- 2. DATA PEMESAN --}}
        <div class="s2 card p-5 space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-zinc-100">
                <div class="w-8 h-8 rounded-xl bg-[#721c24]/10 flex items-center justify-center">
                    <i class="fa-solid fa-user-pen text-[#721c24] text-xs"></i>
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-zinc-900">Data Pemesan</h3>
                    <p class="text-[10px] text-zinc-400">Diperlukan untuk konfirmasi dapur</p>
                </div>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <label class="block font-bold text-zinc-700 mb-1.5">
                        Nama Pemesan <span class="text-rose-500 text-[10px]">* wajib diisi</span>
                    </label>
                    <div class="flex items-center gap-2.5 bg-zinc-50 border-2 rounded-2xl px-3.5 py-2.5 transition-all"
                         :class="customerName ? 'border-[#721c24]/30' : 'border-zinc-200'">
                        <i class="fa-solid fa-user text-zinc-400 text-xs shrink-0"></i>
                        <input type="text" x-model="customerName"
                               placeholder="Nama lengkap Anda (misal: Budi Santoso)"
                               class="flex-1 bg-transparent font-semibold text-zinc-900 placeholder-zinc-400 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-zinc-700 mb-1.5">
                        Catatan Khusus untuk Dapur <span class="text-zinc-400 font-normal">(opsional)</span>
                    </label>
                    <div class="bg-zinc-50 border-2 border-zinc-200 rounded-2xl px-3.5 py-2.5 flex gap-2.5">
                        <i class="fa-solid fa-comment-dots text-zinc-400 text-xs shrink-0 mt-0.5"></i>
                        <textarea x-model="specialNote" rows="2"
                                  placeholder="Misal: sambal ijo dipisah, bumbu rendang dibanyakin..."
                                  class="flex-1 bg-transparent font-medium text-zinc-800 placeholder-zinc-400 outline-none resize-none text-xs leading-relaxed"></textarea>
                    </div>
                </div>
            </div>
        </div>


        {{-- 3. METODE PEMBAYARAN --}}
        <div class="s3 card p-5 space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-zinc-100">
                <div class="w-8 h-8 rounded-xl bg-[#721c24]/10 flex items-center justify-center">
                    <i class="fa-solid fa-wallet text-[#721c24] text-xs"></i>
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-zinc-900">Pilih Cara Pembayaran</h3>
                    <p class="text-[10px] text-zinc-400">Aman · Terverifikasi · Instan</p>
                </div>
            </div>

            <div class="space-y-3 text-xs">

                {{-- QRIS Option --}}
                <div class="pay-card p-4 space-y-3" :class="paymentMethod === 'qris' ? 'active' : ''" @click="paymentMethod = 'qris'">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center border border-sky-200 shrink-0">
                            <i class="fa-solid fa-qrcode text-sky-700 text-base"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="font-extrabold text-zinc-900">QRIS All-Payment</span>
                                <div class="w-4 h-4 rounded-full border-2 flex items-center justify-center transition"
                                     :class="paymentMethod === 'qris' ? 'border-[#721c24] bg-[#721c24]' : 'border-zinc-300'">
                                    <template x-if="paymentMethod === 'qris'">
                                        <i class="fa-solid fa-check text-white text-[7px]"></i>
                                    </template>
                                </div>
                            </div>
                            <p class="text-[10px] text-zinc-500">BCA Mobile · Mandiri Livin · Gopay · OVO · ShopeePay</p>
                        </div>
                    </div>

                    <!-- QR Code display -->
                    <div x-show="paymentMethod === 'qris'" x-transition class="qr-appear qris-box p-4 text-center space-y-2.5">
                        <p class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Scan QR Code Berikut</p>
                        <div class="w-36 h-36 mx-auto bg-white rounded-2xl shadow-md flex items-center justify-center border border-zinc-200 p-1.5">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=LAPAU_UDA_SUTAN_QRIS_PAYMENT_{{ $meja }}"
                                 alt="QRIS Code"
                                 class="w-full h-full object-contain rounded-xl">
                        </div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-[9px] font-extrabold text-emerald-700">Pembayaran otomatis terverifikasi</span>
                        </div>
                    </div>
                </div>

                {{-- Cash Option --}}
                <div class="pay-card p-4" :class="paymentMethod === 'cash' ? 'active' : ''" @click="paymentMethod = 'cash'">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center border border-amber-200 shrink-0">
                            <i class="fa-solid fa-money-bills text-amber-700 text-base"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="font-extrabold text-zinc-900">Bayar Tunai</span>
                                <div class="w-4 h-4 rounded-full border-2 flex items-center justify-center transition"
                                     :class="paymentMethod === 'cash' ? 'border-[#721c24] bg-[#721c24]' : 'border-zinc-300'">
                                    <template x-if="paymentMethod === 'cash'">
                                        <i class="fa-solid fa-check text-white text-[7px]"></i>
                                    </template>
                                </div>
                            </div>
                            <p class="text-[10px] text-zinc-500">Bayar ke pramusaji saat makanan diantar atau di meja kasir</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        {{-- 4. TOTAL & PROSES PESANAN --}}
        <div class="s4 card p-5 space-y-4">
            <!-- Total Breakdown -->
            <div class="space-y-2 text-xs">
                <div class="flex justify-between text-zinc-500">
                    <span>Subtotal (<span x-text="orderItems.length"></span> item)</span>
                    <span class="font-bold text-zinc-800" x-text="formatRupiah(subtotal)"></span>
                </div>
                <div class="flex justify-between text-zinc-500">
                    <span>Biaya Layanan</span>
                    <span class="font-bold text-emerald-600">Gratis 🎉</span>
                </div>
                <div class="flex justify-between items-center pt-3 border-t border-zinc-100 text-sm">
                    <span class="font-extrabold text-zinc-900">Total Bayar</span>
                    <span class="font-black text-[#721c24] text-base" x-text="formatRupiah(subtotal)"></span>
                </div>
            </div>

            <!-- Process Button -->
            <button @click="processOrder()"
                    :disabled="!customerName.trim()"
                    class="cta-order w-full py-4 text-white font-extrabold text-sm flex items-center justify-center gap-2.5 border border-white/10 disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:transform-none">
                <i class="fa-solid fa-paper-plane text-amber-300"></i>
                <span x-text="customerName.trim() ? 'Kirim Pesanan ke Dapur' : 'Isi Nama Pemesan Dulu'"></span>
            </button>

            <p class="text-center text-[10px] text-zinc-400">
                Pesanan akan langsung diteruskan ke layar dapur Lapau Uda Sutan.
            </p>
        </div>

    </main>


    <script>
        function checkoutOrderSystem(meja) {
            return {
                meja,
                customerName: '',
                specialNote: '',
                paymentMethod: 'qris',

                orderItems: [
                    { id:1, name:'Rendang Daging Sapi Special', qty:1, price:24000 },
                    { id:2, name:'Teh Talua Uda Sutan',          qty:1, price:12000 },
                ],

                get subtotal() {
                    return this.orderItems.reduce((s,i) => s + i.qty * i.price, 0);
                },

                formatRupiah(n) { return 'Rp ' + (n||0).toLocaleString('id-ID'); },

                processOrder() {
                    if (!this.customerName.trim()) return;
                    const orderId = 'ORD-20260807-' + String(Math.floor(Math.random()*900)+100);
                    window.location.href = "{{ url('/order/status') }}/" + orderId +
                        "?name=" + encodeURIComponent(this.customerName) +
                        "&meja=" + this.meja +
                        "&method=" + this.paymentMethod +
                        "&total=" + this.subtotal;
                }
            }
        }
    </script>

    @livewireScripts
</body>
</html>
