package es.daw2.tarea93.servicio;

import java.util.List;

import es.daw2.tarea93.modelo.Alumno;


public interface IFServcioAlumno{
    
    public abstract List<Alumno> listaAlumno();
    public abstract Alumno borrarAlumno(Alumno a);
}
