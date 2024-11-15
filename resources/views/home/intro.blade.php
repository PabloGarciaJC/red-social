@extends('layouts.app')

@section('core-content')
    <main id="main" class="main">
        <div class="card info-card sales-card">
            <div class="intro-board">
                <div class="card__info">
                    <span class="title__intro">¿Qué funcionalidades ofrece esta red social?</span>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-person-check"></i> Autenticación de Usuarios</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Crea tu cuenta para acceder a todas las funcionalidades de la plataforma. Modifica tu contraseña de manera sencilla y recibe notificaciones importantes en tu correo corporativo.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-pencil-square"></i> Publicaciones</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Comparte tus pensamientos y fotos con amigos. Crea, elimina o comenta publicaciones y añade emojis en formato SVG para mayor expresividad.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-chat-left-text"></i> Comentarios</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Comenta, edita o elimina tus comentarios y personalízalos con emojis SVG para agregarles un toque divertido.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-person-circle"></i> Edición de Perfil</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Actualiza tu perfil cambiando tu foto, nombre y otros datos importantes que te identifiquen en la plataforma.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-search"></i> Buscador de Usuarios</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Encuentra a tus amigos o nuevas personas de interés fácilmente utilizando nuestro buscador eficiente.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-person-check"></i> Amigos</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Manténte conectado con tus amigos en la plataforma y visualiza su actividad fácilmente.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-chat-dots"></i> Chat en Tiempo Real</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Disfruta de una comunicación instantánea con tus amigos, manteniéndote siempre conectado.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-bell"></i> Notificaciones en Tiempo Real</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Recibe alertas al instante sobre solicitudes de amistad, comentarios y otras interacciones importantes.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-phone"></i> Diseño Adaptado a Móviles</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Disfruta de una experiencia óptima en dispositivos móviles con un diseño responsive que se adapta a diferentes tamaños de pantalla.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card__info">
                    <span class="title__intro">Tecnologías Empleadas para el Desarrollo</span>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-code-slash"></i> Laravel</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Framework PHP robusto y eficiente utilizado para el desarrollo del back-end de la aplicación. Facilita la creación de aplicaciones web seguras, escalables y fáciles de mantener.</p>
                                    <p><a href="https://laravel.com/docs" target="_blank">Documentación de Laravel</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-arrow-repeat"></i> Laravel Mix</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Herramienta de compilación de assets basada en Webpack, que facilita la gestión de archivos CSS y JavaScript, mejorando la eficiencia en el desarrollo front-end.</p>
                                    <p><a href="https://laravel-mix.com/docs" target="_blank">Documentación de Laravel Mix</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-file-earmark-code"></i> Composer</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Gestor de dependencias en PHP, utilizado para instalar y actualizar las bibliotecas y herramientas necesarias para el desarrollo de la aplicación.</p>
                                    <p><a href="https://getcomposer.org/doc/" target="_blank">Documentación de Composer</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-box"></i> Docker (con WSL)</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Plataforma que permite desarrollar, empaquetar y ejecutar aplicaciones en contenedores, garantizando consistencia y escalabilidad en cualquier entorno. En el caso de Windows, se utiliza WSL2 para permitir la ejecución de contenedores Docker en un entorno Linux virtualizado.</p>
                                    <p><a href="https://www.docker.com/get-started" target="_blank">Documentación de Docker</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-stack"></i> Docker Compose</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Herramienta para definir y ejecutar aplicaciones multi-contenedor en Docker, facilitando la gestión de servicios y entornos complejos.</p>
                                    <p><a href="https://docs.docker.com/compose/" target="_blank">Documentación de Docker Compose</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-grid"></i> Bootstrap</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Framework CSS para diseñar interfaces modernas, atractivas y responsivas con una amplia variedad de componentes listos para usar.</p>
                                    <p><a href="https://getbootstrap.com/docs" target="_blank">Documentación de Bootstrap</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-github"></i> GitHub</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Plataforma de control de versiones basada en Git, utilizada para almacenar y gestionar el código fuente, facilitando el trabajo colaborativo y el seguimiento de cambios.</p>
                                    <p><a href="https://docs.github.com/en" target="_blank">Documentación de GitHub</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-journal-text"></i> Notion</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Herramienta todo-en-uno para la organización de proyectos, tareas y documentación, facilitando la colaboración entre equipos y el seguimiento del progreso del desarrollo.</p>
                                    <p><a href="https://www.notion.so" target="_blank">Página oficial de Notion</a></p> <!-- Enlace a la página oficial -->
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-check-circle"></i> Testing - PHPUnit</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Proceso de prueba de la aplicación para asegurar que todas las funcionalidades estén operando correctamente. Esto incluye pruebas unitarias, de integración y pruebas de usuario (UI).</p>
                                    <p><a href="https://phpunit.de/manual/current/en/" target="_blank">Documentación de PHPUnit</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-cloud-download"></i> Postman</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Herramienta utilizada para probar y documentar los endpoints de la API. Con Postman, realizamos solicitudes HTTP y verificamos las respuestas de la API para asegurar su correcto funcionamiento.</p>
                                    <p><a href="https://www.postman.com/docs" target="_blank">Documentación de Postman</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-cogs"></i> Make</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Make es una herramienta de automatización que utilicé para simplificar la ejecución de tareas repetitivas. En este proyecto, la utilicé para automatizar procesos como el levantamiento de Docker, la ejecución de pruebas y la gestión de contenedores, optimizando el flujo de trabajo.</p>
                                    <p><a href="https://www.gnu.org/software/make/manual/" target="_blank">Documentación de Make</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-terminal"></i> Ubuntu con WSL</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Utilicé Ubuntu a través de WSL (Windows Subsystem for Linux) para proporcionar un entorno de desarrollo Linux en mi máquina Windows. Esto me permitió trabajar con herramientas y tecnologías nativas de Linux, como Docker, sin necesidad de una máquina virtual o un sistema operativo dual.</p>
                                    <p><a href="https://learn.microsoft.com/en-us/windows/wsl/" target="_blank">Documentación de WSL</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card__info">
                    <span class="title__intro">Creditos</span>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-file-earmark-code"></i> Plantilla</h3>
                                </div>
                                <div class="card-body-info">
                                    <p class="credit-text"><strong>Nombre de la plantilla:</strong> NiceAdmin</p>
                                    <p class="credit-text"><strong>Autor:</strong> BootstrapMade.com</p>
                                    <p class="credit-text"><strong>Licencia:</strong> <a href="https://bootstrapmade.com/license/" target="_blank">Licencia</a></p>
                                    <p class="credit-text"><strong>Plantilla URL:</strong> <a href="https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/" target="_blank">NiceAdmin</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card__info">
                    <span class="title__intro">Usuarios Ficticios para Pruebas</span>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-person"></i> Usuario 1</h3>
                                </div>
                                <div class="card-body-info">
                                    <p class="credit-text"><strong>Correo Alias:</strong> juan.perez@email.com</p>
                                    <p class="credit-text"><strong>Contraseña:</strong> ******** (Encriptada)</p>
                                    <p class="credit-text"><strong>Recuperación de Contraseña:</strong></p>
                                    <p class="credit-text">Para verificar la funcionalidad, utiliza el siguiente correo corporativo: <strong><a href="https://tusitioweb.com/recuperar-contraseña" target="_blank">soporte@tusitioweb.co</a></strong></p>
                                    <p class="credit-text"><strong>Contraseña:</strong>xxxxx</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-person"></i> Usuario 2</h3>
                                </div>
                                <div class="card-body-info">
                                    <p class="credit-text"><strong>Correo Alias:</strong> juan.perez@email.com</p>
                                    <p class="credit-text"><strong>Contraseña:</strong> ******** (Encriptada)</p>
                                    <p class="credit-text"><strong>Recuperación de Contraseña:</strong></p>
                                    <p class="credit-text">Para verificar la funcionalidad, utiliza el siguiente correo corporativo: <strong><a href="https://tusitioweb.com/recuperar-contraseña" target="_blank">soporte@tusitioweb.co</a></strong></p>
                                    <p class="credit-text"><strong>Contraseña:</strong>xxxxx</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-person"></i> Usuario 3</h3>
                                </div>
                                <div class="card-body-info">
                                    <p class="credit-text"><strong>Correo Alias:</strong> juan.perez@email.com</p>
                                    <p class="credit-text"><strong>Contraseña:</strong> ******** (Encriptada)</p>
                                    <p class="credit-text"><strong>Recuperación de Contraseña:</strong></p>
                                    <p class="credit-text">Para verificar la funcionalidad, utiliza el siguiente correo corporativo: <strong><a href="https://tusitioweb.com/recuperar-contraseña" target="_blank">soporte@tusitioweb.co</a></strong></p>
                                    <p class="credit-text"><strong>Contraseña:</strong>xxxxx</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-person"></i> Usuario 4</h3>
                                </div>
                                <div class="card-body-info">
                                    <p class="credit-text"><strong>Correo Alias:</strong> juan.perez@email.com</p>
                                    <p class="credit-text"><strong>Contraseña:</strong> ******** (Encriptada)</p>
                                    <p class="credit-text"><strong>Recuperación de Contraseña:</strong></p>
                                    <p class="credit-text">Para verificar la funcionalidad, utiliza el siguiente correo corporativo: <strong><a href="https://tusitioweb.com/recuperar-contraseña" target="_blank">soporte@tusitioweb.co</a></strong></p>
                                    <p class="credit-text"><strong>Contraseña:</strong>xxxxx</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-person"></i> Usuario 5</h3>
                                </div>
                                <div class="card-body-info">
                                    <p class="credit-text"><strong>Correo Alias:</strong> juan.perez@email.com</p>
                                    <p class="credit-text"><strong>Contraseña:</strong> ******** (Encriptada)</p>
                                    <p class="credit-text"><strong>Recuperación de Contraseña:</strong></p>
                                    <p class="credit-text">Para verificar la funcionalidad, utiliza el siguiente correo corporativo: <strong><a href="https://tusitioweb.com/recuperar-contraseña" target="_blank">soporte@tusitioweb.co</a></strong></p>
                                    <p class="credit-text"><strong>Contraseña:</strong>xxxxx</p>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="card__info">
                    <span class="title__intro">Contáctame / Sígueme en mis redes sociales</span>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-github"></i> GitHub</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Visita mi perfil en GitHub para ver mis proyectos y contribuciones al código abierto.</p>
                                    <a href="https://github.com/PabloGarciaJC" target="_blank" class="btn btn-primary">Ir a GitHub</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-facebook"></i> Facebook</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Conéctate conmigo en Facebook y mantente al tanto de mis actualizaciones personales y profesionales.</p>
                                    <a href="https://www.facebook.com/PabloGarciaJC" target="_blank" class="btn btn-primary">Ir a Facebook</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-youtube"></i> YouTube</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Visita mi canal de YouTube para ver videos sobre desarrollo web, tutoriales y más.</p>
                                    <a href="https://www.youtube.com/channel/UC5I4oY7BeNwT4gBu1ZKsEhw" target="_blank" class="btn btn-primary">Ir a YouTube</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-globe"></i> Página Web</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Visita mi página web personal donde encontrarás más sobre mis proyectos y servicios.</p>
                                    <a href="https://pablogarciajc.com/" target="_blank" class="btn btn-primary">Ir a mi página web</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-linkedin"></i> LinkedIn</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Conéctate conmigo en LinkedIn para seguir mi carrera profesional y establecer conexiones.</p>
                                    <a href="https://www.linkedin.com/in/pablogarciajc/" target="_blank" class="btn btn-primary">Ir a LinkedIn</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-instagram"></i> Instagram</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Sigue mi cuenta de Instagram para ver fotos, proyectos y más contenido relacionado con mi trabajo.</p>
                                    <a href="https://www.instagram.com/pablogarciajc/" target="_blank" class="btn btn-primary">Ir a Instagram</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-card feature-card h-100">
                                <div class="card-header">
                                    <h3><i class="bi bi-twitter"></i> Twitter</h3>
                                </div>
                                <div class="card-body-info">
                                    <p>Sigue mi cuenta de Twitter para estar al tanto de mis proyectos, pensamientos y actualizaciones.</p>
                                    <a href="https://x.com/PabloGarciaJC?t=lct1gxvE8DkqAr8dgxrHIw&s=09" target="_blank" class="btn btn-primary">Ir a Twitter</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection