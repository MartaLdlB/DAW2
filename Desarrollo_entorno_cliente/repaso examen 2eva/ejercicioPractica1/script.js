
let intervalo;

function controlIntervalo(boton){

    if(boton){
        intervalo = setInterval(alert("Hola"), 5000);
    }else{
        clearInterval(intervalo);
    }
}
//utilizamos una funcion anonima para que se use cuando nosotros pulsamos el boton, si solamente se llama a la funcion lo que hace es ejecutarla directamente
let botonActivar = document.getElementById("botonActivar").addEventListener("click", ()=>intervalo(true));

let botonBorrar = document.getElementById("botonBorrar").addEventListener("click", ()=>intervalo(false));