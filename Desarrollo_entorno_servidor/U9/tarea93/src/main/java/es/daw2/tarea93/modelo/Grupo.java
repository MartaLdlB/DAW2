package es.daw2.tarea93.modelo;

import java.util.List;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.Id;
import jakarta.persistence.OneToMany;
import jakarta.persistence.Table;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@AllArgsConstructor
@Entity
@Table(name = "Grupo")
public class Grupo {
    @Id @GeneratedValue
    private Long idGrupo;

    @Column(columnDefinition = "varchar(25)")
    private String ies;

    @Column(columnDefinition = "varchar(25)")
    private String ciclo;

    @Column(columnDefinition = "integer default 1")
    private Integer curso;

    @OneToMany(mappedBy="grupo") //cogemos el nombre dado al instanciar la clase
    private List<Alumno> alumnos;
}