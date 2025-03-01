/*
Crea una página web con un botón que, al hacer clic, muestre información sobre el navegador y la pantalla del usuario.

Agrega otro botón para redirigir a Google usando el objeto location.

Implementa botones para ir hacia adelante y atrás en el historial con history.

Usa setTimeout para mostrar una alerta después de 5 segundos.
*/

function mostrarInfo() {
    let parrafo = document.createElement("p");
    parrafo.innerText("El lenguaje usado en el navegador es: "+navigator.language+ "<br>" + navigator.userAgent);
    document.body.appendChild(parrafo);
}

mostrarInfo();