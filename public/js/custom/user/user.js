// ---------------------------------------------------------
// Archivo Prueba
// ---------------------------------------------------------
class UserClass {

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

    // Método para inicializar la clase
    startUserClass() {
        this.searchAutocompletado();
        this.changeImagePreview($('#image-file-perfil-user'), $('#previe-perfil-user'));
        this.changeImagePreviewUserPerfil();
    }
}

// Para usar la clase, crear una nueva instancia e inicializarla
let initUser = new UserClass();
initUser.startUserClass();
