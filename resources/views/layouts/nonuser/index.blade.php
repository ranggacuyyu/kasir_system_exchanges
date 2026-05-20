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
