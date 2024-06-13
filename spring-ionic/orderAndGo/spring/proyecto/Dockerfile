# Dockerfile para la aplicación Spring Boot

# Usar una imagen base de Java
FROM openjdk:17-jdk-alpine

# Establecer el directorio de trabajo para la aplicación Spring Boot
WORKDIR /app

# Copiar el JAR de la aplicación Spring Boot al contenedor
COPY target/proyecto-0.0.1-SNAPSHOT.jar proyecto.jar


CMD ["java", "-jar", "proyecto.jar"]
