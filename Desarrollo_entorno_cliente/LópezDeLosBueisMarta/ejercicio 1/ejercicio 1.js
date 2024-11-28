
function mediaArmonica(...numeros) {
    
    let sumaNumeros=0;

    for (let i = 0; i < numeros.length; i++) {
        sumaNumeros=sumaNumeros + (1/numeros[i]);
        
    }

    let longitudArray=numeros.length;
    let resulMedia=0;

    resulMedia = longitudArray / sumaNumeros;
    return resulMedia;
}

console.log(mediaArmonica(1,2,4));

