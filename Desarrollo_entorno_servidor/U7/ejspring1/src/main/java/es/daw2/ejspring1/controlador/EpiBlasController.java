package es.daw2.ejspring1.controlador;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class EpiBlasController {
    
        @GetMapping("/dialogo") //ruta donde se va a mostrar este mensaje
        public String dialogo(){
            return "que tal Blas";
        }

}

