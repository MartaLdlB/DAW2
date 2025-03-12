<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de Días</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
      body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .titulo{
            color:rgb(255, 255, 255);
            text-align: center;
            font-size: 30px;
            margin-top: 20px;
        }
        header, footer {
            background-color: #6a0dad;
            color: #fff;
            text-align: center;
            padding: 15px 20px;
            width: 100%;
            position: fixed;
            left: 0;
        }
        header {
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-buttons {
            display: flex;
            gap: 10px;
        }
        footer {
            bottom: 0;
        }
        .container {
            max-width: 800px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 100px auto 60px;
            text-align: center;
        }
        h1, h2 {
            color: #6a0dad;
        }
        .clock {
            font-size: 48px;
            color: #6a0dad;
            text-align: center;
            margin-top: 20px;
        }
        #cuentaRegresiva {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: #6a0dad;
        }
    </style>
</head>
<body>
    <header>
        <h1 id="titulo">Contador de Días</h1>
        <div class="header-buttons">
            <a href="login.php" class="btn btn-primary">Login</a>
        </div>
    </header>

    <div class="clock" id="clock"></div>

    <div class="container">
        <h1>Bienvenido, <?php echo $_SESSION['user']; ?>!</h1>

        <h2>Cuenta regresiva para una hora específica</h2>
        <input type="time" id="horaObjetivo" class="form-control">
        <button class="btn btn-success mt-2" onclick="iniciarCuentaRegresiva()">Iniciar Cuenta Regresiva</button>
        <p id="cuentaRegresiva"></p>

        <h1>Contador de Días para un Evento</h1>
        <input type="text" id="nombreEvento" class="form-control" placeholder="Nombre del evento">
        <input type="date" id="fechaEvento" class="form-control mt-2">
        <button class="btn btn-success mt-2" onclick="calcularDias()">Calcular</button>
        <button class="btn btn-warning mt-2" onclick="guardarEvento()">Guardar Evento</button>
        <p id="resultado"></p>

        <h2>Eventos Guardados</h2>
        <ul id="eventosGuardados" class="list-group"></ul>
    </div>

    <footer>
        <p>&copy; 2025 Contador de Días. Todos los derechos reservados.</p>
    </footer>

    <script>
        function actualizarReloj() {
            const reloj = document.getElementById('clock');
            const ahora = new Date();
            const horas = String(ahora.getHours()).padStart(2, '0');
            const minutos = String(ahora.getMinutes()).padStart(2, '0');
            const segundos = String(ahora.getSeconds()).padStart(2, '0');
            reloj.textContent = `${horas}:${minutos}:${segundos}`;
        }
        setInterval(actualizarReloj, 1000);

        function iniciarCuentaRegresiva() {
            let horaInput = document.getElementById('horaObjetivo').value;
            if (!horaInput) {
                document.getElementById('cuentaRegresiva').innerText = "Por favor, ingresa una hora válida.";
                return;
            }

            let ahora = new Date();
            let [h, m] = horaInput.split(':').map(Number);

            let horaObjetivo = new Date();
            horaObjetivo.setHours(h, m, 0, 0);

            let diferencia = horaObjetivo - ahora;

            if (diferencia <= 0) {
                document.getElementById('cuentaRegresiva').innerText = "La hora ya ha pasado.";
                return;
            }

            function actualizarCuentaRegresiva() {
                let ahora = new Date();
                let diferencia = horaObjetivo - ahora;

                if (diferencia <= 0) {
                    document.getElementById('cuentaRegresiva').innerText = "¡La hora ha llegado!";
                    clearInterval(intervalo);
                    return;
                }

                let horas = Math.floor(diferencia / (1000 * 60 * 60));
                let minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
                let segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

                document.getElementById('cuentaRegresiva').innerText = 
                    `Faltan ${horas}h ${minutos}m ${segundos}s para la hora seleccionada.`;
            }

            actualizarCuentaRegresiva();
            let intervalo = setInterval(actualizarCuentaRegresiva, 1000);
        }

        function calcularDias() {
            let fechaInput = document.getElementById('fechaEvento').value;
            if (!fechaInput) {
                document.getElementById('resultado').innerText = "Por favor, selecciona una fecha.";
                return;
            }
            let fechaEvento = new Date(fechaInput);
            let fechaHoy = new Date();

            let diferencia = fechaEvento - fechaHoy;
            let diasFaltantes = Math.ceil(diferencia / (1000 * 60 * 60 * 24));

            document.getElementById('resultado').innerText = diasFaltantes >= 0 
                ? `Faltan ${diasFaltantes} días.` 
                : "El evento ya pasó.";
        }

        function guardarEvento() {
            let nombre = document.getElementById('nombreEvento').value;
            let fecha = document.getElementById('fechaEvento').value;
            if (!nombre || !fecha) return;

            let eventos = JSON.parse(localStorage.getItem('eventosGuardados')) || [];
            eventos.push({ nombre, fecha });
            localStorage.setItem('eventosGuardados', JSON.stringify(eventos));
            mostrarEventos();
        }

        function mostrarEventos() {
            document.getElementById('eventosGuardados').innerHTML = 
                (JSON.parse(localStorage.getItem('eventosGuardados')) || [])
                .map(e => `<li class="list-group-item">${e.nombre} - ${e.fecha}</li>`).join('');
        }
        window.onload = mostrarEventos;
    </script>
</body>
</html>
