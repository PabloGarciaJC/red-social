
# Aplicación Web - Red Social

**Aplicación Web - Red Social** tiene como objetivo principal fortalecer mis habilidades y destrezas como profesional. Al priorizar la accesibilidad y la facilidad de uso para una amplia gama de usuarios, busco crear una experiencia en línea satisfactoria para ellos. Para lograr esto, me enfocaré en incluir funcionalidades y herramientas que fomenten la interacción y la comunicación entre los usuarios, así como en personalizar la experiencia para cada uno de ellos. Este proyecto será parte integral de mi portafolio y demostrará mi dedicación a la creación de productos intuitivos y accesibles para los usuarios.

</br>

| ![RedSocial_1](https://pablogarciajc.com/wp-content/uploads/2024/03/pablogarciajc-aplicacion-web-red-social-img1.webp) | ![RedSocial_2](https://pablogarciajc.com/wp-content/uploads/2024/03/pablogarciajc-aplicacion-web-red-social-img2.webp) |
|-----------|-----------|



## Funcionaliades

La aplicación cuenta con **diez módulos:**

**Módulo de Autenticación de Usuarios:**

* Permite a los usuarios iniciar sesión en la red social mediante el proceso de autenticación.

**Módulo de Registro de Usuarios:**

* Permite a los usuarios registrarse en la red social y crear una cuenta.
* También incluye la opción de recuperación de contraseña a través de un servidor externo.

**Módulo de Búsqueda:**

* Permite a los usuarios buscar otros usuarios en la red social mediante un filtrado por alias, nombre y apellido. Además, incluye una miniatura del avatar del usuario y su alias para una mejor identificación.

**Módulo de Perfiles:**

* Permite a los usuarios personalizar sus perfiles con información y una imagen de avatar.

**Módulo de Conectividad:**

* Permite a los usuarios buscar y conectarse con otros usuarios en la red social, agregándolos como amigos.

**Módulo de Mensajería:**

* Permite a los usuarios enviar mensajes y chatear en tiempo real con otros usuarios en la red social.

**Módulo de Publicaciones:**

* Permite a los usuarios publicar comentarios con o sin imagen en la red social. También incluye un sistema de like/dislike y la opción de borrar publicaciones para los usuarios que las han creado.

**Módulo de Comentarios:**

* Permite a los usuarios crear comentarios con o sin imagen en las publicaciones de la red social.

**Módulo de Contactos:**

* Muestra los amigos que han aceptado la solicitud de amistad y proporciona información en tiempo real sobre su conexión/desconexión.

**Módulo de Notificaciones:**

* Avisa a los usuarios sobre solicitudes de amistad enviadas y canceladas en la red social

## Tecnologías

La aplicación web se desarrolla con Framework Laravel 8. [ver documentación](https://laravel.com/docs/8.x)

**Front-end:**

* Bootstrap v4.0.0: [plantilla](https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/) que mejora la apariencia y la experiencia del usuario.
* JavaScript: lenguaje de programación que permite agregar funcionalidades dinámicas a la aplicación web.
* JQuery: biblioteca de JavaScript que facilita la manipulación del DOM y la realización de solicitudes HTTP.
* Axios: biblioteca de JavaScript que permite realizar solicitudes HTTP.

**Back-end:**

* Se utiliza PHP 7.3.5 como lenguaje de programación.
* Query Builder: es una herramienta de construcción de consultas que permite a los desarrolladores crear y ejecutar consultas SQL de manera fluida segura en la base de datos.
* ORM: eloquent: sistema de mapeo de objetos relacionales que permite interactuar con una base de datos.

**API:**

* La documentación se puede encontrar en la URL: "{PUBLIC_URL}/api/followers/"

**API Endpoints:**

| HTTP   | Endpoints        | Acción        |
| ----------- | -----------------|----------------- |
| GET         | /api/followers/  | obtiene la lista de todas los seguidores |
| GET         | /api/followers/{id}  | obtiene la lista de todas los seguidores por id |

**Recursos:**

* Pusher es una plataforma de comunicación en tiempo real que permite a los desarrolladores agregar características en tiempo real a sus aplicaciones, como notificaciones, chat, etc. [ver documentación](https://pusher.com/)
* Mailtrap es un servicio para probar y depurar correos electrónicos en aplicaciones. [ver documentación](https://mailtrap.io/)

## Instalación

**Requisitos:**

* Descargar un servidor local, recomiendo [Wampserver64](https://www.wampserver.com/en/download-wampserver-64bits/)

**Instrucciones:**

1. Descargar el proyecto de GitHub:

    * Vaya al repositorio del proyecto en GitHub.
    * Haga clic en el botón "Clone or download".
    * Seleccione "Download ZIP" para descargar un archivo ZIP con el proyecto.

2. Mover el proyecto a la carpeta de servidor WAMP:

    * Abra la carpeta "www" dentro de la carpeta de instalación de WAMP en su equipo.
    * Cree una carpeta en el escritorio llamada «portafolios».
    * Descomprima el archivo ZIP descargado en la carpeta "www/portafolios", que previamente descargó de Github.
    * Verifique que el nombre de la carpeta del proyecto sea «pablogarciajc_red_social».

3. Iniciar WAMP:

    * Haga clic en el icono de WAMP en la bandeja del sistema (es posible que deba hacer clic con el botón derecho del mouse para ver todas las opciones disponibles).
    * Seleccione "Start All Services" para iniciar el servidor WAMP.

4. Acceder a phpMyAdmin:

    * Abra un navegador web y escriba "localhost/phpmyadmin" en la barra de direcciones.
    * Ingrese su nombre de usuario y contraseña de phpMyAdmin.

5. Importar la base de datos en phpMyAdmin:

    * En la pestaña "Importar", haga clic en el botón "Examinar" y seleccione el archivo de la base de datos que desea importar en su equipo, el cual esta en  el archivo del proyecto llamado «database» que ha descargado de Github y tiene como nombre pablogarciajc_red_social.sql
    * Asegúrese de que el formato de la base de datos sea compatible con phpMyAdmin y seleccione la correcta opción de formato (SQL).
    * Haga clic en el botón "Ir" para iniciar la importación.

6. Después de importar la base de datos en su proyecto, puede acceder a él mediante el siguiente proceso:

    * Abra la terminal en su sistema.
    * Diríjase a la carpeta raíz de su proyecto utilizando el comando "cd".
    * El proyecto se encuentra en la carpeta "C:\wamp64\www\portafolios\pablogarciajc_red_social".
    * Una vez que se encuentre en la carpeta raíz de su proyecto.
    * Ejecute el siguiente comando para iniciar el servidor de desarrollo de Laravel: **php artisan serve**
    * Este comando iniciará el servidor de desarrollo de Laravel en su sistema y le proporcionará una dirección URL para acceder a su proyecto. 
    * Por ejemplo, podría ser "http://127.0.0.1:8000".
    * Ahora debería poder acceder a su proyecto y ver la aplicación en funcionamiento.


## Contáctame para más información o preguntas

| Redes Sociales  | Desarrollador de Aplicaciones Web |
| ------------- | ------------- |
| ![Web Icono](https://pablogarciajc.com/wp-content/uploads/2024/04/web.png) | **[www.pablogarciajc.com](https://pablogarciajc.com/)** |
| ![Facebook](https://pablogarciajc.com/wp-content/uploads/2024/04/facebook.png) | **[@pablogarciajc](https://www.facebook.com/PabloGarciaJC)** |
| ![LinkedIn](https://pablogarciajc.com/wp-content/uploads/2024/04/linkedin.png) | **[@pablogarciajc](https://www.linkedin.com/in/pablogarciajc/)** |


"El buen trabajo es la solución de hoy.
Para construir el futuro del mañana"




