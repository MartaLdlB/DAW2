//objeto literal
let persona = {
  nombre: {
      pila: 'Jane',
      apellido: 'Doe'
  },
  edad: 30,
  genero: 'femenino',
  intereses: ['programación', 'teatro'],
  bio: function () {
    document.write(this.nombre.pila + ' tiene ' + this.edad + ' años. Le gusta ' + this.intereses[0] + ' y ' + this.intereses[1] + '.'+ '<br>');
  },
  saludo: function() {
    alert('Hola, soy '+ this.nombre.pila + '.');
  }
};
// Acceso a propiedades
persona.nombre.pila
persona.edad
persona.intereses[1]
persona.bio()
persona.saludo()


//objeto con constructor

function Persona (pila, apellido, edad, genero, intereses){
  this.nombre= {
    pila: pila,
    apellido: apellido
  }
  this.edad=edad;
  this.genero=genero;
  this.intereses=intereses;
  //metodos
  this.bio = function(){
    document.write(this.nombre.pila + ' tiene '+ this.edad + 'años. Le gusta '+ this.intereses+ '<br>');
  }
  this.saludo = function(){
    alert('Hola, soy ' + this.nombre.pila + ' ' + this.nombre.apellido+ '.');
  }
}

let persona1 = new Persona('Marta', 'Lopez', 24, 'Mujer', ['leer','llorar','dormir']);

document.write(persona1.nombre.pila+'<br>');
document.write(persona1.edad+'<br>');
document.write(persona1.intereses+'<br>');
persona1.saludo();
persona1.bio();
