/*Crea un contador que aumente cada vez que hagas clic en un botón y muestre el número en pantalla*/
let contador = 0;
function mostrarContador(){
    contador++;
    alert("Contador: "+ contador);
}

let boton = document.getElementById("boton");

boton.addEventListener("click", mostrarContador);