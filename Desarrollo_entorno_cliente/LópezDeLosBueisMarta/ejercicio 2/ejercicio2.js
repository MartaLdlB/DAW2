let arrayMartaLopez = [];

for (let i = 0; i < 30; i++) {
    let numeroRandom = parseInt(Math.random()*(2-99)+99);
    arrayMartaLopez.push(numeroRandom);
}



//creamos el mapa
let mapaMartaLopez = new Map();

//creamos los contadores de pares e impares

let pares=0;
let impares=0;

//por cada elemento del array comprobamos con el resto si es par o impar

for (let i = 0; i < arrayMartaLopez.length; i++) {
    if(arrayMartaLopez[i]%2==0){
        pares++;
    }else{
        impares++;
    }
    
}

//añadimos la cantidad
mapaMartaLopez.set(["Pares", pares]);
mapaMartaLopez.set(["Impares", impares]);


console.log(arrayMartaLopez);
console.log(primos(arrayMartaLopez));


mapaMartaLopez.set(["Primos", primos(arrayMartaLopez).sort()]);

for (const [clave, valor] of mapaMartaLopez ) {
        console.log(clave, valor);
    }


function primos(arrayMartaLopez) {

    let arrayPrimos = []; //guardamos los números primos encontrados.

    for (let j = 0; j < arrayMartaLopez.length; j++) {
        let comprobarPrimo = arrayMartaLopez[j];
        let esPrimo = true; //decimos que el número es primo.

        if (comprobarPrimo < 2) {
            esPrimo = false; //si es menor que 2 no son primos.
        } else {
            // Comprobamos si tiene divisores entre 2 y la raíz cuadrada del número.
            for (let i = 2; i <= Math.sqrt(comprobarPrimo); i++) {
                if (comprobarPrimo % i === 0) {
                    esPrimo = false;
                }
            }
        }

        //en el caso de ser primo, lo agregamos al array de primos.
        if (esPrimo) {
            arrayPrimos.push(comprobarPrimo);
        }
    }

    return arrayPrimos; 
}






    



