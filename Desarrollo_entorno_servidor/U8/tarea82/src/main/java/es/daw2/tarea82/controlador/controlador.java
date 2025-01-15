package es.daw2.tarea82.controlador;

import java.util.ArrayList;
import java.util.List;

import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RestController;

import es.daw2.tarea82.modelo.Grupo;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.PutMapping;


@RestController
public class controlador {

    ArrayList<Grupo> grupos = new ArrayList<>(
        List.of(
            new Grupo("IES1", "DAW", "1"),
            new Grupo("IES2", "DAW", "2"),
            new Grupo("IES3", "DAW", "2")
        )
    );
        
        @GetMapping("/grupos")
        public ArrayList<Grupo> listarGrupos() {
            return this.grupos;
        }

        @GetMapping("/grupos/{ies}")
        public ArrayList<Grupo> grupoDeUnIes (@PathVariable String ies) {
        ArrayList<Grupo> nuevoGrupo = new ArrayList<>();
        for (Grupo g : grupos) {
            if (g.getIes().equalsIgnoreCase(ies)) {
                nuevoGrupo.add(g);
            }
        }
            return nuevoGrupo;
        }

        @PostMapping("/CrearGrupos")
        public void crearGrupo(@RequestBody Grupo g){
            grupos.add(g);
        }
        
        @PutMapping("/actualizarGrupo")
        public Grupo actualizarGrupo(@RequestBody Grupo g) {
            for (Grupo grupo : grupos) {
                if (grupo.getIes().equalsIgnoreCase(g.getIes())) {
                    //actualizamos el grupo
                    grupo.setCiclo(g.getCiclo());
                    grupo.setCurso(g.getCurso());
                }
            }
            //devolvemos el grupo actualizado
            return g;
        }

        @DeleteMapping("/borrarGrupo/{ies}")
        public void borrarGruposDeUnIes (@PathVariable String ies){
            for (Grupo g : grupos) {
                //comparamos el ies que se da con el que esta en el arraylist
                if (g.getIes().equalsIgnoreCase(ies)) {
                    grupos.remove(g);
                    
                }
            }
        }

}


