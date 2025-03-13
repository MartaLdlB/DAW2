function actualizarReloj() {
    const reloj = document.getElementById('clock');
    const ahora = new Date();
    const horas = String(ahora.getHours()).padStart(2, '0');
    const minutos = String(ahora.getMinutes()).padStart(2, '0');
    const segundos = String(ahora.getSeconds()).padStart(2, '0');
    reloj.textContent = `${horas}:${minutos}:${segundos}`;
}

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

// Iniciar el reloj cuando se carga la página
document.addEventListener('DOMContentLoaded', function() {
    setInterval(actualizarReloj, 1000);
}); 