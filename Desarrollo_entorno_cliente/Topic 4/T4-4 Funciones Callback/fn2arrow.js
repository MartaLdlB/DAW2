console.log("%c--> function2arrow <--","color:blue; font-size:14px");
/*
** EN ESTE ARCHIVO HAY FUNCIONES CALLBACK DECLARATIVAS. 
** EDÍTALAS PARA QUE SEAN FUNCIONES CALLBACK FLECHA.
*/

// 1.1. multiply
/*function multiply(a, b) {
    console.log(`1. Product:\n${a} x ${b} = ${a * b}`);
}*/

const multiply = (a,b)=>console.log(`1. Product:\n${a} x ${b} = ${a * b}`);

/*
function getProduct(fn) {
    const n1 = prompt("Introduzca un número", 2);
    const n2 = prompt("Introduzca otro número", 3);
    fn(n1, n2);
}
*/

const getProduct = (fn) => {
    const n1 = prompt("Introduzca un número", 2);
    const n2 = prompt("Introduzca otro número", 3);
}


getProduct(multiply);


// 1.2. getNames
const employees = [
    {
        id: 101,
        name: 'Alex',
        sal: 10000
    },
    {
        id: 102,
        name: 'Clark',
        sal: 13000
    },
    {
        id: 103,
        name: 'John',
        sal: 12000
    },
    {
        id: 104,
        name: 'Tony',
        sal: 20000
    }
];
function getNames(employee) {
    return employee.name;
}
const names = employees.map(getNames);
console.log('2. Employee names:\n' + names); //esto debes mantenerlo
