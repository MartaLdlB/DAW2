package es.daw2.tarea93.servicio;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.daw2.tarea93.excepciones.GrupoExistenteException;
import es.daw2.tarea93.excepciones.GrupoNoEncontradoException;
import es.daw2.tarea93.excepciones.NoExisteEseIesEnGruposException;
import es.daw2.tarea93.modelo.Grupo;
import es.daw2.tarea93.repositorio.RepositorioGrupo;

//el servicio se encarga de la logica de negocio (la logica de tu aplicacion)

@Service //interfaz que es un BEAN que te permite usar @autowired
public class ServicioGrupo implements IFSeervicioGrupo{
    @Autowired
    RepositorioGrupo repositorioGrupo;

    @Override
    public Grupo borrarGrupo(Grupo grupoBorrar) {
        Optional<Grupo> grupoOptional = repositorioGrupo.findById(grupoBorrar.getIdGrupo());

        if (grupoOptional.isPresent()) {
            repositorioGrupo.deleteById(grupoBorrar.getIdGrupo());
            return grupoOptional.get();  // Retorna el grupo eliminado
        } else {
            return null;  // O puedes lanzar una excepción personalizada
        }
    }

    @Override
    public Grupo anioDeGrupo(Grupo g) {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'anioDeGrupo'");
    }

    @Override
    public List<Grupo> listaGrupo() {
        List<Grupo> todos= (List<Grupo>) repositorioGrupo.findAll();
        return todos;
    }

    @Override
    public List<Grupo> listarGruposPorIes(String ies) {
        //Creamos un iterable de Grupo con todos los grupos para poder recorrer todos los elementos
        Iterable<Grupo> todos = listaGrupo();
        //creamos una lista vacia que va a almacenar los grupos segun el ies
        List<Grupo> todosIes = new ArrayList<>();
        //comprobamos por cada grupo si el ies coincide con el ies dado
        for (Grupo grupo : todos) {
            //En el caso de que coincida se almacena el grupo en la lista
            if(grupo.getIes()==ies){
                todosIes.add(grupo);
            }
        }
        //si al terminar no almacena ningún
        if(todosIes.isEmpty()){
            throw new NoExisteEseIesEnGruposException();
        }
        return todosIes;
    }

    public Grupo obtenerGrupoPorId(Long id) {
        //optional=obliga a comprobar que se ha enviado un objeto o no
        Optional<Grupo>posibleGrupo = repositorioGrupo.findById(id); //esto devuelve un optional de grupo

        if(posibleGrupo.isEmpty()){//en el caso de que el Optional esté vacio, devuelve la excepcion
            throw new GrupoNoEncontradoException();
        }

        //como teniamos un optional, tenemos que sacar de la caja el objeto, por lo que con .get() devolvemos un Grupo
        return posibleGrupo.get();
    }

    public Grupo crearGrupoVacio(Grupo grupo) {
        //Para que no se generen grupos iguales con distinto id, ejemplo IES VENTURA solo tiene una clase de DAW 2
        //la clase existsByIesAndCicloAndCurso() tiene esa sintaxis especifica para que funciones
        
        if (repositorioGrupo.existsByIesAndCicloAndCurso(grupo.getIes(), grupo.getCiclo(), grupo.getCurso())) {
            throw new GrupoExistenteException();
        }

        grupo = repositorioGrupo.save(grupo);//Guarda los datos y te devuelve el objeto grupo tal y como esta en la base de datos
        
        return grupo;
    }

    public Grupo crearGrupo(Grupo grupo) {
        
        grupo = repositorioGrupo.save(grupo);//Guarda los datos y te devuelve el objeto grupo tal y como esta en la base de datos
        
        return grupo;
    }

    public Grupo actualizarGrupo(Grupo grupo) {
        grupo = repositorioGrupo.save(grupo);
        return grupo;
    }

    

}
    