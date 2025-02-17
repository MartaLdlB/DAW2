package es.daw2.tarea93.servicio;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.daw2.tarea93.excepciones.GrupoExistenteException;
import es.daw2.tarea93.excepciones.GrupoNoEncontradoException;
import es.daw2.tarea93.modelo.Grupo;
import es.daw2.tarea93.repositorio.RepositorioGrupo;

//el servicio se encarga de la logica de negocio (la logica de tu aplicacion)

@Service //interfaz que es un BEAN que te permite usar @autowired
public class ServicioGrupo implements IFSeervicioGrupo{
    @Autowired
    RepositorioGrupo repositorioGrupo;

    @Override
    public Grupo borrarGrupo(Grupo g) {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'borrarGrupo'");
    }

    @Override
    public Grupo anioDeGrupo(Grupo g) {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'anioDeGrupo'");
    }

    @Override
    public List<Grupo> listaGrupo() {
        Iterable<Grupo> todos= repositorioGrupo.findAll();
        throw new UnsupportedOperationException("Unimplemented method 'anioDeGrupo'");
        
    }

    @Override
    public List<Grupo> listarGruposPorIes(String ies) {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'listarGruposPorIes'");
    }

    public Grupo obtenerGrupoPorId(Long id) {
        //optional=obliga a comprobar que se ha enviado un objeto o no puta
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
        //Para que no se generen grupos iguales con distinto id, ejemplo IES VENTURA solo tiene una clase de DAW 2
        //la clase existsByIesAndCicloAndCurso() tiene esa sintaxis especifica para que funciones
        
        if (repositorioGrupo.existsByIesAndCicloAndCurso(grupo.getIes(), grupo.getCiclo(), grupo.getCurso())) {
            throw new GrupoExistenteException();
        }

        grupo = repositorioGrupo.save(grupo);//Guarda los datos y te devuelve el objeto grupo tal y como esta en la base de datos
        
        return grupo;
    }

}
    