package es.daw2.tarea93.controlador;

import org.springframework.web.bind.annotation.RestController;

import es.daw2.tarea93.modelo.Alumno;
import es.daw2.tarea93.modelo.Grupo;
import es.daw2.tarea93.servicio.ServicioAlumno;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;



//El controlador maneja la las peticiones http y la logica de las peticiones

/*
   * obtener todos los Alumnos | obtenerAlumnos()
   * obtener un alumno dado su id | obtenerAlumno()
   * añadir un alumno y asociarlo a un grupo | crearAlumno()
   * actualizar los datos del alumno idAlumno, incluida su asociación a un grupo | actualizarGrupo
   * borrar el alumno idAlumno | borrarAlumno()
*/

@RestController
public class controladorAlumnos {

    @GetMapping("obtenerAlumnos/")
    public ResponseEntity<?> obtenerAlumnos(){

        Iterable<Alumno> it = null;
        it = ServicioAlumno.listaAlumno();

        if(it==null){
            return ResponseEntity.badRequest().body("nononono");
        }

        return ResponseEntity.ok(it);
    }

}
