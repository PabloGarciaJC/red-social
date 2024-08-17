$('#formBuscador').on('submit', function (event) {
  event.preventDefault();
});

// Manejar el evento 'input' en el campo de búsqueda
$('#search').on('input', function () {
  // Obtener el valor actual del campo
  var searchText = $(this).val();

  // Limpiar los resultados anteriores
  $('#search-results').empty();

  // Verificar que el término de búsqueda no esté vacío
  if (searchText.trim() !== "") {
    $.ajax({
      url: baseUrl + "search",
      method: "GET",
      data: {
        term: searchText
      },
      dataType: "json",  // Esto maneja la conversión automáticamente
      success: function (data) {
        // Asegúrate de que 'data' tiene la estructura esperada
        if (Array.isArray(data)) {
          // Iterar sobre los resultados y agregarlos a la lista
          data.forEach(function (element) {
            // Crear un enlace para cada usuario
            var listItem = $('<a>')
              .attr('href', baseUrl + "usuario/" + element.value + '/0')
              .addClass('list-group-item');
            // Construir el contenido del enlace
            var content = '';
            if (element.label) {
              content += element.label;
            }
            listItem.html(content);

            // Añadir el enlace al contenedor de resultados
            $('#search-results').append(listItem);
          });
        } else {
          console.log("La respuesta no es un array.");
        }
      },
      error: function (xhr, status, error) {
        console.log("Error al obtener resultados de búsqueda:", error);
      }
    });
  } else {
    // Opcional: manejar el caso en que el campo de búsqueda esté vacío
    console.log("El campo de búsqueda está vacío.");
  }
});

















