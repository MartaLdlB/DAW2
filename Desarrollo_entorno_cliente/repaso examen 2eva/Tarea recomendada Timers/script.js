/*
Crear una función en JavaScript que transcurridos 3 segundos después de ejecutarse 
la página muestre en el lado del cliente (mediante document.write) el nombre del navegador que se está utilizando. 

A continuación, se debe iniciar una nueva cuenta y tras 5 segundos 
mostrar una ventana de dialogo de tipo confirm con el mensaje: ‘¿Abrir Google en una nueva pestaña?’. 

En caso de aceptar, se debe abrir una nueva ventana/pestaña y cargar en esta la dirección www.google.es. 

En caso de rechazar la confirmación se deberá cargar en la ventana/pestaña actual la página https://duckduckgo.com.
*/

function detectarNavegador(){
    let navegador = navigator.userAgent;
    return navegador;
}
setTimeout(function(){
    
    document.write("El navegador en uso es: "+detectarNavegador());
},3000);
setTimeout(function(){
    const respuesta = confirm("¿Abrir Google en una nueva pestaña?");
    if (respuesta) {
        //Si se acepta, abrir Google en una nueva pestaña
        window.open("https://www.google.com/?hl=es");
    } else {
        //Si se rechaza, abrir DuckDuckGo en la misma pestaña
        window.location.href = "https://duckduckgo.com";
    }
},8000); //Pongo 8 segundos para tener en cuenta los 3 segundos del anterior, asi empieza 5 segundos segun muestra el navegador

