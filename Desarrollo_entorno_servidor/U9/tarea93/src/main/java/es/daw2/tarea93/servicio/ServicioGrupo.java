package es.daw2.tarea93.servicio;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;

import es.daw2.tarea93.modelo.Grupo;
import es.daw2.tarea93.repositorio.RepositorioGrupo;

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
        
    }

    @Override
    public List<Grupo> listarGruposPorIes(String ies) {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'listarGruposPorIes'");
    }
}
    