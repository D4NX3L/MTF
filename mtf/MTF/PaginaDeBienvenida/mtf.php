<?php
session_start();

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

        // Consulta a la base de datos
        $stmt = $conn->prepare("SELECT nombre_de_usuario, fondos FROM usuarios WHERE nombre_de_usuario = ? AND contraseña = ?");
        $stmt->bind_param("ss", $nombre, $contraseña);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Si el usuario es válido, lo guardamos en la sesión
            $usuario = $resultado->fetch_assoc();
            $_SESSION["usuario"] = $usuario; // Guardamos el usuario en la sesión

            // Redirigimos a la página de bienvenida
            header("Location: bienvenida.php");
            exit(); // Importante: evitar que el resto del código se ejecute
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
            background: #000000;
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

       
        .background-detail {
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(0, 255, 255, 0.1) 0%, rgba(0, 0, 0, 0.5) 100%);
            background-size: 100% 100%;
            animation: move-bg 10s linear infinite;
            z-index: 1;
        }

       
        .symbol {
            position: absolute;
            font-size: 40px;
            color: rgba(0, 255, 255, 0.5);
            animation: floating-symbols 10s infinite linear;
        }

       
        @keyframes floating-symbols {
            0% { opacity: 1; transform: translateY(-10px); }
            50% { opacity: 0.5; transform: translateY(10px); }
            100% { opacity: 1; transform: translateY(-10px); }
        }

        
        @keyframes move-bg {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 100% 100%;
            }
        }

        .titulo-container {
            position: relative;
            margin-bottom: 50px;
            z-index: 2;
        }

        .titulo {
            font-size: 60px;
            font-weight: bold;
            color: #00ffff;
            animation: pulso 2s infinite ease-in-out;
            text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff88;
            position: relative;
            z-index: 3;
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
            font-size: 40px;
            color: #00ffff;
            animation: flotar 3s ease-in-out infinite;
        }

        /* Iconos a la izquierda */
        .fin-icon.dolar {
            top: 10%;
            left: 5%;
        }

        .fin-icon.flecha {
            top: 20%;
            left: 10%;
        }

        .fin-icon.grafico {
            top: 35%;
            left: 15%;
        }

        .fin-icon.moneda {
            bottom: 10%;
            right: 5%;
            font-size: 35px;
        }

        .fin-icon.grafico2 {
            bottom: 20%;
            right: 10%;
        }

        @keyframes flotar {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
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
            z-index: 5;
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

       
        @media (max-width: 768px) {
            .titulo {
                font-size: 40px;
            }

            .container {
                width: 90%;
            }
        }

        @media (max-width: 480px) {
            .titulo {
                font-size: 30px;
            }

            .container {
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
   
    <div class="background-detail"></div>
    
    <div class="titulo-container">
        <div class="titulo">MTF</div>
    </div>

    <div class="fin-icon dolar">💵</div>
    <div class="fin-icon flecha">📈</div>
    <div class="fin-icon grafico">📊</div>
    <div class="fin-icon moneda">💰</div>
    <div class="fin-icon grafico2">📉</div>

    <div class="container">
        <h2>Iniciar sesión</h2>
        <form method="POST">
            <label>Nombre de usuario:</label><br>
            <input type="text" name="nombre_de_usuario" required><br>
            <label>Contraseña:</label><br>
            <input type="password" name="contraseña" required><br>
            <button type="submit">Ingresar</button>
        </form>
        <?php if ($mensaje) echo $mensaje; ?>
    </div>
</body>
</html>













