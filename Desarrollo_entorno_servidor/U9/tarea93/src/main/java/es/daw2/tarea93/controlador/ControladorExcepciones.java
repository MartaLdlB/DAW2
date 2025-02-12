package es.daw2.tarea93.controlador;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.bind.annotation.RestControllerAdvice;

import es.daw2.tarea93.excepciones.GrupoExistenteException;
import es.daw2.tarea93.excepciones.GrupoNoEncontradoException;


@RestControllerAdvice //esta anotacion es la de excepciones, si hay una excepcion este te dice eh aqui estoy yo
public class ControladorExcepciones {

    @ExceptionHandler(GrupoNoEncontradoException.class) //esta anotacion recibe como parametro la clase
    public ResponseEntity<String> grupoNoEncontrado() {
        //Podemos usar cualquiera de los dos returns jijiji el primero es mas chulo
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body("No se ha encontrado el grupo");
        //return ResponseEntity.notFound().build();
    }

    @ExceptionHandler(GrupoExistenteException.class)
    public ResponseEntity<String> grupoExistente(){
        return ResponseEntity.status(HttpStatus.CONFLICT).body("Ya hay un grupo con estos parametros");
    }

}
