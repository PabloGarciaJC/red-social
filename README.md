# Aplicación Web de Red Social  

La **Aplicación Web de Red Social** es una plataforma diseñada para fomentar la comunicación y la interacción social entre usuarios, combinando funcionalidades modernas con un diseño intuitivo. Su desarrollo sigue buenas prácticas, asegurando seguridad, escalabilidad y una experiencia fluida para todos los usuarios.

### Demo del Proyecto  
[https://red-social.pablogarciajc.com/login/](https://red-social.pablogarciajc.com/login/)

| ![RedSocial_1](https://pablogarciajc.com/wp-content/uploads/2025/01/red_social_1_webp.webp) | ![RedSocial_2](https://pablogarciajc.com/wp-content/uploads/2025/01/red_social_2_webp.webp) |
|-----------|-----------|

---

## Funcionalidades Principales  

La plataforma incluye diversas funcionalidades para una experiencia enriquecida, organizadas en **módulos clave**:  

- **Diseño Adaptado a Móviles**:  
  - Experiencia optimizada para dispositivos móviles.

- **Autenticación de Usuarios**:  
  - Registro seguro y sencillo.  
  - Recuperación de contraseña a través del correo corporativo.  
  - Notificaciones importantes enviadas a tu correo.  

- **Publicaciones Tiempo Real**:  
  - Crear, editar y eliminar publicaciones.  
  - Comentar y añadir emojis en formato SVG para personalizar contenido.  

- **Comentarios Tiempo Real**:  
  - Comenta, edita o elimina tus aportes en las publicaciones.  
  - Agrega emojis SVG para un toque expresivo.  

- **Edición de Perfil**:  
  - Modifica tu nombre, foto y otros datos personales.  

- **Buscador de Usuarios**:  
  - Encuentra amigos o conecta con nuevas personas fácilmente.  

- **Chat en Tiempo Real**:  
  - Mantente conectado y comunica instantáneamente con tus amigos.  

- **Notificaciones en Tiempo Real**:  
  - Recibe alertas sobre solicitudes de amistad, comentarios y otras interacciones relevantes.  

- **Juegos Integrados**:  
  - Disfruta de una variedad de juegos para tu entretenimiento.

- **Conexión en Tiempo Real**:  
  - Visualiza en tiempo real cuándo tus amigos o usuarios están en línea. 

---

## Tecnologías Utilizadas  

| **Tecnología**           | **Descripción**                                                                                                              |
|--------------------------|------------------------------------------------------------------------------------------------------------------------------|
| **Laravel**              | Framework PHP utilizado para el desarrollo del back-end.                                                                    |
| **Laravel Mix**          | Herramienta para compilar y gestionar assets front-end.                                                                     |
| **Composer**             | Gestor de dependencias en PHP.                                                                                              |
| **Docker (con WSL)**     | Plataforma para contenedores que asegura entornos consistentes en el desarrollo.                                             |
| **Docker Compose**       | Herramienta para ejecutar aplicaciones multi-contenedor.                                                                    |
| **Bootstrap**            | Framework CSS para el diseño responsivo de la interfaz de usuario.                                                          |
| **GitHub**               | Plataforma para control de versiones y colaboración en el código fuente.                                                    |
| **PHPUnit**              | Pruebas unitarias y de integración para asegurar el correcto funcionamiento de la aplicación.                                |
| **Postman**              | Pruebas y documentación de endpoints API.                                                                                   |
| **Make**                 | Automatiza tareas repetitivas como levantamiento de Docker o ejecución de pruebas.                                           |
| **WSL (Ubuntu)**         | Subsystem para Linux en Windows, proporcionando un entorno de desarrollo basado en Linux.                                    |

---

## Créditos  

| **Recurso**                     | **Descripción**                                  | **Enlace**                                                                                   |
|---------------------------------|--------------------------------------------------|---------------------------------------------------------------------------------------------|
| **Plantilla utilizada**         | Diseño basado en NiceAdmin de BootstrapMade.     | [NiceAdmin](https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/)            |
| **Licencia de la plantilla**    | Licencia de uso según las condiciones del autor. | [Licencia](https://bootstrapmade.com/license/)                                              |
| **Emojis SVG**                  | Iconografía para personalizar interacciones.     | [SVG Repo](https://www.svgrepo.com/)                                                        |

---

## Usuarios Ficticios para Pruebas  

| **Nombre**              | **Correo**                | **Contraseña** | **Rol**         |
|-------------------------|---------------------------|----------------|-----------------|
| Liam Martínez           | liam@user.com            | password       | Usuario         |
| Sofía Nakamura          | sofia@user.com           | password       | Usuario         |
| Marco Santis            | marco@user.com           | password       | Usuario         |
| Emilia Fuentes          | emilia@user.com          | password       | Usuario         |

Para la recuperación de contraseña, utiliza el correo de prueba: **testing@pablogarciajc.com**  
Contraseña: **4vy3BONUmJeqVR!**

---

## Instalación  

### Requisitos Previos  

- **Docker** y **Docker Compose** instalados.  
- **Make**: Herramienta para simplificar y automatizar tareas.  

### Pasos de Instalación  

1. Clona el repositorio desde GitHub.  
2. Usa los comandos del archivo **Makefile** para interactuar con la aplicación:  
   - `make init-app`: Configura y levanta los contenedores.  
   - `make up`: Inicia la aplicación.  
   - `make down`: Detiene los contenedores.  
   - `make shell`: Accede al entorno de ejecución del contenedor.  

3. Accede a los siguientes URL:
   - **Aplicación Web**: [http://localhost:8081/](http://localhost:8081/)
   - **PhpMyAdmin**: [http://localhost:8082/](http://localhost:8082/)

---

## Contáctame para más información o preguntas

| Redes Sociales  | Desarrollador de Aplicaciones Web |
| ------------- | ------------- |
| ![Web Icono](https://pablogarciajc.com/wp-content/uploads/2024/04/web.png) | **[www.pablogarciajc.com](https://pablogarciajc.com/)** |
| ![Facebook](https://pablogarciajc.com/wp-content/uploads/2024/04/facebook.png) | **[@pablogarciajc](https://www.facebook.com/PabloGarciaJC)** |
| ![LinkedIn](https://pablogarciajc.com/wp-content/uploads/2024/04/linkedin.png) | **[@pablogarciajc](https://www.linkedin.com/in/pablogarciajc/)** |

> _"El buen trabajo es la solución de hoy, para construir el futuro del mañana."_
