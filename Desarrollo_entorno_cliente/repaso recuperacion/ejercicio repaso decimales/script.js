/*

Ejercicio: Calculadora de Operaciones con Euros
Instrucciones:
Pedir al usuario un importe en euros.
Debe cumplir una expresión regular para asegurar que el formato sea correcto (por ejemplo, 12.50 o 1000,75).
Convertirlo a decimales correctamente.
Se utilizará una función específica para la conversión.
Realizar una operación matemática con el importe.
Por ejemplo, sumar el IVA (21%) o aplicar un descuento.
Redondear el resultado y mostrarlo en pantalla.
La función de redondeo será proporcionada.

*/

// Expresión regular para validar el importe en euros (permite punto o coma como separador decimal)
const regexEuros = /^[0-9]+([,.][0-9]{1,2})?$/;

// Función para convertir la entrada a número decimal correctamente
function convertirADecimal(cadena) {
    return parseFloat(cadena.replace(",", ".")); // Reemplaza coma por punto y convierte a número
}

// Función para redondear a 2 decimales
function redondearDosDecimales(numero) {
    return Math.round(numero * 100) / 100; //tambien podemos usar toFixed(2) pero devuelve un string
}

// Pedir importe al usuario
let importeUsuario = prompt("Introduce un importe en euros (ejemplo: 12.50 o 1000,75):");

// Validar que el importe cumple con la expresión regular
if (regexEuros.test(importeUsuario)) {
    let importe = convertirADecimal(importeUsuario);

    // Realizar operación matemática (por ejemplo, sumarle un 21% de IVA)
    let importeConIVA = importe * 1.21;

    // Redondear el resultado
    let resultadoFinal = redondearDosDecimales(importeConIVA);

    // Mostrar resultado
    alert(`El importe con IVA incluido es: ${resultadoFinal.toFixed(2)} €`);
} else {
    alert("El formato del importe no es válido. Inténtalo de nuevo.");
}
