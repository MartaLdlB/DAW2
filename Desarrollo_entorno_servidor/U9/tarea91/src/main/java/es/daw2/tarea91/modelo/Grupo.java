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
@Entity

// JPA: Especifica que esta entidad se mapeará a la tabla "Alumno" en la base de datos.
@Table(name = "Grupo")
public class Grupo {
    @Id @GeneratedValue
    private Long id;

    @Column(columnDefinition = "varchar(25)") //Si no le indicamos un nombre, pone por defecto el nombre del atributo
    private String ies;

    @Column(columnDefinition = "varchar(25)")
    private String ciclo;

    @Column(columnDefinition = "integer default 1")
    private Integer curso;

}
