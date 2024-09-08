

function mostrarOcultar(idPublicacion) {


  var idCaja = document.getElementById(idPublicacion);

  if (idCaja.style.display == 'none') {

    mostrarComentarios(idCaja);


  } else {

    ocultarComentarios(idCaja);

  }

}

function mostrarComentarios(idCaja) {
  idCaja.style.display = 'block';
}

function ocultarComentarios(idCaja) {
  idCaja.style.display = 'none';
}