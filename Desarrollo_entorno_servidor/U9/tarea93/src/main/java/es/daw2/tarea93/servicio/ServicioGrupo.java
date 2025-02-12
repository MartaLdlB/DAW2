package es.daw2.tarea93.servicio;

import java.util.List;
import java.util.Optional;
import java.util.stream.StreamSupport;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.daw2.tarea93.excepciones.GrupoExistenteException;
import es.daw2.tarea93.excepciones.GrupoNoEncontradoException;
import es.daw2.tarea93.excepciones.GrupoNoPuedeEstarVacioException;
import es.daw2.tarea93.modelo.Grupo;
import es.daw2.tarea93.repositorio.RepositorioGrupo;

@Service
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
        if(!grupo.getAlumnos().isEmpty()){
            throw new GrupoNoPuedeEstarVacioException(); //en el caso de que tenga alumnos lanza excepcion
        }
        if (repositorioGrupo.existsByIesAndCicloAndCurso(grupo.getIes(), grupo.getCiclo(), grupo.getCurso())) {
            throw new GrupoExistenteException();
        }
        //Comprobar que no existe


        grupo = repositorioGrupo.save(grupo);//Guarda los datos y te devuelve el objeto grupo tal y como esta en la base de datos

        return grupo;
    }

}
    