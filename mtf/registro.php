<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="/mtf/MTF.png" type="imagen/png">
    <meta charset="UTF-8">
    <title>MTF - Registrarse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --mtf-azul: #00ffff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            overflow: hidden;
            background-color: #000;
            color: #f1f1f1;
        }

        canvas {
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .top-right-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .top-right-button a {
            text-decoration: none;
            padding: 10px 15px;
            background-color: var(--mtf-azul);
            color: #000;
            font-weight: bold;
            border-radius: 5px;
            box-shadow: 0 0 10px var(--mtf-azul);
            transition: 0.3s;
        }

        .top-right-button a:hover {
            background-color: #00cccc;
            box-shadow: 0 0 15px var(--mtf-azul);
            transform: scale(1.05);
        }

        .titulo {
            font-size: 64px;
            font-weight: bold;
            color: var(--mtf-azul);
            text-shadow: 0 0 12px var(--mtf-azul), 0 0 24px #00ffffaa;
            animation: parpadeo 3s infinite ease-in-out;
            text-align: center;
            margin-top: 80px;
        }

        @keyframes parpadeo {
            0%, 100% {
                opacity: 1;
                text-shadow: 0 0 12px var(--mtf-azul), 0 0 24px #00ffffaa;
            }
            50% {
                opacity: 0.85;
                text-shadow: 0 0 20px var(--mtf-azul), 0 0 40px #00ffffcc;
            }
        }

        .container {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.15);
            width: 350px;
            margin: 30px auto 0 auto; /* Subido más cerca del título */
            backdrop-filter: blur(5px);
        }

        .container:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 35px rgba(0, 255, 255, 0.25);
        }

        h2 {
            color: var(--mtf-azul);
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
            color: white;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background: #222;
            color: white;
            text-align: center;
            box-shadow: inset 0 0 5px rgba(0, 255, 255, 0.3);
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 10px var(--mtf-azul);
        }

        .botones {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 15px;
        }

        .botones button {
            width: 48%;
            padding: 10px;
            border: none;
            background-color: var(--mtf-azul);
            color: #000;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.6);
        }

        .botones button:hover {
            background-color: #00cccc;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.9);
            transform: scale(1.05);
        }

        .error, .success {
            font-weight: bold;
            margin-top: 10px;
            text-align: center;
        }

        .error {
            color: #ff4f4f;
        }

        .success {
            color: #4fff91;
        }
    </style>
</head>
<body>
    <canvas id="snow"></canvas>

    <!-- Botón arriba a la derecha -->
    <div class="top-right-button">
        <a href="http://localhost/mtf/mtf.php">Ir a Iniciar Sesión</a>
    </div>

    <!-- Título -->
    <div class="titulo">MTF</div>

    <!-- Formulario de Registro -->
    <div class="container">
        <h2>Registrarse</h2>
        <form method="POST">
            <label>Nuevo usuario:</label><br>
            <input type="text" name="nuevo_usuario" required><br>
            <label>Contraseña:</label><br>
            <input type="password" name="nueva_contraseña" required><br>
            <label>Fondos (COP):</label><br>
            <input type="text" name="fondos" required placeholder="Ej: 12000.50"><br>

            <!-- Botones lado a lado -->
            <div class="botones">
                <button type="submit">Registrar</button>
                <button type="button" onclick="history.back()">Regresar</button>
            </div>
        </form>
        <?php if (!empty($mensajeRegistro)) echo $mensajeRegistro; ?>
    </div>

    <!-- Efecto de nieve -->
    <script>
        const canvas = document.getElementById('snow');
        const ctx = canvas.getContext('2d');

        let width, height;
        function resize() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resize);
        resize();

        const numFlakes = 150;
        const flakes = [];

        for (let i = 0; i < numFlakes; i++) {
            flakes.push({
                x: Math.random() * width,
                y: Math.random() * height,
                r: Math.random() * 3 + 1,
                d: Math.random() + 1
            });
        }

        function drawFlakes() {
            ctx.clearRect(0, 0, width, height);
            ctx.fillStyle = "#00ffffaa";
            ctx.beginPath();
            for (let i = 0; i < numFlakes; i++) {
                let f = flakes[i];
                ctx.moveTo(f.x, f.y);
                ctx.arc(f.x, f.y, f.r, 0, Math.PI * 2, true);
            }
            ctx.fill();
            moveFlakes();
        }

        let angle = 0;
        function moveFlakes() {
            angle += 0.01;
            for (let i = 0; i < numFlakes; i++) {
                let f = flakes[i];
                f.y += Math.pow(f.d, 2) + 1;
                f.x += Math.sin(angle) * 2;

                if (f.y > height) {
                    f.y = 0;
                    f.x = Math.random() * width;
                }
            }
        }

        setInterval(drawFlakes, 33);
    </script>
</body>
</html>

