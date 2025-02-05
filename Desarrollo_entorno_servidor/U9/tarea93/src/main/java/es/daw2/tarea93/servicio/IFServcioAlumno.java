package es.daw2.tarea93.servicio;

import java.util.List;

import es.daw2.tarea93.modelo.Alumno;
import es.daw2.tarea93.modelo.Grupo;


public interface IFServcioAlumno{
    
    public abstract List<Grupo> listaAlumno();
    public abstract Grupo borrarAlumno(Alumno a);
}
