package es.daw2.tarea85.servicio;

import java.util.List;

import org.springframework.stereotype.Service;

import es.daw2.tarea85.modelo.Ciclo;
@Service
public class servicioGrupo {

    public List<Ciclo> obtenerCiclosPorIes(String ies){
        //
        List<Ciclo> listaCiclosDeIes = null; //por si piden un ies que no tenemos
        if(ies.equalsIgnoreCase("Ventura")){
            listaCiclosDeIes = List.of(
                new Ciclo("DAW", "Informatica", 0),
                new Ciclo("DAW", "Informatica", 2),
                new Ciclo("DAW", "Informatica", 4)
                );
            }else if(ies.equalsIgnoreCase("Los Alamos")){
                listaCiclosDeIes = List.of(
                new Ciclo("Marketing", "nadie sabe", 0),
                new Ciclo("DAM", "Informatica", 2),
                new Ciclo("ASIR", "Informatica", 2)
                );
            }else if(ies.equalsIgnoreCase("Zayas")){
                listaCiclosDeIes = List.of(
                new Ciclo("Marketing", "nadie sabe", 3),
                new Ciclo("DAW", "Informatica", 2),
                new Ciclo("SMR", "Informatica", 1)
                );
        }
        return listaCiclosDeIes;
    }

}
