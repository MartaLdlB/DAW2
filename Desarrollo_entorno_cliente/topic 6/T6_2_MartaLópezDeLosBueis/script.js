let enlaces = document.getElementsByTagName("a");
let {href: url} = enlaces[enlaces.length-2]; //Desestructuracion -> {href: url} -> Esto es como si pusiesemos let url = enlaces[enlaces.length-2].href

console.log(url);

let {length: numeroDeEnlaces2} = document.querySelectorAll('a[href="/wiki/ISBN"]'); //let numeroDeEnlaces2 = document.querySelectorAll(a[href="/wiki/ISBN"]).lenght

console.log(numeroDeEnlaces2);