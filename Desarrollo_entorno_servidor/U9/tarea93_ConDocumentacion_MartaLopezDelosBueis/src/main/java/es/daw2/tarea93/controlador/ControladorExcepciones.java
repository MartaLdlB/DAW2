package es.daw2.tarea93.controlador;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.bind.annotation.RestControllerAdvice;

import es.daw2.tarea93.excepciones.GrupoConAlumnosException;
import es.daw2.tarea93.excepciones.GrupoConIdException;
import es.daw2.tarea93.excepciones.GrupoExistenteException;
import es.daw2.tarea93.excepciones.GrupoNoEncontradoException;
import es.daw2.tarea93.excepciones.GrupoNoPuedeEstarVacioException;
import es.daw2.tarea93.excepciones.NoExisteEseIesEnGruposException;


@RestControllerAdvice //esta anotacion es la de excepciones, si hay una excepcion este te dice eh aqui estoy yo
public class ControladorExcepciones {

    //esta anotacion permite manejar excepciones de manera personalizada
    @ExceptionHandler(GrupoNoEncontradoException.class) //esta anotacion recibe como parametro la clase
    public ResponseEntity<String> grupoNoEncontrado() {
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body("No se ha encontrado el grupo");
        //return ResponseEntity.notFound().build();
    }

    @ExceptionHandler(GrupoExistenteException.class)
    public ResponseEntity<String> grupoExistente(){
        return ResponseEntity.status(HttpStatus.CONFLICT).body("Ya hay un grupo con estos parametros");
    }

    @ExceptionHandler(GrupoConAlumnosException.class)
    public ResponseEntity<String> grupoConAlumnos(){
        return ResponseEntity.status(HttpStatus.CONFLICT).body("El grupo contiene alumnos");
    }

    @ExceptionHandler(GrupoConIdException.class)
    public ResponseEntity<String> grupoConId(){
        return ResponseEntity.status(HttpStatus.CONFLICT).body("El grupo que das no puede llevas un ID");
    }

    @ExceptionHandler(GrupoNoPuedeEstarVacioException.class)
    public ResponseEntity<String> grupoNoPuedeEstarVacio(){
        return ResponseEntity.status(HttpStatus.CONFLICT).body("El grupo que das no puede estar vacio");
    }

    @ExceptionHandler(NoExisteEseIesEnGruposException.class)
    public ResponseEntity<String> noExisteEseIes(){
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body("El IES proporcionado no existe en ningun grupo");
    }

}
