// Se puede acceder a elementos a través de su CLASIFICACIÓN:
// getElement* devuelve uno o varios elementos del documento que tienen el valor de atributo indicado.
// -ById devuelve un solo elemento, mientras -sByClassName y -sByTagName devuelven una colección de elementos
console.log(document.getElementById('id-1'));
console.log(document.getElementsByClassName('texto'));
console.log(document.getElementsByTagName('texto'));

// querySelector devuelve el primer elemento del documento que coincide con la búsqueda
console.log(document.querySelector('#id-1'));
console.log(document.querySelector('.texto'));
console.log(document.querySelector('texto'));

// Se puede acceder a elementos a través de su JERARQUÍA:
// (se verá en mayor detalle más adelante)
let hijo2 = document.getElementById('id-2');
let padre = document.getElementById('ejemplo-1');
console.log(hijo2.parentNode); // un nodo solo tiene un padre inmediato
console.log(padre.childNodes); // un nodo puede tener varios hijos

//Se pueden modificar los atributos de un elemento:
//document.getElementById('id-1').style.color = 'red';

//document.getElementsByClassName('otro-texto').style.color = 'pink' // da fallo, hay que indicarle el numero del array, ya que genera una lista con los elementos que tienen esta clase = document.getElementsByClassName('otro-texto')[0].style.color = 'pink' este ya no daria fallo


const otros_textos = document.getElementsByClassName('otro-texto');
for (texto of otros_textos) {
    texto.style.color = 'blue';
}

/*const textos = document.getElementsByClassName('texto');
for (texto of textos) {
    texto.style.color = 'pink';
} // el orden de ejecución es el de lectura

//document.getElementById('id-1').style.color = 'orange'; // el orden de ejecución es el de lectura
*/
