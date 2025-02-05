package es.daw2.tarea93.repositorio;

import org.springframework.data.repository.CrudRepository;

import es.daw2.tarea93.modelo.Alumno;

public interface RepositorioAlumno extends CrudRepository<Alumno, Long>{

    /*
     * Un repositorio provee las funciones basicas de un CRUD
     * CREATE: save(argumento)
     * READ: findAll(arugmento)
     * READ: findById(argumento)
     * UPDATE: no tiene.
     * DELETE: delete().
     * etc... hay otros.
     */
}
