let segundos = 5;

let contenedor =  document.getElementById("contenedor");

//se ejecuta esta funcion cada 1 segundo, como en este caso al llegar a un numero inferior a 0
//redirigimos a la pagina de google, no seria necesario para de contar, ya que se cortaría
//el script, si no fuesemos a redirigir, tendriamos que pararlo nosotros
let intervalo = setInterval(()=>{
    if(segundos>=1){
        contenedor.innerHTML= `Faltan ${segundos} para redirigir`;
    }else if (segundos===0){
        contenedor.innerHTML = 'Nos vamos...';
    }else{
        window.location.href= "https://www.google.com/?hl=es"
    }
    segundos--;
}, 1000);