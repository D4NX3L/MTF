<?php
session_start();

$mensaje = "";

$conn = new mysqli("localhost", "root", "", "mtf");

if ($conn->connect_error) {
    die("<div class='error'>Conexión fallida: " . htmlspecialchars($conn->connect_error) . "</div>");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["nombre_de_usuario"]) && isset($_POST["contraseña"])) {
        $nombre = trim($_POST["nombre_de_usuario"]);
        $contraseña = trim($_POST["contraseña"]);

        $stmt = $conn->prepare("SELECT nombre_de_usuario, fondos FROM usuarios WHERE nombre_de_usuario = ? AND contraseña = ?");
        $stmt->bind_param("ss", $nombre, $contraseña);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            $_SESSION["usuario"] = $usuario;

            header("Location: http://localhost/mtf/usuario.php");
            exit();
        } else {
            $mensaje = "<div class='error'>Usuario o contraseña incorrectos.</div>";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" href="/mtf/MTF.png" type="imagen/png">
<meta charset="UTF-8" />
<title>MTF - Iniciar Sesión</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
    /* body y los contenedores */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #000000;
        color: #ffffff;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        overflow: hidden;
    }

    /* formilario central */
    .container {
        max-width: 360px;
        margin: 80px auto 80px;
        background: rgba(255,255,255,0.05);
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 0 15px rgba(0,255,255,0.2);
        position: relative;
        z-index: 10;
    }

    .container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #00e5ff;
    }

    label {
        display: block;
        margin-top: 15px;
        color: #ffffff;
        font-weight: 600;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-top: 8px;
        border: none;
        border-radius: 8px;
        background: #1c2333;
        color: #00e5ff;
        font-size: 16px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 12px;
        margin-top: 20px;
        border: none;
        border-radius: 8px;
        background-color: #00e5ff;
        color: #121212;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
        background-color: #00bcd4;
        transform: scale(1.05);
    }

    .error {
        color: #ff4c4c;
        text-align: center;
        margin-top: 15px;
        font-weight: bold;
    }

    /* lineas y animacion del fondo */
    svg.background-lines {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 200px;
        pointer-events: none;
        z-index: 5;
    }

    path.line {
        fill: none;
        stroke: #00e5ff;
        stroke-width: 2;
        stroke-dasharray: 600;
        animation: dashmove 8s linear infinite;
    }

    path.line:nth-child(2) {
        stroke-width: 1.5;
        stroke: #00bcd4;
        animation-duration: 12s;
        stroke-dasharray: 400;
    }

    @keyframes dashmove {
        0% {
            stroke-dashoffset: 600;
        }
        100% {
            stroke-dashoffset: 0;
        }
    }

    /* iconos flotantes */
    .fin-icon {
        position: fixed;
        font-size: 28px;
        color: #00e5ff;
        animation: floaty 3s ease-in-out infinite alternate;
        user-select: none;
        z-index: 6;
    }

    .dolar { top: 90px; left: 30px; animation-delay: 0s; }
    .flecha { top: 130px; left: 90px; animation-delay: 0.7s; }
    .grafico { top: 100px; right: 50px; animation-delay: 1.4s; }
    .moneda { bottom: 150px; left: 60px; animation-delay: 2.1s; }
    .grafico2 { bottom: 100px; right: 70px; animation-delay: 2.8s; }

    @keyframes floaty {
        0% { transform: translateY(0); }
        100% { transform: translateY(-15px); }
    }
</style>
</head>
<body>

    <div class="container">
        <h2>Iniciar sesión</h2>
        <form method="POST">
            <label>Nombre de usuario:</label>
            <input type="text" name="nombre_de_usuario" required>

            <label>Contraseña:</label>
            <input type="password" name="contraseña" required>
            <button type="submit">Ingresar</button>
            <button type="button" onclick="history.back()">Regresar</button>
        </form>
        <?php if ($mensaje) echo $mensaje; ?>
    </div>

    <!-- Íconos financieros flotantes -->
    <div class="fin-icon dolar">💵</div>
    <div class="fin-icon flecha">📈</div>
    <div class="fin-icon grafico">📊</div>
    <div class="fin-icon moneda">💰</div>
    <div class="fin-icon grafico2">📉</div>

    <!--lineas animadas en fondo inferior -->
    <svg class="background-lines" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path class="line" d="M0,200 C200,100 400,300 600,200 S1000,150 1440,250" />
        <path class="line" d="M0,250 C300,150 500,350 800,250 S1200,200 1440,300" />
    </svg>

</body>
</html>













