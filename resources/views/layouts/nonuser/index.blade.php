<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Sistem Toko</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-linear-color overflow-hidden">

    {{-- PARTICLE LAYER --}}
    {{-- <div
        wire:ignore
        x-data="particleField()"
        x-init="init()"
        class="fixed inset-0 overflow-hidden z-0">

        <template x-for="p in particles" :key="p.id">
            <div
                class="absolute rounded-full bg-white/60 "
                :style="particleStyle(p)">
            </div>
        </template>
    </div> --}}

    {{-- CONTENT LAYER --}}
    <div class="relative z-10">
        <livewire:auth.login />
    </div>

    @livewireScripts

   {{--  <script>
        function particleField() {
            return {
                particles: [],

                init() {
                    this.generateParticles(20);
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
    </script> --}}

</body>

</html>
