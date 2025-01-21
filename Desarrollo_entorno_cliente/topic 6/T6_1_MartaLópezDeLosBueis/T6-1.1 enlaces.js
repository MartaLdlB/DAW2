
//Ejercicio 1
let enlaces =document.getElementsByTagName("a"); //obtenemos un array
console.log(enlaces.length); //obtenemos la longitud del array para saber cuantos enlaces hay

/****************************************************************/


let contenedor = document.getElementById("enlacesPag"); //obtenemos el elemento que tiene este ID
let newP = document.createElement("p"); //creamos un elemento p vacio en una variable
newP.textContent="Hay "+enlaces.length+" enlaces"; //le indicamos que este es el texto que va a tener dentro el p
contenedor.appendChild(newP); //añadimos como hijo del elemento con el ID, se incluye al final del div


/*
//otra forma mas corta
let contenedor = document.getElementById("enlacesPag"); //obtenemos el elemento que tiene este ID
contenedor.innerHTML="<p>Hay un total de "+enlaces.length+ " en la página</p>";
*/

//Ejercicio 2

let tercerP = contenedor.getElementsByTagName("p")[2]; //guardamos el tercer elemento del array

let enlaces3p = tercerP.getElementsByTagName("a");

console.log(enlaces3p.length);

