package es.daw2.tarea93.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import io.swagger.v3.oas.models.OpenAPI;
import io.swagger.v3.oas.models.info.Info;

/*
 * Swagger en tu aplicación Spring Boot.
 * Swagger es una herramienta que te permite generar documentación interactiva para tu API REST
 */
@Configuration
public class SwaggerConfig {

    @Bean
    public OpenAPI customOpenAPI() {
        return new OpenAPI()
                .info(new Info()
                .title("Documentacion de la API")
                .version("1.0")
                .description("Documentación de la API"));
    }
}