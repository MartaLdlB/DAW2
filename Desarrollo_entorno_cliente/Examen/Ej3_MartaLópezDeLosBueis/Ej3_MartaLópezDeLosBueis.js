function Betis(){
    this.energia = 50;
    this.felicidad = 50;
    this.hambre = 50;

    this.comer = function(){
        
        this.energia = Math.min(this.energia+10,100);
        this.hambre = Math.max(this.hambre -20, 0);

    }

    this.jugar = function(){
        
        this.felicidad = Math.min(this.felicidad+15, 100);
        this.energia = Math.max(this.energia-10, 0);

    }

    this.dormir = function(){
        let promesa = Promise.resolve(100);//.then((energia)=>(this.energia=energia));
        setTimeout(
            //Promise.resolve(100).then((energia)=>(this.energia=energia)),
            promesa.then((energia)=>(this.energia=energia)),
        3000);
    }
}

let betis = new Betis();

let botonComer = document.getElementById("comer");
botonComer.addEventListener("click", ()=>{
    betis.comer()
    let p = document.createElement("p");
    p.textContent = `Su felicidad: ${betis.felicidad} \n Su energia ${betis.energia} \nSu hambre ${betis.hambre}`;
    div.appendChild(p);
});

let botonAnimar = document.getElementById("animar");
botonAnimar.addEventListener("click", ()=>{
    betis.jugar();
    let p = document.createElement("p");
    p.textContent = `Su felicidad: ${betis.felicidad} \n Su energia ${betis.energia} \nSu hambre ${betis.hambre}`;
    div.appendChild(p);

    if(betis.energia < 10){
        let nuevoP = document.createElement("p");
        nuevoP.textContent = "¡Betis está muy cansado para animar!";
        div.appendChild(nuevoP);
    }
});

let botonDormir = document.getElementById("dormir")

botonDormir.addEventListener("click", ()=>{
    betis.dormir();
    let p = document.createElement("p");
    p.textContent = `Su felicidad: ${betis.felicidad} \n Su energia ${betis.energia} \nSu hambre ${betis.hambre}`;
    div.appendChild(p);
})
