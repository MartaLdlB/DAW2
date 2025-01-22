package es.daw2.tarea82.modelo;

import io.micrometer.common.lang.NonNull;
import lombok.Data;


@Data
public class Grupo {
    
    @NonNull
    private String ies;
    @NonNull
    private String ciclo;
    private String curso;


    //constructor
    public Grupo(String ies, String ciclo, String curso) {
        this.ies = ies;
        this.ciclo = ciclo;
        this.curso = curso;
    }
}


