<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: mtf.php");
    exit();
}

$usuario = $_SESSION["usuario"];
$nombre_usuario = $usuario["nombre_de_usuario"];
$fondos_usuario = $usuario["fondos"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MTF - Bienvenida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #000010, #001f1f, #000010);
            background-size: 400% 400%;
            animation: fondoAnimado 20s ease infinite;
            color: white;
            overflow: hidden;
            position: relative;
        }

        @keyframes fondoAnimado {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .background-graph {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        svg {
            width: 100%;
            height: 100%;
        }

        /* Líneas de fondo con el mismo color de las letras (cian #00ffff) */
        .line {
            fill: none;
            stroke: #00ffff;  /* Mismo color cian que el de las letras */
            stroke-width: 3;  /* Aumento del grosor de la línea */
            stroke-linejoin: round;
            stroke-linecap: round;
            opacity: 0.8;  /* Mayor opacidad para hacer las líneas más visibles */
            animation: move 20s linear infinite;
            marker-end: url(#flecha); /* Agregar flecha al final de las líneas */
        }

        .line.alt {
            stroke: #00ffff;  /* Mismo color cian que el de las letras */
            opacity: 0.8;
            stroke-dasharray: 6,4;
            animation-duration: 25s;
            marker-end: url(#flecha);
        }

        /* Línea intermitente de tendencia bajista (color rojo) */
        .line.extra {
            stroke: #ff0000;  /* Color rojo para tendencia bajista */
            opacity: 0.8;
            stroke-dasharray: 3,6;
            animation-duration: 30s;
            marker-end: url(#flecha);
        }

        @keyframes move {
            from { transform: translateX(0); }
            to { transform: translateX(-200px); }
        }

        .titulo-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            text-align: center;
            padding: 20px 0;
            background: rgba(0, 0, 0, 0.85);
            z-index: 5;
        }

        .titulo {
            font-size: 48px;
            font-weight: bold;
            color: #00ffff;
            animation: pulso 2s infinite ease-in-out;
            text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff88;
        }

        @keyframes pulso {
            0%, 100% { text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff88; color: #00ffff; }
            50% { text-shadow: 0 0 25px #00ffff, 0 0 40px #00ffffaa; color: #ccffff; }
        }

        .fin-icon {
            position: absolute;
            font-size: 32px;
            color: #00ffff;
            animation: flotar 4s ease-in-out infinite;
            z-index: 1;
        }

        .fin-icon.dolar { top: 12%; left: 5%; animation-delay: 0s; }
        .fin-icon.flecha { top: 10%; right: 6%; animation-delay: 1s; }
        .fin-icon.grafico { bottom: 22%; left: 20%; animation-delay: 2s; }
        .fin-icon.euro { bottom: 16%; right: 20%; animation-delay: 3s; }
        .fin-icon.billetera { top: 50%; left: 3%; animation-delay: 4s; }
        .fin-icon.dolar-sign { bottom: 35%; right: 12%; animation-delay: 2.5s; }

        @keyframes flotar {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .contenido {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 2;
            text-align: center;
            margin-top: 130px;
        }

        h2 {
            font-size: 32px;
            color: #00ffff;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .resultado {
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #00ffff;
            background-color: rgba(0, 0, 0, 0.4);
            padding: 15px 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
        }

        .btn-cerrar-sesion {
            background-color: #ff4d4d;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 40px;
            box-shadow: 0 0 20px rgba(255, 77, 77, 0.7);
        }

        .btn-cerrar-sesion:hover {
            background-color: #ff1a1a;
            box-shadow: 0 0 30px rgba(255, 77, 77, 1);
            transform: scale(1.1);
        }

        .footer {
            margin-top: 60px;
            padding: 20px;
            text-align: center;
            background: #111;
            color: #00ffff;
            box-shadow: 0 0 20px rgba(0,255,255,0.1);
            width: 100%;
            position: relative;
        }

        .footer img {
            width: 100px;
            margin: 10px auto;
            display: block;
            filter: drop-shadow(0 0 5px cyan);
            animation: moverse 2s ease-in-out infinite;
        }

        .footer .frase {
            font-style: italic;
            margin-top: 10px;
        }

        @keyframes moverse {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <!-- Fondo con líneas de mercado financiero -->
    <div class="background-graph">
        <svg viewBox="0 0 1000 500" preserveAspectRatio="none">
            <defs>
                <!-- Definir las flechas -->
                <marker id="flecha" viewBox="0 0 10 10" refX="5" refY="5" orient="auto">
                    <path d="M 0 0 L 10 5 L 0 10 z" fill="#00ffff" />
                </marker>
            </defs>
            <polyline class="line" points="0,300 100,250 200,280 300,200 400,220 500,180 600,210 700,160 800,190 900,150 1000,170" />
            <polyline class="line alt" points="0,320 100,270 200,300 300,220 400,240 500,200 600,230 700,180 800,210 900,170 1000,190" />
            <polyline class="line" points="0,400 100,380 200,420 300,370 400,400 500,360 600,390 700,340 800,370 900,330 1000,350" />
            <polyline class="line extra" points="0,250 100,200 200,230 300,180 400,200 500,170 600,200 700,150 800,180 900,140 1000,160" />
        </svg>
    </div>

    <!-- Encabezado fijo -->
    <div class="titulo-container">
        <div class="titulo">MTF</div>
    </div>

    <!-- Íconos flotantes -->
    <div class="fin-icon dolar">💰</div>
    <div class="fin-icon flecha">📈</div>
    <div class="fin-icon grafico">📊</div>
    <div class="fin-icon euro">€</div>
    <div class="fin-icon billetera">💼</div>
    <div class="fin-icon dolar-sign">$</div>

    <!-- Contenido principal -->
    <div class="contenido">
        <h2>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?>!</h2>
        <div class="resultado">
            Fondos disponibles: <?php echo htmlspecialchars($fondos_usuario); ?> <strong>COP</strong>
        </div>
        <button class="btn-cerrar-sesion" onclick="window.location.href='mtf.php'">Cerrar sesión</button>
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="https://img.icons8.com/fluency/96/money-bag.png" alt="Ahorro e inversión">
        <div class="frase">"Ahorra hoy, invierte mañana, prospera siempre."</div>
    </div>
</body>
</html>

















