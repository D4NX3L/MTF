<html>
    <?php
session_start();
?>

<html>
<head>
<link rel="icon" href="/mtf/MTF.png" type="imagen/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTF</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow: hidden;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background-color: #1e1e1e;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .logo {
            font-size: 60px;
            font-weight: bold;
            text-shadow: 0 0 10px #00e5ff;
            animation: blink 2s infinite;
            cursor: pointer;
            position: absolute;
            bottom: 10px;
            left: 20px;
        }

        .center-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex: 1;
            margin-left: 40px;
        }

        .right-buttons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            align-items: center;
        }

        .header button {
            background-color: #121212;
            color: #00e5ff;
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s, color 0.2s;
        }

        .header button:hover {
            background-color: #00e5ff;
            color: #121212;
            transform: scale(1.1);
        }

        .username {
            font-size: 16px;
            color: #00e5ff;
            font-weight: bold;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
            padding: 40px;
            flex-wrap: wrap;
            flex: 1;
        }

        .video-container video {
            width: 100%;
            max-width: 640px;
            height: auto;
            border-radius: 8px;
        }

        .text-container {
            max-width: 400px;
        }

        .text-container h2, .text-container p {
            color: #ffffff;
        }

        .cta button {
            background-color: #00e5ff;
            border: none;
            color: #121212;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s;
            margin-top: 10px;
        }

        .cta button:hover {
            background-color: #00bcd4;
            transform: scale(1.1);
        }

        .footer {
            background-color: #1e1e1e;
            padding: 10px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .footer button {
            background-color: #00e5ff;
            border: none;
            color: #121212;
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .footer button:hover {
            background-color: #00bcd4;
        }

        #transition-overlay {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 100px;
            height: 100px;
            background-color: #00e5ff;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            z-index: 9999;
            pointer-events: none;
        }

        #transition-overlay.animate {
            animation: expandCircle 1s forwards;
        }

        @keyframes expandCircle {
            0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
            80% { transform: translate(-50%, -50%) scale(20); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(50); opacity: 0; }
        }
    </style>
</head>
<body>

    <div id="transition-overlay"></div>

    <div class="header">
        <div class="center-buttons">
            <button onclick="navigate('inicio.html')">Misión y Visión</button>
            <button onclick="navigate('ideas.html')">Ideas y Metas</button>
            <button onclick="navigate('recomendaciones.html')">Recomendaciones</button>
            <button onclick="navigate('estrategia.html')">Estrategia MTF</button>
        </div>
        <div class="right-buttons">
            <?php if (isset($_SESSION['nombre'])): ?>
                <span class="username">Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
            <?php else: ?>
                <button onclick="navigate('mtf.php')">Iniciar Sesión</button>
                <button onclick="navigate('registro.php')">Registrarse</button>
            <?php endif; ?>
        </div>
        <div class="logo" onclick="location.reload()">MTF</div>
    </div>

    <div class="container">
        <div class="video-container">
            <video autoplay muted loop>
                <source src="31772-388253161_small.mp4" type="video/mp4">
                Tu navegador no soporta la etiqueta de video.
            </video>
        </div>
        <div class="text-container">
            <h2>El Dinero sí Cae de los Árboles... Pero si no lo Riegas Bien se Seca y se lo Lleva el Viento</h2>
            <p>Estamos enfocados en administrar, completar y dirigir tus metas, objetivos y ahorros con el fin de tener el mejor monitoreo posible de nuestras finanzas.</p>
            <div class="cta">
                <button onclick="navigate('introduccion.html')">Conocer más</button>
            </div>
        </div>
    </div>

    <div class="footer">
        <button>Contacto</button> 
        <button>Términos</button>
        <button>Privacidad</button>
    </div>

    <script>
        function navigate(url) {
            const overlay = document.getElementById('transition-overlay');
            overlay.classList.add('animate');
            overlay.style.pointerEvents = 'auto';
            setTimeout(() => {
                window.location.href = url;
            }, 1000);
        }
    </script>

</body>
</html>
</html>

















