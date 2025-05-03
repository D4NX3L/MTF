<?php
$usuario = null;
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
        } else {
            $mensaje = "<div class='error'>Usuario o contraseña incorrectos.</div>";
        }

        $stmt->close();
    }
}

$conn->close();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>MTF - Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #0a0a0a, #111);
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 60px;
            margin: 0;
            overflow-x: hidden;
        }
        .titulo-container {
            position: relative;
            margin-bottom: 50px;
        }
        .titulo {
            font-size: 60px;
            font-weight: bold;
            color: #00ffff;
            animation: pulso 2s infinite ease-in-out;
            text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff88;
        }
        @keyframes pulso {
            0%, 100% {
                text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff88;
                color: #00ffff;
            }
            50% {
                text-shadow: 0 0 25px #00ffff, 0 0 40px #00ffffaa;
                color: #ccffff;
            }
        }
        .fin-icon {
            position: absolute;
            font-size: 24px;
            color: #00ffff;
            animation: flotar 3s ease-in-out infinite;
        }
        .fin-icon.dolar {
            left: -40px;
            top: -10px;
        }
        .fin-icon.flecha {
            right: -40px;
            top: -10px;
        }
        .fin-icon.grafico {
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            font-size: 16px;
        }
        @keyframes flotar {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        .lineas {
            position: absolute;
            top: 80px;
            width: 100vw;
            height: 80px;
            background: repeating-linear-gradient(
                to right,
                transparent,
                transparent 30px,
                rgba(0,255,255,0.05) 31px,
                rgba(0,255,255,0.05) 32px
            );
        }
        .container {
            background-color: #111;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.2);
            width: 350px;
            margin-bottom: 30px;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.4);
        }
        h2 {
            color: #00ffff;
            margin-bottom: 20px;
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
            box-shadow: 0 0 10px #00ffff;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #00ffff;
            color: #000;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.6);
        }
        button:hover {
            background-color: #00cccc;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.9);
            transform: scale(1.05);
        }
        .error, .success {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
        .success {
            color: limegreen;
        }
        .result {
            margin-top: 20px;
            background: #111;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
            width: 350px;
            text-align: left;
            color: white;
        }
        .result h3 {
            color: #00ffff;
        }
        .result p strong {
            color: #00ffff;
        }
        .footer {
            margin-top: 60px;
            padding: 30px;
            text-align: center;
            background: #111;
            color: #00ffff;
            box-shadow: 0 0 20px rgba(0,255,255,0.1);
            width: 100%;
        }
        .footer img {
            width: 100px;
            margin: 10px auto;
            display: block;
            filter: drop-shadow(0 0 5px cyan);
        }
        .footer .frase {
            font-style: italic;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="titulo-container">
        <div class="lineas"></div>
        <div class="titulo">MTF</div>
        <div class="fin-icon dolar">$</div>
        <div class="fin-icon flecha">📈</div>
        <div class="fin-icon grafico">📊</div>
    </div>

    <div class="container">
        <h2>Iniciar sesión</h2>
        <form method="POST">
            <label>Nombre de usuario:</label><br>
            <input type="text" name="nombre_de_usuario" required><br>
            <label>Contraseña:</label><br>
            <input type="password" name="contraseña" required><br>
            <button type="submit">Ingresar</button>
        </form>
    </div>

    <?php if (!empty($mensaje)) echo $mensaje; ?>

    <?php if ($usuario): ?>
        <div class="result">
            <h3>Bienvenido, <?= htmlspecialchars($usuario["nombre_de_usuario"]) ?>!</h3>
            <p><strong>Fondos disponibles:</strong> $<?= htmlspecialchars($usuario["fondos"]) ?> COP</p>
        </div>
    <?php endif; ?>

    <div class="footer">
        <img src="https://img.icons8.com/fluency/96/money-bag.png" alt="Ahorro e inversión">
        <div class="frase">"Ahorra hoy, invierte mañana, prospera siempre."</div>
    </div>
</body>
</html>
