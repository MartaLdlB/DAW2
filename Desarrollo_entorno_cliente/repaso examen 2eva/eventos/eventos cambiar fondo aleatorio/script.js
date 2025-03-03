/*Crea un contador que aumente cada vez que hagas clic en un botón y muestre el número en pantalla*/

function cambiaColor(){
    let rojo =parseInt( Math.random()*256);
    let verde =parseInt(Math.random()*256);
    let azul =parseInt( Math.random()*256);

    document.body.style.backgroundColor ="rgb(" + rojo + "," + verde + "," + azul + ")";
}

let boton = document.getElementById("boton");

boton.addEventListener("click", cambiaColor);