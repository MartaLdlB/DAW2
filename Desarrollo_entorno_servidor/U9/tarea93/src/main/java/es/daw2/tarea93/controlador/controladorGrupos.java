package es.daw2.tarea93.controlador;
import org.springframework.web.bind.annotation.RestController;

import es.daw2.tarea93.modelo.Grupo;
import es.daw2.tarea93.servicio.ServicioGrupo;


import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;


@RestController
public class controladorGrupos {

    @Autowired
    private ServicioGrupo servicioGrupo;

    @GetMapping("/grupos")
    public ResponseEntity<?> obtenerGrupos() {
        Iterable<Grupo> it = null;
        it = servicioGrupo.listaGrupo();

        if(it!=null){
            return ResponseEntity.ok(it);
        }else{
            return ResponseEntity.badRequest().body("nononono");
        }
    }
    
    
    
}
