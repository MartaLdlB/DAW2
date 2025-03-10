let plantillaBetis = ["13 Adrián", "2 Bellerín", "5 Bartra", "23 Sabaly", "4 Johnny Cardoso", "16 Altimira", "20 Lo Celso", "22 Isco", "7 Antony", "9 Chumy Ávila", "19 Cucho" ];

let botonMostrar = document.getElementById("mostrar");
botonMostrar.addEventListener("click", mostrarPlantillaInicial);

function mostrarPlantillaInicial(){
    let div = document.getElementById("div");
    div.innerHTML = "";
    let ul = document.createElement("ul");
    
    plantillaBetis.forEach(jugador => {
        let li = document.createElement("li");
        li.textContent = jugador;
        ul.appendChild(li);
    });
    div.appendChild(ul);
}

let botonOrdenar = document.getElementById("ordenar");
botonOrdenar.addEventListener("click", mostrarPlantillaOrdenada);

function mostrarPlantillaOrdenada(){
    let div = document.getElementById("div");
    div.innerHTML = "";
    let lista = document.createElement("ul");
    let arraySeparado = [];

    plantillaBetis.forEach(jugador => {
        let jugadorSeparado = jugador.split(" ");
        let dorsal = parseInt(jugadorSeparado[0]);
        let nombre = jugadorSeparado.slice(1).join(" ");//separa el jugador en dos por el primer espacio y coge apartir del segundo
        arraySeparado.push([dorsal , nombre]);
    });

    arraySeparado.sort((a,b)=>(a[0]-b[0])); //ordenamos el array por el dorsal, por eso indicamos el [0] que es la posicion en la que esta el dorsal

    arraySeparado.forEach(jugadorOrdenado => {
        let li = document.createElement("li");
        li.textContent = `${jugadorOrdenado[0]} ${jugadorOrdenado[1]}`;
        lista.appendChild(li);
    });
    div.appendChild(lista);
}

let botonColores = document.getElementById("colores");
botonColores.addEventListener("click", mostrarColores);

function mostrarColores(){
    let div = document.getElementById("div");
    div.innerHTML = "";
    let lista = document.createElement("ul");
    let arraySeparado = [];

    plantillaBetis.forEach(jugador => {
        let jugadorSeparado = jugador.split(" ");
        let dorsal = parseInt(jugadorSeparado[0]);
        let nombre = jugadorSeparado.slice(1).join(" ");//separa el jugador en dos por el primer espacio y coge apartir del segundo
        arraySeparado.push([dorsal , nombre]);
    });

    arraySeparado.sort((a,b)=>(a[0]-b[0])); //ordenamos el array por el dorsal, por eso indicamos el [0] que es la posicion en la que esta el dorsal

    arraySeparado.forEach(jugadorOrdenado => {
        let li = document.createElement("li");
        li.textContent = `${jugadorOrdenado[0]} ${jugadorOrdenado[1]}`;

        if(jugadorOrdenado[0] % 2 == 0){
            li.style.color = "green";
        }else{
            li.style.color = "blue";
        }

        lista.appendChild(li);
    });
    div.appendChild(lista);
}