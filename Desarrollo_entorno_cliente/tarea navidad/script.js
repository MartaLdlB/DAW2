/*
Author:

    name: String
    surnames: String[ ]
    books: Book[ ], opcional.
    addBook(Book) -> añade al array de libros un objeto libro.
    getBooks() -> devuelve (return) un array de libros con los libros que ha escrito el autor.
    toString() -> devuelve (return) un texto con el formato: [nombre] [apellido-1] … [apellido-n]

Book:

    title: String
    authors: Author[ ], valor por defecto: {‘Anónimo’, [‘’]}.
    getAuthors() -> devuelve (return) un array de libros con los libros que ha escrito el autor.
    toString() -> devuelve (return) un texto con el formato: [título], escrito por: [autor-1], [autor-2], … y [autor-n]

Library:

    books: Book[ ]
    authors: Author[ ]
    sortAuthors() -> ordena el array de autores por el primer apellido.
    sortBooks() -> ordena el array de libros por el título.
    addBook(Book) ->

Comprueba si los autores del libro están en el array de autores. Si un autor no existe, lo añade a dicho array.
Añade el objeto libro al array de libros.
Añade el libro al array de libros de cada autor.
Solicita ordenar el array de libros y el de autores.
Cuando termina todo, imprime por consola (console.log) una confirmación del libro añadido, los autores modificados y los que han sido añadidos.
searchAuthor(Author) -> busca un autor en el array de autores y, si lo encuentra, devuelve (return) la posición. Si no, devuelve false.
searchBook(Book) -> busca un libro en el array de libros y, si lo encuentra, devuelve (return) la posición. Si no, devuelve false.
getBook(String) -> solicita buscar un libro por su título y, si existe, devuelve (return) el objeto libro. Si no existe, devuelve undefined y avisa por consola (console.warn) de que no existe el libro.
removeBook(Book) -> solicita buscar un libro y, existe, elimina el libro y su hueco. Imprime por consola (console.log) qué libro se ha borrado o si no existía el libro.
*/




/*Funcion constructora de Autor*/

function Author(name, surname){
    this.name = name;
    this.surname = surname;

}

function Book(title, authors){
    this.title = title;
    this.authors = authors;
}