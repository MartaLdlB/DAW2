// creacion del objeto libro

function Libro (titulo, autor, anioPublicacion, genero, disponible){
    this.titulo = titulo;
    this.autor = autor;
    this.anioPublicacion = anioPublicacion;
    this.genero = genero;
    this.disponible = disponible;

    this. mostrarInfo = function(){
        console.log(`titulo: ${this.titulo} \n autor: ${this.autor} \n anio Publicacion: ${this.anioPublicacion} \n genero: ${this.genero} \n Disponible: ${this.disponible}`);
    }
}

let libro1= new Libro("El Señor de los Anillos", " J.R.R. Tolkien", 1954, " Fantasía", true );

console.log(libro1.mostrarInfo());


