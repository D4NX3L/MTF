<?php
$mensajeRegistro = "";

// Conexión a la base de datos 'mtf'
$conn = new mysqli("localhost", "root", "", "mtf");

if ($conn->connect_error) {
    die("<div class='error'>Conexión fallida: " . htmlspecialchars($conn->connect_error) . "</div>");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["nuevo_usuario"]) &&
        isset($_POST["nueva_contraseña"]) &&
        isset($_POST["fondos"])
    ) {
        $nuevoUsuario = trim($_POST["nuevo_usuario"]);
        $nuevaContraseña = trim($_POST["nueva_contraseña"]);
        $fondos = trim($_POST["fondos"]); // Se guarda tal cual lo escribió el usuario

        $verificar = $conn->prepare("SELECT id FROM usuarios WHERE nombre_de_usuario = ?");
        $verificar->bind_param("s", $nuevoUsuario);
        $verificar->execute();
        $verificar->store_result();

        if ($verificar->num_rows > 0) {
            $mensajeRegistro = "<div class='error'>El nombre de usuario ya existe.</div>";
        } else {
            $insertar = $conn->prepare("INSERT INTO usuarios (nombre_de_usuario, contraseña, fondos) VALUES (?, ?, ?)");
            $insertar->bind_param("sss", $nuevoUsuario, $nuevaContraseña, $fondos);

            if ($insertar->execute()) {
                $mensajeRegistro = "<div class='success'>Registro exitoso. Ahora puedes iniciar sesión.</div>";
            } else {
                $mensajeRegistro = "<div class='error'>Error al registrar el usuario.</div>";
            }

            $insertar->close();
        }

        $verificar->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MTF - Registrarse</title>
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

        .top-right-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .top-right-button a {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #00ffff;
            color: #000;
            font-weight: bold;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.6);
            transition: 0.3s;
        }

        .top-right-button a:hover {
            background-color: #00cccc;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.9);
            transform: scale(1.05);
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
    <!-- Botón fuera del recuadro en la parte superior derecha -->
    <div class="top-right-button">
        <a href="http://localhost/mtf/mtf.php">Ir a Iniciar Sesión</a>
    </div>

    <!-- Encabezado con animaciones -->
    <div class="titulo-container">
        <div class="lineas"></div>
        <div class="titulo">MTF</div>
        <div class="fin-icon dolar">$</div>
        <div class="fin-icon flecha">📈</div>
        <div class="fin-icon grafico">📊</div>
    </div>

    <!-- Recuadro de Registro -->
    <div class="container">
        <h2>Registrarse</h2>
        <form method="POST">
            <label>Nuevo usuario:</label><br>
            <input type="text" name="nuevo_usuario" required><br>
            <label>Contraseña:</label><br>
            <input type="password" name="nueva_contraseña" required><br>
            <label>Fondos (COP):</label><br>
            <input type="text" name="fondos" required placeholder="Ej: 12.000,50 o 12000.50"><br>
            <button type="submit">Registrar</button>
        </form>
        <?php if (!empty($mensajeRegistro)) echo $mensajeRegistro; ?>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <img src="https://img.icons8.com/fluency/96/money-bag.png" alt="Ahorro e inversión">
        <div class="frase">"Ahorra hoy, invierte mañana, prospera siempre."</div>
    </div>
</body>
</html>
