// Definición de categorías
const CATEGORIAS = {
    personal: { nombre: 'Personal', color: '#ff6b6b', icono: 'fas fa-user' },
    trabajo: { nombre: 'Trabajo', color: '#4d96ff', icono: 'fas fa-briefcase' },
    cumpleanos: { nombre: 'Cumpleaños', color: '#ff9f43', icono: 'fas fa-birthday-cake' },
    vacaciones: { nombre: 'Vacaciones', color: '#2ecc71', icono: 'fas fa-umbrella-beach' },
    estudio: { nombre: 'Estudio', color: '#a55eea', icono: 'fas fa-graduation-cap' },
    otros: { nombre: 'Otros', color: '#778ca3', icono: 'fas fa-calendar' }
};

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
    let categoria = document.getElementById('categoriaEvento').value;
    
    if (!nombre || !fecha || !categoria) {
        mostrarAlerta('Por favor, completa todos los campos', 'danger');
        return;
    }

    let eventos = JSON.parse(localStorage.getItem('eventosGuardados')) || [];
    eventos.push({ 
        nombre, 
        fecha, 
        categoria,
        creado: new Date().toISOString()
    });
    
    // Ordenar eventos por fecha
    eventos.sort((a, b) => new Date(a.fecha) - new Date(b.fecha));
    
    localStorage.setItem('eventosGuardados', JSON.stringify(eventos));
    limpiarFormulario();
    mostrarEventos();
    actualizarTimeline();
    mostrarAlerta('Evento guardado correctamente', 'success');
}

function limpiarFormulario() {
    document.getElementById('nombreEvento').value = '';
    document.getElementById('fechaEvento').value = '';
    document.getElementById('categoriaEvento').value = 'personal';
}

function mostrarAlerta(mensaje, tipo) {
    const alertaDiv = document.createElement('div');
    alertaDiv.className = `alert alert-${tipo} alert-dismissible fade show`;
    alertaDiv.innerHTML = `
        ${mensaje}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.querySelector('.container').insertBefore(alertaDiv, document.querySelector('h2'));
    setTimeout(() => alertaDiv.remove(), 3000);
}

function crearEnlaceGoogleCalendar(evento) {
    const fecha = new Date(evento.fecha);
    const fechaFin = new Date(fecha);
    fechaFin.setDate(fechaFin.getDate() + 1);

    const formatearFecha = (date) => {
        return date.toISOString().replace(/-|:|\.\d+/g, '');
    };

    const params = new URLSearchParams({
        action: 'TEMPLATE',
        text: evento.nombre,
        dates: `${formatearFecha(fecha)}/${formatearFecha(fechaFin)}`,
        details: `Evento creado desde Contador de Días\nCategoría: ${CATEGORIAS[evento.categoria].nombre}`
    });

    return `https://calendar.google.com/calendar/render?${params.toString()}`;
}

function mostrarEventos() {
    const eventos = JSON.parse(localStorage.getItem('eventosGuardados')) || [];
    const listaEventos = document.getElementById('eventosGuardados');
    
    if (eventos.length === 0) {
        listaEventos.innerHTML = '<li class="list-group-item text-center">No hay eventos guardados</li>';
        return;
    }

    listaEventos.innerHTML = eventos.map(evento => {
        const categoria = CATEGORIAS[evento.categoria || 'otros'];
        const fechaEvento = new Date(evento.fecha);
        const diasFaltantes = Math.ceil((fechaEvento - new Date()) / (1000 * 60 * 60 * 24));
        
        return `
            <li class="list-group-item d-flex justify-content-between align-items-center" 
                style="border-left: 4px solid ${categoria.color}">
                <div>
                    <i class="${categoria.icono}" style="color: ${categoria.color}"></i>
                    <span class="ms-2">${evento.nombre}</span>
                    <small class="text-muted ms-2">${evento.fecha}</small>
                    <span class="badge bg-${diasFaltantes >= 0 ? 'primary' : 'secondary'} rounded-pill ms-2">
                        ${diasFaltantes >= 0 ? `Faltan ${diasFaltantes} días` : 'Evento pasado'}
                    </span>
                </div>
                <div class="btn-group">
                    <a href="${crearEnlaceGoogleCalendar(evento)}" 
                       target="_blank" 
                       class="btn btn-sm btn-primary"
                       title="Añadir a Google Calendar">
                        <i class="fas fa-calendar-plus"></i>
                    </a>
                    <button onclick="eliminarEvento('${evento.nombre}')" 
                            class="btn btn-sm btn-danger"
                            title="Eliminar evento">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </li>
        `;
    }).join('');
}

function actualizarTimeline() {
    const eventos = JSON.parse(localStorage.getItem('eventosGuardados')) || [];
    const timeline = document.getElementById('timeline');
    
    if (eventos.length === 0) {
        timeline.innerHTML = '<p class="text-center">No hay eventos para mostrar en la línea de tiempo</p>';
        return;
    }

    const hoy = new Date();
    const proximosEventos = eventos
        .filter(e => new Date(e.fecha) >= hoy)
        .slice(0, 5);

    timeline.innerHTML = `
        <div class="timeline-line"></div>
        ${proximosEventos.map((evento, index) => {
            const categoria = CATEGORIAS[evento.categoria || 'otros'];
            const diasFaltantes = Math.ceil((new Date(evento.fecha) - hoy) / (1000 * 60 * 60 * 24));
            
            return `
                <div class="timeline-item" style="left: ${(index / (proximosEventos.length - 1)) * 100}%">
                    <div class="timeline-point" style="background-color: ${categoria.color}">
                        <i class="${categoria.icono}"></i>
                    </div>
                    <div class="timeline-content">
                        <h6>${evento.nombre}</h6>
                        <small>${evento.fecha}</small>
                        <div class="timeline-days">${diasFaltantes} días</div>
                    </div>
                </div>
            `;
        }).join('')}
    `;
}

function eliminarEvento(nombreEvento) {
    if (!confirm('¿Estás seguro de que quieres eliminar este evento?')) return;
    
    let eventos = JSON.parse(localStorage.getItem('eventosGuardados')) || [];
    eventos = eventos.filter(e => e.nombre !== nombreEvento);
    localStorage.setItem('eventosGuardados', JSON.stringify(eventos));
    mostrarEventos();
    actualizarTimeline();
    mostrarAlerta('Evento eliminado correctamente', 'success');
}

function filtrarEventosPorCategoria(categoria) {
    const eventos = JSON.parse(localStorage.getItem('eventosGuardados')) || [];
    if (categoria === 'todos') {
        mostrarEventos();
        return;
    }
    
    const eventosFiltrados = eventos.filter(e => e.categoria === categoria);
    mostrarEventosEnLista(eventosFiltrados);
}

function mostrarEventosEnLista(eventos) {
    const listaEventos = document.getElementById('eventosGuardados');
    if (eventos.length === 0) {
        listaEventos.innerHTML = '<li class="list-group-item text-center">No hay eventos en esta categoría</li>';
        return;
    }
    // Usar la misma lógica de mostrarEventos pero con los eventos filtrados
    // ... (código similar al de mostrarEventos)
}

// Inicialización cuando se carga la página
document.addEventListener('DOMContentLoaded', function() {
    mostrarEventos();
    actualizarTimeline();
    
    // Actualizar la vista cada minuto
    setInterval(() => {
        mostrarEventos();
        actualizarTimeline();
    }, 60000);
}); 