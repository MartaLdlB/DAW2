function Betis(){
    this.escudo = `<img src="img/EscudoBetis.png" alt="escudo">`;

    this.mostrar = function(){
        let div = document.getElementById("div");
        div.innerHTML = this.escudo;
    }

    this.borrar = function(){
        let div = document.getElementById("div");
        div.innerHTML = "";
    }

    this.parpadear = function(){
        let numero = 0;
        setInterval( ()=>{
            if(numero == 0){
                this.mostrar();
                numero=1;
            }else{
                this.borrar();
                numero=0;
            }
        }  ,1000);
    }
}

let betis = new Betis();

let botonMostrar = document.getElementById("mostrarEscudo");
botonMostrar.addEventListener("click", ()=>betis.mostrar());

let botonBorrar = document.getElementById("quitarEscudo");
botonBorrar.addEventListener("click", ()=>betis.borrar());

let botonParpadear = document.getElementById("parpadear");
botonParpadear.addEventListener("click", ()=>betis.parpadear());
