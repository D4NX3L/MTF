<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Guía de Estrategia Financiera</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #121212;
      color: #ffffff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-image: url('background.jpg');
      background-size: cover;
      background-position: center;
      overflow-x: hidden;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #1e1e1e;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
    }

    .logo {
      font-size: 60px;
      font-weight: bold;
      text-shadow: 0 0 10px #00e5ff;
      animation: blink 2s infinite;
      cursor: pointer;
    }

    .center-buttons {
      display: flex;
      gap: 10px;
      justify-content: center;
      flex: 1;
      margin-left: 20px;
    }

    .right-buttons {
      display: flex;
      gap: 10px;
    }

    .header button, .herramienta button, .footer button {
      background-color: #121212;
      color: #00e5ff;
      border-radius: 10px;
      padding: 10px 15px;
      font-size: 14px;
      cursor: pointer;
      transition: transform 0.2s, background-color 0.2s, color 0.2s;
    }

    .header button:hover, .herramienta button:hover, .footer button:hover {
      background-color: #00e5ff;
      color: #121212;
      transform: scale(1.1);
    }

    @keyframes blink {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }

    h1, h2 {
      color: #00f0ff;
      text-align: center;
    }

    .section {
      background-color: #001f26;
      padding: 20px;
      border-radius: 10px;
      margin: 20px auto;
      max-width: 800px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .section h2 {
      border-bottom: 1px solid #00f0ff;
      padding-bottom: 5px;
      margin-bottom: 10px;
    }

    a {
      color: #00f0ff;
      text-decoration: underline;
    }

    .herramienta {
      text-align: center;
      margin: 20px auto;
    }

    .footer {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 20px;
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
    <div class="logo" onclick="navigate('bienvenida.html')">MTF</div>
    <div class="center-buttons">
      <button onclick="navigate('proyecto.html')">Proyecto Principal</button>
      <button onclick="navigate('ideas.html')">Ideas y Metas</button>
      <button onclick="navigate('recomendaciones.html')">Recomendaciones</button>
      <button onclick="navigate('estrategia.html')">Estrategia MTF</button>
    </div>
    <div class="right-buttons">
      <button onclick="navigate('login.html')">Iniciar Sesión</button>
      <button onclick="navigate('registro.html')">Registrarse</button>
    </div>
  </div>

  <h1> Estrategia de Meta Financiera</h1>

  <div class="section">
    <h2>¿Como funciona la Estrategia de Meta Financiera?</h2>
    <p>
      Es un método integral para <strong>tomar el control de tus finanzas</strong> mediante la planificación, registro y seguimiento de tus actividades económicas a lo largo del tiempo. Esta estrategia te ayuda a identificar oportunidades de ahorro, realizar inversiones inteligentes y alcanzar metas personales o familiares.
    </p>
  </div>

  <div class="section">
    <h2>1. Monitoreo de Finanzas</h2>
    <p>
      Mantener un registro detallado de cada movimiento financiero (ingresos y gastos) te permite <strong>ver patrones de comportamiento</strong>, evitar fugas de dinero y tomar decisiones más informadas. La herramienta muestra tus movimientos recientes junto con gráficos que facilitan la visualización.
    </p>
  </div>

  <div class="section">
    <h2>2. Administración del Dinero</h2>
    <p>
      Al organizar tus finanzas en categorías como <strong>movimientos, inversiones, metas y ahorros</strong>, puedes administrar cada área con mayor eficacia. Estableces prioridades y distribuyes tu capital de forma equilibrada, lo que es clave para una salud financiera sostenible.
    </p>
  </div>

  <div class="section">
    <h2>3. Ahorro Planificado</h2>
    <p>
      Ahorrar no se trata solo de guardar lo que sobra, sino de <strong>asignar una parte de tus ingresos para objetivos futuros</strong>. Esta plataforma permite registrar tus ahorros y ver cómo progresan en el tiempo. Ahorrar te prepara para emergencias y te acerca a tus sueños.
    </p>
  </div>

  <div class="section">
    <h2>4. Inversión Estratégica</h2>
    <p>
      Registrar tus inversiones te ayuda a hacer seguimiento de tu dinero en movimiento. Saber cuánto has invertido, dónde y qué retorno esperas, te da <strong>mayor control sobre tu crecimiento financiero</strong>. Todo queda organizado para futuras evaluaciones.
    </p>
  </div>

  <div class="section">
    <h2>5. Establecimiento de Metas</h2>
    <p>
      Las metas financieras te dan dirección y motivación. Puedes establecer objetivos como comprar una casa, pagar estudios o realizar un viaje. La herramienta te permite <strong>ver tu progreso hacia cada meta</strong> y ajustar tu presupuesto para alcanzarlas más rápido.
    </p>
  </div>

  <div class="section">
    <h2>¿Cómo te ayuda esta plataforma?</h2>
    <p>
      Con esta plataforma puedes llevar un <strong>control visual y práctico</strong> de tus finanzas. Te da estructura, claridad y motivación para actuar. Puedes volver a la app principal desde <a href="index.html">aquí</a>.
    </p>
  </div>

  <div class="herramienta">
    <button onclick="navigate('estrategia.html')">Utilizar herramienta</button>
  </div>

  <div class="footer">
    <button onclick="navigate('bienvenida.html')">Volver</button>
    <button onclick="navigate('registro.html')">Registrate ya</button>
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
