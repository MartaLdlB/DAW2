package es.daw2.tarea93.servicio;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.daw2.tarea93.modelo.Alumno;
import es.daw2.tarea93.repositorio.RepositorioAlumno;


@Service
public class ServicioAlumno implements IFServcioAlumno {
    @Autowired
    RepositorioAlumno repositorioAlumno;

    @Override
    public List<Alumno> listaAlumno() {
        List<Alumno> listaAlumnos = (List<Alumno>) repositorioAlumno.findAll();
        
    }

    @Override
    public Alumno borrarAlumno(Alumno a) {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'borrarAlumno'");
    }
    
}
