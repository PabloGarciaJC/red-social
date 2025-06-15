# Red Social 

**Red Social** es una plataforma diseñada para fomentar la comunicación e interacción social en tiempo real entre usuarios, utilizando **WebSocket** para una experiencia dinámica y fluida.

El proyecto combina funcionalidades modernas con un diseño intuitivo, aplicando buenas prácticas para garantizar seguridad, escalabilidad y rendimiento óptimo.

Esta aplicación permite a los usuarios conectarse, chatear y compartir contenido instantáneamente, simulando una red social moderna y responsive.

### Demo del Proyecto  
[https://red-social-app.pablogarciajc.com/](https://red-social-app.pablogarciajc.com/)

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

## Contáctame / Sígueme en mis redes sociales

| Red Social   | Descripción                                              | Enlace                   |
|--------------|----------------------------------------------------------|--------------------------|
| **Facebook** | Conéctate y mantente al tanto de mis actualizaciones.    | [Presiona aquí](https://facebook.com/tu-usuario) |
| **YouTube**  | Fundamentos de la programación, tutoriales y noticias.   | [Presiona aquí](https://youtube.com/tu-canal)     |
| **Página Web** | Más información sobre mis proyectos y servicios.        | [Presiona aquí](https://tusitio.com)              |
| **LinkedIn** | Sigue mi carrera profesional y establece conexiones.     | [Presiona aquí](https://linkedin.com/in/tu-usuario) |
| **Instagram**| Fotos, proyectos y contenido relacionado.                 | [Presiona aquí](https://instagram.com/tu-usuario) |
| **Twitter**  | Proyectos, pensamientos y actualizaciones.                | [Presiona aquí](https://twitter.com/tu-usuario)   |

---
> _"El buen manejo de tus finanzas hoy construye la seguridad del mañana."_
