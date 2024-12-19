/*
Crea un tipo de objeto que sirva para representar una Carta. Tendrá dos propiedades:

    palo: un número de 1 a 4 (1 - oros; 2 - espadas; 3 - bastos; 4 - copas).
    valor: un número del 1 al 10 (8 - sota; 9 - caballo; 10 - rey).
Los objetos de este tipo se construirán indicando el palo y el valor. Si hay fallos en los datos, se devuelve un objeto nulo en la creación.

Las cartas tendrán estos métodos:

    darValor(): recibe un número de palo y un valor y los asigna a la carta. Si recibe datos incorrectos, no hace nada.
    toString(): devuelve (no imprime) un texto que describe la carta (por ejemplo: As de Oros).


Crea otro tipo de objeto que sirva para representar una Baraja de cartas. Contendrá las siguientes propiedades:

cartas: array con las 40 cartas de una baraja.
Al construir la Baraja, se rellenan las cartas en el siguiente orden: por palos y, cada palo, con las cartas del 1 al 10. No se podrá acceder directamente al array fuera de la función constructora.

Una baraja tendrá estos métodos:
    barajar(): baraja las cartas, desordenándolas de forma aleatoria.
    toString(): devuelve un texto con el orden en el que están las cartas dentro de la baraja.
*/

function carta(palo, valor){
    
    this.darValor = function(palo, valor){
        if(isNaN(palo) || isNaN(valor))return false;
        else if(palo<1 || palo >4)return false;
        else if(valor<1 || valor >10) return false;
        else {
            this.palo=palo;
            this.valor=valor;
        }


    }

    if(this.darValor(this.palo, this.valor)==false){
        return null;
    }else{
        return this;
    }

    
}
