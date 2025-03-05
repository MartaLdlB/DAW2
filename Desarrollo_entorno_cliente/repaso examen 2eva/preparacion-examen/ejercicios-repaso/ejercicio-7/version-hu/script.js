/**
 * No utilizar variables del tipo var (var = numero), están obsoletas.
 */

// Botón que ordene alfabéticamente una lista pasados 3s.
let lista = document.querySelector("ul");
let elementosLista = document.querySelectorAll("li");
/*
Posición 0 = <li>Adrian Pascual</li>
Posición 1 = <li>Adrian Blazquez</li>
Posición 2 = <li>Laura Pelirroja</li>
*/

let boton = document.getElementById("ordenar");

function ordenarLista() {
    // Ponemos un setTimeOut para que depués de 3 segundos ejecute el código.
    setTimeout(() => {
        // Convertirmos la lista de elementos de NodeList a un ArrayList.
        let arrayElementosLista = Array.from(elementosLista);
        // Hacemos un sort para ordenarlos alfabeticamente.
        arrayElementosLista.sort((a, b) => a.textContent.localeCompare(b.textContent));
        // Borramos todo lo que está dentro de la lista.
        lista.innerHTML = "";
        // Le metemos a la list uno por uno los elementos ordenados
        for (let elemento of arrayElementosLista) {
            // Le mete uno por uno todos los elementos ordenados.
            lista.appendChild(elemento);
        }
    }, 3000)


}

boton.addEventListener("click", ordenarLista);