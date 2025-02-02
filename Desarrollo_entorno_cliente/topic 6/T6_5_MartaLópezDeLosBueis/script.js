/*
Crea una página con una gran cantidad de texto.

Solicita al usuario una palabra a buscar.
Realiza scroll hasta la primera ocurrencia de esa palabra (la palabra aparecerá remarcada).
Consejo: Aunque no es estándar, puede ser útil el método find() de la interfaz Window de JS.

Cuando lo consigas, haz que:
A los tres segundos de encontrarla, salta un aviso indicando que se calculará el número de veces que aparece el texto en la página.
Cuando el usuario acepte, la página mostrará el número de ocurrencias del texto.
Se muestra el texto buscado y su cantidad de ocurrencias al principio de la página (y se traslada allí).

Modificaremos esta tarea en clase para añadirle otra funcionalidad.
*/


//Primera parte
let palabra = prompt("Escriba la palabra a buscar");

if(palabra){
    window.find(palabra);
}

/***************************************************************************************/
//Segunda parte

setTimeout(() => {
    if (encontrada && confirm(`Se calculará el nº de veces que aparece la palabra "${palabra}" en el texto.`)) {
        let texto = document.body.innerHTML;
        let regex = new RegExp(`(${palabra})`, "gi");
        let coincidencias = texto.match(regex); // Array con todas las coincidencias encontradas
        let contador = coincidencias ? coincidencias.length : 0;

        // Resaltar todas las ocurrencias en el texto
        texto = texto.replace(regex, '<span class="highlight">$1</span>');
        document.body.innerHTML = texto;

        // Crear mensaje con el resultado y colocarlo al inicio
        let parrafo1 = document.createElement("p");
        parrafo1.innerHTML = `La palabra "<strong>${palabra}</strong>" aparece ${contador} veces en el texto.`;

        document.body.insertBefore(parrafo1, document.body.firstChild); // Insertar al principio de la página
        window.scrollTo(0, 0); // Desplazar hacia arriba para ver el mensaje
    }
}, 3000);