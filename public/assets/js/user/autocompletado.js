$('#formBuscador').on('submit', function (event) {
  event.preventDefault();
});

// Manejar el evento 'input' en el campo de búsqueda
$('#search').on('input', function () {

  // Obtener el valor actual del campo y Limpiar espacios al principio y al final
  var searchText = $(this).val().trim(); 

  // Limpiar los resultados anteriores
  $('#search-results').empty();

  // Verificar que el término de búsqueda no esté vacío
  if (searchText.length >= 4) {
    $.ajax({
      url: baseUrl + "search",
      method: "GET",
      data: {
        term: searchText
      },
      dataType: "json",  // Esto maneja la conversión automáticamente
      success: function (data) {

        console.log(data);
      
        if (Array.isArray(data)) {
          var seenUsers = {}; 
          var resultsFound = false; 

          // Iterar sobre los resultados y agregarlos a la lista
          data.forEach(function (element) {
            // Verifica si el usuario ya ha sido agregado
            if (!seenUsers[element.value]) {
              seenUsers[element.value] = true;  // Marca el usuario como visto

              // Crear un enlace para cada usuario
              var listItem = $('<a>')
                .attr('href', baseUrl + "usuario/" + element.value + "?" + "estado=" + element.estado + "&notificacion=" + element.tieneNotificacion)
                .addClass('list-group-item');

              // Construir el contenido del enlace
              var content = '';
              if (element.label) {
                content += element.label;
              }
              listItem.html(content);

              // Añadir el enlace al contenedor de resultados
              $('#search-results').append(listItem);

              // Indicar que se encontraron resultados
              resultsFound = true;
            }
          });

          // Si no se encontraron resultados, mostrar un mensaje
          if (!resultsFound) {
            $('#search-results').html('<p>No se encontraron resultados.</p>');
          }
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
