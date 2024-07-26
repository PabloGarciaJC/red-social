
$("#search").autocomplete({
  source: baseUrl + "search",
  minLength: 1,
  select: function (event, ui) {
    // var url = "{{ route('usuarioBuscador.perfil', ['perfil' => 'temp']) }}";
    var url = baseUrl + "usuario/" + 'temp/' + '0';
    url = url.replace('temp', ui.item.value);
    location.href = url;
    // console.log(ui.item.value);
  }
}).data('ui-autocomplete')._renderItem = function (ul, item) {

  var inner_html = '<div><div class="label">' + item.label + ' ' + item.id + '</div></div>';
  return $("<li class='ui-autocomplete-row' ></li>")
    .data("item.autocomplete", item)
    .append(inner_html)
    .appendTo(ul);

  // return $("<li class='ui-autocomplete-row'></li>")
  //   .data("item.autocomplete", item)
  //   .append(item.label)
  //   .appendTo(ul);
};








