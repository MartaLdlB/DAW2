let plantillaBetis = ["13 Adrián", "2 Bellerín", "5 Bartra", "23 Sabaly", "4 Johnny Cardoso", "16 Altimira", "20 Lo Celso", "22 Isco", "7 Antony", "9 Chumy Ávila", "19 Cucho" ];



let botonOrdenar = document.getElementById("ordenar");
botonOrdenar.addEventListener("click", ordenar);

function ordenar(){
    let div = document.getElementById("div");
    div.innerHTML = "";
    let lista = document.createElement("ul");

    let arraySeparado = [];

    plantillaBetis.forEach(jugador => {
        let jugadorSeparado = jugador.split(" ");
        let dorsal = parseInt(jugadorSeparado[0]);
        let nombre = jugadorSeparado.slice(1).join(" ");
        arraySeparado.push([dorsal,nombre]);
    });
    arraySeparado.sort((a,b)=>(a[0]-b[0]));
    arraySeparado.forEach(persona => {
        let li = document.createElement("li");
        li.innerHTML = `${persona[0]} ${persona[1]}`;
        lista.appendChild(li);
    });

    div.appendChild(lista);
}