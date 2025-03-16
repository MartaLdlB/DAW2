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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/estilos.css" rel="stylesheet">
    <style>
        .btn-group .btn {
            margin: 0 2px !important;
        }
        .list-group-item {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem !important;
            font-size: 0.875rem !important;
        }
        
        /* Estilos para la línea de tiempo */
        .timeline-container {
            position: relative;
            padding: 20px 0;
            margin: 40px 0;
            overflow: hidden;
        }
        
        .timeline-line {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--color-acento);
            transform: translateY(-50%);
        }
        
        .timeline-item {
            position: absolute;
            transform: translateX(-50%);
        }
        
        .timeline-point {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .timeline-point:hover {
            transform: scale(1.2);
            box-shadow: var(--sombra-neon);
        }
        
        .timeline-content {
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(42, 10, 74, 0.8);
            padding: 10px;
            border-radius: 5px;
            min-width: 150px;
            text-align: center;
            border: 1px solid var(--color-acento);
        }
        
        .timeline-content h6 {
            margin: 0;
            color: var(--color-texto);
        }
        
        .timeline-content small {
            color: var(--color-texto);
            opacity: 0.8;
        }
        
        .timeline-days {
            font-weight: bold;
            color: var(--color-neon);
        }
        
        /* Estilos para las categorías */
        .categoria-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 15px;
            margin: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .categoria-badge:hover {
            transform: translateY(-2px);
            box-shadow: var(--sombra-neon);
        }
        
        .categoria-badge i {
            margin-right: 5px;
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

        <!-- Timeline de próximos eventos -->
        <div class="timeline-container">
            <h2>Próximos Eventos</h2>
            <div id="timeline" class="position-relative" style="height: 200px;">
                <!-- Aquí se insertará la línea de tiempo dinámicamente -->
            </div>
        </div>

        <h2>Cuenta regresiva para una hora específica</h2>
        <input type="time" id="horaObjetivo" class="form-control">
        <button class="btn btn-success mt-2" onclick="iniciarCuentaRegresiva()">Iniciar Cuenta Regresiva</button>
        <p id="cuentaRegresiva"></p>

        <h2>Contador de Días para un Evento</h2>
        <div class="row">
            <div class="col-md-6">
                <input type="text" id="nombreEvento" class="form-control" placeholder="Nombre del evento">
            </div>
            <div class="col-md-3">
                <input type="date" id="fechaEvento" class="form-control">
            </div>
            <div class="col-md-3">
                <select id="categoriaEvento" class="form-control">
                    <option value="personal">Personal</option>
                    <option value="trabajo">Trabajo</option>
                    <option value="cumpleanos">Cumpleaños</option>
                    <option value="vacaciones">Vacaciones</option>
                    <option value="estudio">Estudio</option>
                    <option value="otros">Otros</option>
                </select>
            </div>
        </div>
        <div class="mt-2">
            <button class="btn btn-success" onclick="calcularDias()">Calcular</button>
            <button class="btn btn-warning" onclick="guardarEvento()">Guardar Evento</button>
        </div>
        <p id="resultado"></p>

        <h2>Eventos Guardados</h2>
        <!-- Filtros de categoría -->
        <div class="categorias-filtro text-center mb-3">
            <div class="categoria-badge" onclick="filtrarEventosPorCategoria('todos')" style="background-color: #6c757d">
                <i class="fas fa-list"></i> Todos
            </div>
            <div class="categoria-badge" onclick="filtrarEventosPorCategoria('personal')" style="background-color: #ff6b6b">
                <i class="fas fa-user"></i> Personal
            </div>
            <div class="categoria-badge" onclick="filtrarEventosPorCategoria('trabajo')" style="background-color: #4d96ff">
                <i class="fas fa-briefcase"></i> Trabajo
            </div>
            <div class="categoria-badge" onclick="filtrarEventosPorCategoria('cumpleanos')" style="background-color: #ff9f43">
                <i class="fas fa-birthday-cake"></i> Cumpleaños
            </div>
            <div class="categoria-badge" onclick="filtrarEventosPorCategoria('vacaciones')" style="background-color: #2ecc71">
                <i class="fas fa-umbrella-beach"></i> Vacaciones
            </div>
            <div class="categoria-badge" onclick="filtrarEventosPorCategoria('estudio')" style="background-color: #a55eea">
                <i class="fas fa-graduation-cap"></i> Estudio
            </div>
            <div class="categoria-badge" onclick="filtrarEventosPorCategoria('otros')" style="background-color: #778ca3">
                <i class="fas fa-calendar"></i> Otros
            </div>
        </div>
        <ul id="eventosGuardados" class="list-group"></ul>
    </div>

    <footer>
        <p>&copy; 2025 Contador de Días. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/reloj.js"></script>
    <script src="../assets/js/eventos.js"></script>
</body>
</html>
