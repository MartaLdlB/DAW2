package es.daw2.tarea93.servicio;

import java.util.List;

import es.daw2.tarea93.modelo.Grupo;

public interface IFSeervicioGrupo {

    public abstract List<Grupo> listaGrupo();
    public List<Grupo> listarGruposPorIes(String ies);
    public abstract Grupo borrarGrupo(Grupo g);
    public abstract Grupo anioDeGrupo(Grupo g);

}
