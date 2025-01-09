function Carta(palo, valor) {

    this.darValor = (palo, valor) => {

        if (isNaN(palo) || palo < 1 || palo > 4) {
            return null;
        }
        if (isNaN(valor) || valor < 1 || valor > 10) {
            return null;
        }
        
        //palo
        switch (palo) {
            case 1:
                this.palo = "oros";
                break;
            case 2:
                this.palo = "espadas";
                break;
            case 3:
                this.palo = "bastos";
                break;
            case 4:
                this.palo = "copas";
                break;
        }

        //valor
        switch (valor) {
            case 1:
                this.valor = "As";
                break;
            case 8:
                this.valor = "Sota";
                break;
            case 9:
                this.valor = "Caballo";
                break;
            case 10:
                this.valor = "Rey";
                break;
            default:
                this.valor = valor;
        }
    }

    
    this.toString = function () {
    return this.valor +' de '+ this.palo;
    };
    this.darValor(palo, valor);
}

function Baraja() {
    //array para guardar las cartas
    const cartas = [];

    
    for (let palo = 1; palo <= 4; palo++) {
        for (let valor = 1; valor <= 10; valor++) {
            cartas.push(new Carta(palo, valor));
        }
    }

    
    this.barajar = function () {
        let original;
        let random1;
        let random2;

        for (let i = 0; i < cartas.length * 2; i++) {
            random1 = Math.floor(Math.random() * (cartas.length));
            random2 = Math.floor(Math.random() * (cartas.length));
            original = cartas[random1];
            cartas[random1] = cartas[random2];
            cartas[random2] = original;
        }
    };

    
    this.toString = function () {
        return cartas.map(carta => carta.toString()).join(", ");
    };
}


const baraja = new Baraja();
console.log("Baraja inicial:");
console.log(baraja.toString());

console.log("\nBarajamos:");
baraja.barajar();
console.log(baraja.toString());
