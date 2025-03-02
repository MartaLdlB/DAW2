


function diferenciaFechas(){
    let fechaHoy = new Date();
    let anios;
    let diferenciaMs;
    let fechaFormulario =new Date(document.getElementById("fecha").value);
    let parrafo = document.createElement("p");
    if(fechaHoy>fechaFormulario){
        diferenciaMs = fechaHoy - fechaFormulario; 
    }else{
        diferenciaMs = fechaFormulario - fechaHoy; 
    }
    anios = Math.ceil(diferenciaMs / (1000 * 60 * 60 * 24 * 365.25));
    parrafo.innerText = `Los años entre las dos fechas son: ${anios}`;
    document.body.appendChild(parrafo);
}