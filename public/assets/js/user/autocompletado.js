$('#formBuscador').on('submit', function (event) {
  event.preventDefault();
});

$("#search").autocomplete({
  source: function(request, response) {
    $.ajax({
      url: baseUrl + "search",
      method: "GET",
      data: {
        term: request.term  // El término de búsqueda enviado al backend
      },
      success: function(data) {
        let results = JSON.parse(data);  // Parsear la respuesta JSON
        response(results);  // Enviar los datos a jQuery UI para que los procese
      },
      error: function() {
        console.log("Error al obtener resultados de búsqueda.");
      }
    });
  },
  minLength: 1, // Iniciar autocompletado después de 1 carácter
  select: function(event, ui) {
    let url = baseUrl + "usuario/" + ui.item.value + '/0';  // Redirigir al perfil seleccionado
    location.href = url;
  }
}).data('ui-autocomplete')._renderItem = function(ul, item) {
  let inner_html = '<div><div class="label">' + item.label + ' (' + item.id + ')</div></div>';
  return $("<li class='ui-autocomplete-row'></li>")
    .data("item.autocomplete", item)
    .append(inner_html)
    .appendTo(ul);
};










