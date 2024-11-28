/*
• Crea una función que permita saber si un número es primo o no.

• Un número es primo si no se puede dividir de forma entera por otro número, sin contar el 
uno ni el propio número, dando un resto de cero.

• Aprovecha la función creada para crear una página web que escriba los números primos del 
lal 1000.
*/

function esPrimo(n){
    //No tiene sentido enviar como parámetro
    //números negativos o cero, por si acaso devolvemos
    //false en previsión de un bucle infinito
    if(n<1)return false;
    if(n==1)return true;
    //Para el resto de números empezamos a dividir entre 2
    //y terminamos cuando la raíz cuadrada del contador supere al número 
    for (let i = 2; i * i < n; i++) {
    //si el número se puede dividir por el contador
    //no tenemos un primo
    if(n%i==0)return false;
    
   }
    //si hemos salido del bucle sin ejecutar el return 
    //tenemos un número primo
    return true;
    
}