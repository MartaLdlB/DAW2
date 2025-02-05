package es.daw2.tarea93.repositorio;

import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import es.daw2.tarea93.modelo.Grupo;

@Repository
public interface RepositorioGrupo extends CrudRepository<Grupo, Long>{

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
