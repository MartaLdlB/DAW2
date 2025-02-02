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

setTimeout(() =>
    {
        if(confirm(`Se calculará el nº de veces que aparece la palabra ${palabra} en el texto`)){
            let contador = 0;
            let texto = document.body.innerHTML;

            let posicion = texto.indexOf(palabra);

            while(posicion != -1){
                contador++;
                posicion=texto.indexOf(palabra, posicion+1); //esto empezará a buscar en la posicion siguiente
            }
            let parrafo1 = document.createElement("p");
            let contenido1= document.createTextNode(`La palabra ${palabra} aparece ${contador} veces`);
            parrafo1.appendChild(contenido1);

            document.body.insertBefore(parrafo1,document.body.firsChild);
        }
    }, 3000)