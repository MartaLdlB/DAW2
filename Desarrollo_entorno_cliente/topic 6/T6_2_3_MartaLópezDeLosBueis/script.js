/*
Crea una página con una gran cantidad de texto.

Solicita al usuario una palabra a buscar.
Realiza scroll hasta la primera ocurrencia de esa palabra (la palabra aparecerá remarcada).
Consejo: Aunque no es estándar, puede ser útil el método find() de la interfaz Window de JS.

Cuando lo consigas, haz que:
A los tres segundos de encontrarla, salta un aviso indicando que se calculará el número de veces que aparece el texto en la página.
Cuando el usuario acepte, la página mostrará el número de ocurrencias del texto.
Se muestra el texto buscado y su cantidad de ocurrencias al principio de la página (y se traslada allí).

Modificaremos esta tarea en clase para añadirle otra funcionalidad.
*/

function marcarPalabra(palabra,elemento){
    let texto=elemento.textContent;
    
    let pos=texto.indexOf(palabra);
    if(pos!=-1){
        let expReg=new RegExp(palabra,"g");
        elemento.innerHTML=elemento.innerHTML.replace(
            expReg,"<mark>"+palabra+"</mark>");
        return true;
    }
    else
        return false;
}

function buscarTextoEnElemento(elemento,palabra){
    if(elemento.children){
        for(let hijo of elemento.children){  //Recorre todos los hijos del elemento
            if(hijo.children.length>0){
                buscarTextoEnElemento(hijo);  //Llamada recursiva si el elemento
            }
            else{
                marcarPalabra(palabra,hijo);
            }
        }
    }
}


let texto=prompt("Escriba la palabra a marcar");
if(texto){
    buscarTextoEnElemento(document.body,texto);
}