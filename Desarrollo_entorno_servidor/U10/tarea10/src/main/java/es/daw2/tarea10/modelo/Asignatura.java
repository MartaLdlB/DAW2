package es.daw2.tarea10.modelo;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@AllArgsConstructor
public class Asignatura {
    private String nombre; //nombre de la asignatura
    private String ciclo; //nombre del ciclo al que pertenece el modulo
    private int horas; //horas lectuvas por curso
    private int curso; //curso 1º o 2º al que pertenezca



    //calcular las horas que tendra la asignatura por trimestre en funcion al curso
    public int obtenerHorasTrimestre(){
        int horasTrim=0;
        if(this.curso==1){
            horasTrim=this.horas/3;
        }else if (this.curso==2) {
            horasTrim=this.horas/2;
        }
        return horasTrim;
    }
}
