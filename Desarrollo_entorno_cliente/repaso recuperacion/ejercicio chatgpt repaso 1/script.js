/*

Crear un objeto jugador que contenga:

El nombre del jugador.
Una función fichaje que devuelva true o false dependiendo de si el jugador ficha o no por el Betis.
La probabilidad de que un jugador fiche debe ser del 60%.
Crear un objeto Betis que contenga:

Un array jugadores donde se almacenarán los jugadores.
Un método agregarJugador que añada un jugador al array de jugadores.
Un método mostrarJugadores que muestre todos los jugadores en una lista <ul> con su nombre.
Un método ficharJugador que intente fichar un jugador con el método fichaje y use una promesa para mostrar si el jugador ha fichado o no.
Un método parpadearJugadores que haga parpadear (aparecer y desaparecer) la lista de jugadores cada 1 segundo, usando setInterval().
HTML y estructura:

Un input donde se pueda escribir el nombre del jugador.
Un botón para agregar un jugador a la plantilla.
Un botón para intentar fichar al jugador.
Un área donde se mostrarán los jugadores.
Usa un <div> para mostrar el escudo del Real Betis.
*/

function Jugador (nombre){
    this.nombre = nombre;

    this.fichaje = function(){
        let numeroRandom = Math.random();
        if(numeroRandom<0.60){
            return true;
        }else{
            return false;
        }
    }
}

function Betis(){
    this.arrayJugadores = [];

    this.agregarJugador = function(jugador){
        this.arrayJugadores.push(jugador);
    }

    this.mostrarJugadores = function(){
        let lista = document.createElement("ul");
        
        this.arrayJugadores.forEach(jugador => {
            let li = document.createElement("li");
            li.textContent = jugador.nombre;
            lista.appendChild(li);
        });
        document.body.appendChild(lista);
    }

    this.ficharJugador = function(jugador){
        let promesa = new Promise((resolve, reject) => {
            
            if(jugador.fichaje()==true){
                resolve("Fichado con exito");
            }else{
                reject("Fichaje fallido");
            }

            
        })
        return promesa
                .then((mensaje)=>(alert(mensaje)))
                .catch((mensaje)=>(alert(mensaje)));

    }

    this.parpadearJugadores = function(){
        setInterval(()=>{
            let numero = 0;
            if(numero==0){
                this.mostrarJugadores();
                numero = 1;
            }else{
                document.body.innerHTML = "";
                numero = 0;
            }
        },1000);
    }
}

let botonAgregar = document.getElementById("agregar");
let nombreJugador = botonAgregar.addEventListener("click",obtenerNombre);

let equipoBetis = new Betis();

let nuevoJugador = new Jugador(nombreJugador);

let ficharJugador = nuevoJugador.fichaje();
if(ficharJugador){
    equipoBetis.ficharJugador(nuevoJugador);
    equipoBetis.agregarJugador(nuevoJugador);
}else{
    equipoBetis.ficharJugador(nuevoJugador);
}

if(equipoBetis.arrayJugadores.length > 0){
    equipoBetis.mostrarJugadores();
}

function obtenerNombre(){
    let nombre;
    nombre = document.getElementById("nombre").value;
    return nombre;
}