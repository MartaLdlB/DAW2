# 1. Usar una imagen base de OpenJDK
FROM openjdk:17-jdk-slim

# 2. Establecer el directorio de trabajo dentro del contenedor
WORKDIR /app

# 3. Copiar el archivo JAR generado dentro del contenedor
COPY target/mi-aplicacion.jar app.jar

# 4. Exponer el puerto en el que corre la aplicación
EXPOSE 8080

# 5. Ejecutar la aplicación cuando el contenedor se inicie
ENTRYPOINT ["java", "-jar", "app.jar"]
