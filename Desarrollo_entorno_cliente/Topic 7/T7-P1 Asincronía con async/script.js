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

function descargarArchivo(){
    let promesa = new Promise((resolve, reject)=> {
        let temp1 = setTimeout(() => {
            clearTimeout(temp2);
            resolve("Descarga completada");
        },3000);

        let temp2 = setTimeout(()=>{
            clearTimeout(temp1);
            reject("Fallo en la descarga");
        },6000);
    })
    return promesa;
}

async function gestionarDescarga() {

    console.log("Iniciando la descarga...");
    let mensaje = await descargarArchivo();
    console.log(mensaje);
    
}

gestionarDescarga();