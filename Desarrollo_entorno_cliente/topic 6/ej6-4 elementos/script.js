let ejemplo1 = document.getElementById('ejemplo-1');

setTimeout(() => {
    /* Insertar elementos */
    let parrafo1 = document.createElement('p');

    let contenido1 = document.createTextNode('¡Hola, ');
    let contenido2 = document.createTextNode('mundo');
    let contenido3 = document.createTextNode('! (inspecciona el HTML)');

    let fuerte = document.createElement('strong');
    fuerte.appendChild(contenido2);

    parrafo1.appendChild(contenido1);
    parrafo1.appendChild(fuerte);
    parrafo1.appendChild(contenido3);

    ejemplo1.appendChild(parrafo1);

    /* Insertar comentarios */
    let comentario = document.createComment('Este es un comentario en el HTML añadido con JavaScript.');

    ejemplo1.appendChild(comentario);
}, 2000);


setTimeout(() => {
    /* Borrar elementos */
    let elemento = document.getElementById('temporal');

    elemento.parentNode.removeChild(temporal);
}, 4000);


let parrafosEjemplo1 =
    ejemplo1.getElementsByTagName('p');

setTimeout(() => {
    /* Insertar un elemento delante de otro */
    let parrafo2 = document.createElement('p');
    parrafo2.textContent = 'Este párrafo se ha creado después del saludo.';

    ejemplo1.insertBefore(parrafo2, parrafosEjemplo1[0]);
    //ejemplo1.insertBefore(parrafo2, parrafo1); // error: el párrafo1 no existe en este bloque
}, 6000);

setTimeout(() => {
    /* Reemplazar elementos */
    let parrafo3 = document.createElement('p');
    parrafo3.textContent = 'Este párrafo ha sustituído a otro. (recuerda inspeccionar el HTML)';
    
    ejemplo1.replaceChild(parrafo3, parrafosEjemplo1[1]);
}, 8000);

