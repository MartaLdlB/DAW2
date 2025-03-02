package es.daw2.tarea93.repositorio;

import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import es.daw2.tarea93.modelo.Grupo;

@Repository //marca esta clase como un repositorio
public interface RepositorioGrupo extends CrudRepository<Grupo, Long>{
    //CrudRepository es una interfaz que nos proporciona Spring Data JPA
    

    //Aqui podemos añadir metodos personalizados para hacer consultas a la base de datos
    //Estos metodos deben seguir una nomenclatura concreta para que Spring los reconozca
    public boolean existsByIesAndCicloAndCurso(String ies, String ciclo, Integer curso);
    public boolean existsByIes(String ies);
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
