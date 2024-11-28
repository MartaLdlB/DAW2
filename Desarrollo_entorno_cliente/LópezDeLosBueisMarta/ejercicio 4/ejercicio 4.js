function fizzBuzzTipico(n1,n2){
    let arrayNumeros=[];
    if(n1>n2){
        for (n1 ;  n1 < n2; n1++) {
            arrayNumeros=arrayNumeros.push(n1);
        }
    }else{
        for (n2 ;  n2 < n1; n2++) {
            arrayNumeros=arrayNumeros.push(n2);
        }
    }

    console.log(arrayNumeros)
     
    let arrayFizzBuzz=[];
    for (let numero of arrayNumeros) {
        if(numero%3==0 && numero%5==0){
            arrayFizzBuzz.push("FizzBuzz");
        }else if(numero % 3==0){
            arrayFizzBuzz.push("Fizz");
        }else if(numero%5==0){
            arrayFizzBuzz.push("Buzz");
        }else{
            arrayFizzBuzz.push(numero);
        }
    }

    return arrayFizzBuzz;
}

console.log(fizzBuzzTipico(4,16));