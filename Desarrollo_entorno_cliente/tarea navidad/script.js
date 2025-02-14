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




//Funcion constructora de Autor

function Author(name, surnames) {
    this.name = name;
    this.surnames = surnames;
    this.books = [];
    
    this.addBook = function(book) {
        this.books.push(book);
    };
    
    this.getBooks = function() {
        return this.books;
    };
    
    this.toString = function() {
        return `${this.name} ${this.surnames}`;
    };
}


//Funcion constructora de Book
function Book(title, authors = [new Author('Anónimo', [''])]) {
    this.title = title;
    this.authors = authors; //si no se da un valor pone como por defecto Anonimo
    
    this.getAuthors = function() {
        return this.authors;
    };
    
    this.toString = function() {
        return `${this.title}, escrito por: ${this.authors.map(a => a.toString()).join(', ')}`;
    };
}

//Funcion constructora de Library
function Library() {
    this.books = [];
    this.authors = [];
    
    this.sortAuthors = function() {
        this.authors.sort((a, b) => a.surnames[0].localeCompare(b.surnames[0]));
    };
    
    this.sortBooks = function() {
        this.books.sort((a, b) => a.title.localeCompare(b.title));
    };
    
    this.searchAuthor = function(author) {
        return this.authors.findIndex(a => a.toString() === author.toString());
    };
    
    this.searchBook = function(book) {
        return this.books.findIndex(b => b.title === book.title);
    };
    
}


//Creamos los autores y libros
const autor1 = new Author('Federico', ['García', 'Lorca']);
const libro1 = new Book('La casa de Bernarda Alba', [autor1]);

const autor2 = new Author('Neil', ['Gaiman']);
const libro2 = new Book('Coraline', [autor2]);

const autor3 = new Author('Terry', ['Pratchett']);
const libro3 = new Book('Good Omens', [autor2, autor3]);

const autor4 = new Author('Gloria', ['Fuertes', 'García']);
const libro4 = new Book('Diccionario estrafalario', [autor4]);

const libro5 = new Book('Las mil y una noches');

