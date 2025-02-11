package es.daw2.tarea10.controlador;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;



@Controller
@RequestMapping("/")
public class ControladorIndex {

    public String abrir(){
        return "index"; //index es la vista (index.html)
    }

}
