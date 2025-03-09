function Jugador(nombre){
    this.nombre = nombre;

    this.fichaje = function(){
        let numeroRandom = Math.random();
        if(numeroRandom < 0.69){
            return true;
        }else{
            return false;
        }
    }
}

let nombreJugador = prompt("Introduce el nombre del jugador");

let jugador = new Jugador(nombreJugador);

let intentarFichaje = document.getElementById("intentarFichaje");
intentarFichaje.addEventListener("click", creaPromesa);

function creaPromesa(){
    let promesa = new Promise((resolve, reject) => {
    if(jugador.fichaje()){
        setTimeout(()=>{
            resolve(`${jugador.nombre} se une al Real Betis Balompie`);
        },4000);
        
    }else{
        setTimeout(()=>{
            reject(`${jugador.nombre} rechaza la oferta del Real Betis Balompie`);
        },4000);
    }
    });
    promesa
        .then((mensaje) => alert(mensaje))
        .catch((mensaje) => alert(mensaje));
}
