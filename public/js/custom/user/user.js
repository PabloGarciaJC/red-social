// ---------------------------------------------------------
// Archivo Prueba
// ---------------------------------------------------------
class UserClass {

    protectionLayer() {
        const protectionLayerValue = $('#protection-layer').text().trim();
        if (protectionLayerValue === '1') {
            Swal.fire({
                icon: 'warning',
                title: 'Acceso Restringido',
                html: `
                <p class="contact-message">Para autorizar el acceso a los módulos de esta red social, no dudes en contactarme a través de cualquiera de mis redes sociales.</p>
                <div class="social-links">
                <a href="https://www.facebook.com/PabloGarciaJC" target="_blank" title="Facebook"><i class="emoji-48"></i></a>
                <a href="https://www.instagram.com/pablogarciajc" target="_blank" title="Instagram"><i class="emoji-49"></i></a>
                <a href="https://www.linkedin.com/in/pablogarciajc" target="_blank" title="LinkedIn"><i class="emoji-50"></i></a>
                <a href="https://www.youtube.com/channel/UC5I4oY7BeNwT4gBu1ZKsEhw" target="_blank" title="YouTube"><i class="emoji-52"></i></a>
                </div>
                `,
                confirmButtonText: 'Cerrar',
            });
            return false;
        }
        return true;
    }

    // Métodos de manipulación de datos
    searchAutocompletado() {
        $('#formBuscador').on('submit', function (event) {
            event.preventDefault();
        });

        // Manejar el evento 'input' en el campo de búsqueda
        $('#search').on('input', (event) => {
            let searchText = $(event.target).val().trim(); // Obtener el valor del input

            // Limpiar los resultados anteriores
            $('#search-results').empty();

            // Verificar que el término de búsqueda no esté vacío
            if (searchText.length >= 4) {
                $.ajax({
                    url: baseUrl + "search", // Usar la URL base de la clase
                    method: "GET",
                    data: {
                        term: searchText
                    },
                    dataType: "json",  // Maneja la conversión automáticamente
                    success: (data) => {
                        if (Array.isArray(data)) {
                            let seenUsers = {};
                            let resultsFound = false;

                            // Iterar sobre los resultados y agregarlos a la lista
                            data.forEach((element) => {
                                if (!seenUsers[element.value]) {
                                    seenUsers[element.value] = true;

                                    // Crear un enlace para cada usuario
                                    let listItem = $('<a>')
                                        .attr('href', baseUrl + "usuario/" + element.value + "?" + "estado=" + element.estado + "&notificacion=" + element.tieneNotificacion)
                                        .addClass('list-group-item');

                                    // Construir el contenido del enlace
                                    let content = '';
                                    if (element.label) {
                                        content += element.label;
                                    }
                                    listItem.html(content);

                                    // Añadir el enlace al contenedor de resultados
                                    $('#search-results').append(listItem);

                                    resultsFound = true;
                                }
                            });
                            // Si no se encontraron resultados, mostrar un mensaje
                            if (!resultsFound) {
                                $('#search-results').html('<p>No se encontraron resultados.</p>');
                            }
                        }
                    }
                });
            }
        });
    }

    // Método para vista preliminar de imágenes
    changeImagePreview($imageFileInput, $previeImage) {
        let currentImageSrc = $previeImage.attr('src'); // Almacena la imagen actual

        // Evento que se dispara al cambiar el input de archivo
        $imageFileInput.on('change', function (event) {
            const file = event.target.files[0]; // Obtiene el archivo seleccionado

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Actualiza la imagen de vista previa
                    $previeImage.attr('src', e.target.result);
                    $previeImage.show();
                };

                reader.readAsDataURL(file); // Lee el archivo como una URL
            } else {
                // Si no hay archivo, restaura la imagen anterior
                $previeImage.attr('src', currentImageSrc);
            }
        });
    }

    changeImagePreviewUserPerfil() {

        // Al hacer clic en el icono de editar, activa el input de archivo
        $('.user-perfil__edit').on('click', function (event) {
            event.preventDefault();
            $('#upload-profile-image').click(); // Dispara el clic en el input file oculto
        });

        // Cuando el usuario selecciona una nueva imagen
        $('#upload-profile-image').on('change', function (event) {
            const file = event.target.files[0]; // Obtiene el archivo seleccionado

            // Verifica que el archivo sea una imagen
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                // Cuando la imagen se carga en memoria, actualiza el src del elemento img
                reader.onload = function (e) {
                    $('#preview-perfil-user').attr('src', e.target.result); // Reemplaza la imagen de perfil
                };

                reader.readAsDataURL(file); // Lee el archivo como una URL de datos
            }
        });
    }

    bindFormSubmit() {
        $('#perfil-form').on('submit', (event) => {
            if (!this.protectionLayer()) {
                event.preventDefault();
            }
        });
    }

    bindAllForms() {
        const self = this;
        $('section.profile form').on('submit', function (e) {
            if (!self.protectionLayer()) {
                e.preventDefault();
            }
        });
    }

    bindAllButtons() {
        const self = this;
        // Incluye todos los botones tipo submit y normales
        $('section.profile button[type="submit"], section.profile button').on('click', function (e) {
            if (!self.protectionLayer()) {
                e.preventDefault();
            }
        });
    }

    disableButtonsIfProtected() {
        if ($('#protection-layer').text().trim() === '1') {
            const buttons = $('section.profile button[type="submit"], section.profile button');
            buttons.prop('disabled', true);
            buttons.css('cursor', 'not-allowed');
        }
    }

    // Método para inicializar la clase
    startUserClass() {
        this.bindFormSubmit();
        this.bindAllForms();
        this.bindAllButtons();
        this.disableButtonsIfProtected();
        this.searchAutocompletado();
        this.changeImagePreview($('#image-file-perfil-user'), $('#previe-perfil-user'));
        this.changeImagePreviewUserPerfil();
    }
}

// Para usar la clase, crear una nueva instancia e inicializarla
let initUser = new UserClass();
initUser.startUserClass();
