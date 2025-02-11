package es.daw2.tarea10.controlador;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;

import es.daw2.tarea10.modelo.Asignatura;
import org.springframework.web.bind.annotation.GetMapping;

//Endspoints
//abrirAsignatura()
//aniadirAsignatura()

@Controller
public class ControladorAsignaturas {
    Asignatura a = new Asignatura();

    @GetMapping("abrir")
    public String abrirAsignatura(Model modelo) {
        //pedir los datos en un formulario
        modelo.addAttribute("asignatura", a);

        return "formulario"; //vista que recibe los datos, hay que poner el nombre exacto del html que esté en la carpeta templates
                            //no es necesario añadir la etiqueta HTML
    }
    
    @GetMapping("aniadir")
    public String aniadirAsignatura(Model modelo, Asignatura asignatura) {
        modelo.addAttribute("atr_nombre", asignatura.getNombre());
        modelo.addAttribute("atr_ciclo", asignatura.getCiclo());
        modelo.addAttribute("atr_curso", asignatura.getCurso());
        modelo.addAttribute("atr_horas", asignatura.getHoras());
        modelo.addAttribute("atr_horas_trimestre", asignatura.obtenerHorasTrimestre());

        return "formulario"; //vista que recibe los datos
    }
}
