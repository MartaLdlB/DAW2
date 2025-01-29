setTimeout(() => console.log('Han pasado 5 segundos'), 5000);

console.log('¿Está la palabra \'objeto\'?\n' + find('objeto'));

let altura = document.getElementById('apuntes').clientHeight;
console.log(altura);
window.scrollTo(0, altura);
window.scrollBy(0, 80);
console.log(window.scrollY);

console.log('Pantalla completa:\n' + window.fullScreen); //solo soportado en FireFox