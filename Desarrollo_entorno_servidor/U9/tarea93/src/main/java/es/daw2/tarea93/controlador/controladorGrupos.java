package es.daw2.tarea93.controlador;
import org.springframework.web.bind.annotation.RestController;

import es.daw2.tarea93.modelo.Grupo;
import es.daw2.tarea93.servicio.ServicioGrupo;

import java.net.URI;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;

//El controlador maneja la las peticiones http y la logica de las peticiones


@RestController
public class controladorGrupos {



/*
  * obtener todos los Grupos | obtenerGrupos() [x]
  * obtener un grupo dado su id | obtenerGrupo() [x]
  * añadir un grupo sin alumnos | crearGrupoVacio()
  * añadir un grupo con alumnos | crearGrupo()
  * actualizar los datos del grupo idGrupo. manteniendo su lista de alumnos anterior | actualizarGrupo
  * borrar el grupo idGrupo, sólo si no tiene alumnos | borrarGrupo()
*/

    @Autowired
    private ServicioGrupo servicioGrupo;

    @GetMapping("/grupos")
    public ResponseEntity<?> obtenerGrupos() {
        Iterable<Grupo> it = null;
        it = servicioGrupo.listaGrupo();

        if(it==null){
            return ResponseEntity.badRequest().body("nononono");
        }

        return ResponseEntity.ok(it);
    }

    @GetMapping("/grupos/{id}")
    public ResponseEntity<Grupo> getGrupoId(@PathVariable Long id) {
        Grupo grupo = servicioGrupo.obtenerGrupoPorId(id);
        
        //
        return ResponseEntity.ok(grupo);
    }
    
    @PostMapping("/crearGrupoVacio")
    public ResponseEntity<Grupo> crearGrupoVacio(@RequestBody Grupo grupo) { //grupo vacio de alumnos jijiji
        //@RequestBody -> mapea un grupo desde el cuerpo de la peticion

        System.out.println(grupo);
        if (grupo.getIdGrupo() != null) {
            //TODO lanza excepcion
        }

        if (grupo.getAlumnos() != null){
            //TODO lanza la excepcion de guarra que tiene
        }

        grupo = servicioGrupo.crearGrupoVacio(grupo);

        //El objeto URI es un string con una direccion o recurso concreto, enviando esta URI que creamos puedes obtener el grupo con el ID que proporciones
        URI direccion = URI.create("grupos/" + grupo.getIdGrupo());
        return ResponseEntity.created(direccion).body(grupo);
    }
    
}
