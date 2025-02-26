package es.daw2.tarea93.servicio;

import java.util.List;
import java.util.Optional;

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
        return (List<Alumno>) repositorioAlumno.findAll();
    }

    @Override
    public Alumno borrarAlumno(Alumno a) {
        repositorioAlumno.delete(a);
        return a;
    }

    public Optional<Alumno> obtenerAlumnoPorId(Long id) {
        return repositorioAlumno.findById(id);
    }

    public Alumno crearAlumno(Alumno alumno) {
        alumno = repositorioAlumno.save(alumno);
        return alumno;
    }

    public Alumno actualizarAlumno(Long id, Alumno alumno) {
        if (repositorioAlumno.existsById(id)) {
            alumno.setIdAlumno(id);
            return repositorioAlumno.save(alumno);
        } else {
            return null;
        }
    }
}