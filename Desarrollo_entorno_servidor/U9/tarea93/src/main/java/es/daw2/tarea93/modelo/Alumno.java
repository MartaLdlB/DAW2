package es.daw2.tarea93.modelo;

import com.fasterxml.jackson.annotation.JsonIgnore;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.Table;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@AllArgsConstructor
@Entity
@Table(name = "Alumno")
public class Alumno {

    @Id @GeneratedValue
    private Long idAlumno;

    @Column(name = "NOMBRE", nullable = false, columnDefinition="varchar(25)")
    private String nombre;

    @Column(name = "APELLIDOS", nullable = false, columnDefinition="varchar(120)")
    private String apellidos;

    @Column(name = "EMAIL", nullable = false, columnDefinition="varchar(120)")
    private String email;

    @ManyToOne
    @JsonIgnore
    @JoinColumn(name="idGrupo", referencedColumnName = "idGrupo")
    private Grupo grupo;
}