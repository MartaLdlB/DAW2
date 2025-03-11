let maquinaExpendedora = ["Coca-Cola 1.50", "Agua 1.00", "Café 1.20", "Té 1.10", "Zumo 1.80"];

/*Ver productos */
let botonMostrar = document.getElementById("verProductos");
botonMostrar.addEventListener("click", mostrarProductos);

function mostrarProductos(){
    let div = document.getElementById("div");
    let lista = document.createElement("ul");
    div.innerHTML = ""; //dejamos el div vacio

    let arraySeparado = [];

    maquinaExpendedora.forEach(bebida => {
        let bebidaSeparada = bebida.split(" ");
        let nombre = bebidaSeparada[0];
        let precio = parseFloat(bebidaSeparada[1]);
        arraySeparado.push([nombre, precio]);
    });

    arraySeparado.forEach(bebidaPrecio => {
        let li = document.createElement("li");
        li.textContent = `La bebida ${bebidaPrecio[0]} tiene un precio de ${bebidaPrecio[1]}€`;
        lista.appendChild(li);
    })
    div.appendChild(lista);
}

/*Saldo */

let botonSaldo = document.getElementById("saldo");
let saldo= botonSaldo.addEventListener("click", ()=>{
    let regex = /^\d+(\.\d{1,2})?$/ ;
    saldo = prompt("Introduce el saldo que tienes :)");
    if(!regex.test(saldo)){
        alert("Valor introducido erroneo, introduzca de nuevo");
    }});

/*Comprar */

let botonComprar = document.getElementById("comprar");
botonComprar.addEventListener("click", ()=>{comprar(saldo)});

function comprar(saldo){
    let arraySeparado = [];
    maquinaExpendedora.forEach(bebida => {
        let bebidaSeparada = bebida.split(" ");
        let nombre = bebidaSeparada[0];
        let precio = parseFloat(bebidaSeparada[1]);
        arraySeparado.push([nombre, precio]);
    });

    let nombreBebida = prompt("Introduce el nombre de la bebida");

    let promesa = new Promise((resolve, reject) => {
        let index = arraySeparado.nombre.indexOf(nombreBebida);
        if(arraySeparado.includes(nombreBebida)){
            resolve(`Has comprado ${arraySeparado.nombre[index]} por ${arraySeparado.precio}€. Saldo restante: ${saldo-arraySeparado.precio}€`);
        }else{
            reject(`No tienes saldo suficiente para comprar ${arraySeparado.nombre[index]}`);
        }
        /*for (const element of arraySeparado) {
            if(element.nombre == nombreBebida && saldo>= element.precio){
                resolve(`Has comprado ${element.nombre} por ${element.precio}€. Saldo restante: ${saldo-element.precio}€`);
            }else{
                reject(`No tienes saldo suficiente para comprar ${element.nombre}`)
            }
        }*/
    })

    return promesa
                .then((mensaje)=>(alert(mensaje)))
                .catch((mensaje)=>(alert(mensaje)));
}

/*Sugerir bebida */

let botonSugerir = document.getElementById("sugerir");
botonSugerir.addEventListener("click", sugerir);

function sugerir(){
    let arraySeparado = [];
    maquinaExpendedora.forEach(bebida => {
        let bebidaSeparada = bebida.split(" ");
        let nombre = bebidaSeparada[0];
        arraySeparado.push(nombre);
    });
    setTimeout(()=>{
        let numeroRandom = parseInt(Math.random()*arraySeparado.length-1);
        console.log(numeroRandom);
        alert(`Te recomendamos ${arraySeparado[numeroRandom]}`);
    },2000);
}
