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

    // Método para inicializar la clase
    startUserClass() {
        this.searchAutocompletado();   
    }
}

// Para usar la clase, crear una nueva instancia e inicializarla
let initUser = new UserClass();
initUser.startUserClass();
