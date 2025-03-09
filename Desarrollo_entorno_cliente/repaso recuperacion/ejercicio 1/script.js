let plantillaBetis = [ "13 Adrián", "2 Bellerín", "5 Bartra", "23 Sabaly", "4 Johnny Cardoso", "16 Altimira", "20 Lo Celso", "22 Isco", "7 Antony", "9 Chumy Ávila", "19 Cucho", ];

let div = document.createElement("div");
document.body.appendChild(div);

/*Mostrar plantilla desordenada*/
let botonMostrar = document.getElementById("botonMostrar");
botonMostrar.addEventListener("click", mostrarPlantilla);

function mostrarPlantilla(){
    div.innerHTML = "";
    let listaDesordenada = document.createElement("ul");

    plantillaBetis.forEach(jugador => {
        let li = document.createElement("li");
        li.textContent = jugador;
        listaDesordenada.appendChild(li);
    });
    div.appendChild(listaDesordenada);
}
/*Mostrar plantilla ordenada por dorsal */

let botonMostrarOrdenado = document.getElementById("mostrarOrdenada");
botonMostrarOrdenado.addEventListener("click", mostrarPlantillaOrdenada);

function mostrarPlantillaOrdenada(){
    div.innerHTML = "";
    let lista = document.createElement("ul");
    let arraySeparado = [];

    plantillaBetis.forEach(jugador => {
        let jugadorDorsal = jugador.split(" ");
        let dorsal = parseInt(jugadorDorsal[0]);
        let nombre = jugadorDorsal.slice(1).join(" ");
        arraySeparado.push([dorsal,nombre]); //deberia tener arrays dentro de un array
    });
        arraySeparado.sort((a,b)=>(a[0]-b[0]));
        arraySeparado.forEach(jugadorOrdenado => {
            let li = document.createElement("li");
            li.textContent = `${jugadorOrdenado[0]} ${jugadorOrdenado[1]}`;

        if(jugadorOrdenado[0] % 2 ==0){
            li.style.color = "green";
        }else{
            li.style.color = "blue";
        }

            lista.appendChild(li);
        });
        
        div.appendChild(lista);
    }

/*Mostrar plantilla con retraso y colores */
let botonMostrarColores = document.getElementById("mostrarColores");
botonMostrarColores.addEventListener("click", mostrarColores);

function mostrarColores(){
    div.innerHTML = ""; // Limpiar contenido previo
    let lista = document.createElement("ul");
    let arraySeparado = [];

    // Separar los jugadores en [dorsal, nombre]
    plantillaBetis.forEach(jugador => {
        let jugadorDorsal = jugador.split(" ");
        let dorsal = parseInt(jugadorDorsal[0]);
        let nombre = jugadorDorsal.slice(1).join(" ");
        arraySeparado.push([dorsal, nombre]);
    });

    // Ordenar por dorsal
    arraySeparado.sort((a, b) => a[0] - b[0]);

    let cantidadJugadores = 0;

    // Agregar la lista al div antes de iniciar el intervalo
    div.appendChild(lista);

    let intervalo = setInterval(() => {
        if (cantidadJugadores < arraySeparado.length) {
            let jugadorOrdenado = arraySeparado[cantidadJugadores];
            let li = document.createElement("li");
            li.textContent = `${jugadorOrdenado[0]} ${jugadorOrdenado[1]}`;

            // Cambiar color según si el dorsal es par o impar
            li.style.color = (jugadorOrdenado[0] % 2 === 0) ? "green" : "blue";

            lista.appendChild(li);
            cantidadJugadores++;
        } else {
            clearInterval(intervalo); // Detener el intervalo cuando se muestren todos los jugadores
        }
    }, 1000);
}



