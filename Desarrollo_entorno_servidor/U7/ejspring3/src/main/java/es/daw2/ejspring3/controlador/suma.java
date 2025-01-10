package es.daw2.ejspring3.controlador;

import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;


@RestController
public class suma {

        @GetMapping("/suma/{numero1}/{numero2}") //entre llaves indicamos donde vamos a "crear" las variables que se van a pasar, estas variables se tienen que llamar igual que las de abajo
        public String sumatorio(@PathVariable int numero1, @PathVariable int numero2){ //con @PathVariable le indicamos que cogemos los datos de la ruta (url)
            return String.valueOf(numero1+numero2);
        }

}
