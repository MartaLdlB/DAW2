/*

Objetivo:
Crear una función async que simule la descarga de un archivo. La función debe tardar 3 segundos en completarse y mostrar mensajes antes, durante y después de la "descarga".

Instrucciones:

Crear una función llamada descargarArchivo() que retorne una promesa.

La promesa debe resolverse después de 3 segundos con un mensaje de éxito: "Descarga completada"
Crear otra función async llamada gestionarDescarga(), que:

Muestre "Iniciando la descarga..." antes de llamar a descargarArchivo().
Espere a que la promesa se resuelva usando await.
Una vez resuelta, muestre el mensaje de éxito.
Llamar a gestionarDescarga() para ejecutar el proceso.

*/

function pedirDatos() {
    return new Promise((resolve, reject) => {
    setTimeout(() => {
        const exito = true; // Cambia a false para simular un error

        if (exito) {
        resolve("Datos recibidos correctamente");
        } else {
        reject("Error al obtener los datos");
        }
    }, 2000);
    });
}

  // Usando la promesa
pedirDatos()

    //este .then(resultado) va a imprimir el mensaje de la promesa que hay en la funcion si es resolve, se añadie al mensaje de la promesa 
    //al console.log 
    .then((resultado) => {
    console.log("Éxito:", resultado);
    })
    //en este caso el .catch(error) captura el reject, el cual en el console.log() imprime el mensaje indicado en el catch mas el puesto en la promesa en el caso de error
    .catch((error) => {
    console.log("Error:", error);
    });