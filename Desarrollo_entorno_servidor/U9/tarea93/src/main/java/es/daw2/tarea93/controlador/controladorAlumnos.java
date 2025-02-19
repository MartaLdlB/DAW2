package es.daw2.tarea93.controlador;

import org.springframework.web.bind.annotation.RestController;

import es.daw2.tarea93.modelo.Alumno;
import es.daw2.tarea93.modelo.Grupo;
import es.daw2.tarea93.servicio.ServicioAlumno;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestParam;

import java.net.URI;
import java.util.Optional;

//El controlador maneja la las peticiones http y la logica de las peticiones

/*
   * obtener todos los Alumnos | obtenerAlumnos()
   * obtener un alumno dado su id | obtenerAlumno()
   * añadir un alumno y asociarlo a un grupo | crearAlumno()
   * actualizar los datos del alumno idAlumno, incluida su asociación a un grupo | actualizarAlumno()
   * borrar el alumno idAlumno | borrarAlumno()
*/

@RestController
public class controladorAlumnos {

    @Autowired
    private ServicioAlumno servicioAlumno;

    @GetMapping("/obtenerAlumnos")
    public ResponseEntity<?> obtenerAlumnos() {
        Iterable<Alumno> it = servicioAlumno.listaAlumno();

        if (it == null) {
            return ResponseEntity.badRequest().body("No hay alumnos disponibles");
        }

        return ResponseEntity.ok(it);
    }

    @GetMapping("/obtenerAlumno/{id}")
    public ResponseEntity<?> obtenerAlumno(@PathVariable Long id) {
        Optional<Alumno> alumno = servicioAlumno.obtenerAlumnoPorId(id);

        if (alumno.isPresent()) {
            return ResponseEntity.ok(alumno.get());
        } else {
            return ResponseEntity.notFound().build();
        }
    }

    @PostMapping("/crearAlumno")
    public ResponseEntity<?> crearAlumno(@RequestBody Alumno alumno) {
        Alumno nuevoAlumno = servicioAlumno.crearAlumno(alumno);
        URI location = URI.create("/obtenerAlumno/" + nuevoAlumno.getIdAlumno());
        return ResponseEntity.created(location).body(nuevoAlumno);
    }

    @PutMapping("/actualizarAlumno/{id}")
    public ResponseEntity<?> actualizarAlumno(@PathVariable Long id, @RequestBody Alumno alumno) {
        Optional<Alumno> alumnoExistente = servicioAlumno.obtenerAlumnoPorId(id);

        if (alumnoExistente.isPresent()) {
            Alumno actualizado = servicioAlumno.actualizarAlumno(id, alumno);
            return ResponseEntity.ok(actualizado);
        } else {
            return ResponseEntity.notFound().build();
        }
    }

    @DeleteMapping("/borrarAlumno/{id}")
    public ResponseEntity<?> borrarAlumno(@PathVariable Long id) {
        Optional<Alumno> alumno = servicioAlumno.obtenerAlumnoPorId(id);

        if (alumno.isPresent()) {
            servicioAlumno.borrarAlumno(alumno.get());
            return ResponseEntity.ok().build();
        } else {
            return ResponseEntity.notFound().build();
        }
    }
}