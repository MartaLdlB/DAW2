package es.daw2.tarea91.modelo;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;



// Lombok: Genera automáticamente los métodos getters, setters, toString, equals, y hashCode.
@Data

// Lombok: Genera un constructor sin argumentos (necesario para JPA).
@NoArgsConstructor

// Lombok: Genera un constructor que incluye todos los argumentos.
@AllArgsConstructor

// JPA: Marca esta clase como una entidad que será gestionada por el framework de persistencia.
@Entity//para indicar una clase como una entidad que se mapeará a una tabla en la base de datos

// JPA: Especifica que esta entidad se mapeará a la tabla "Alumno" en la base de datos.
@Table(name = "Alumno")

public class Alumno {

    @Id @GeneratedValue
    private Long id; //será la clave primaria, es un Long para que pueda tener muchos numeros

    @Column(name = "NOMBRE", nullable = false, columnDefinition="varchar(25)")
    private String nombre;

    @Column(name = "APELLIDOS", nullable = false, columnDefinition="varchar(120)")
    private String apellidos;

    @Column(name = "EMAIL", nullable = false, columnDefinition="varchar(120)")
    private String email;

}
