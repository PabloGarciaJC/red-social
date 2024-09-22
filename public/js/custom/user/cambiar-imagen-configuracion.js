function vista_preliminar(event) {
  let leer_img = new FileReader();
  let id_img = document.getElementById('previe');

  leer_img.onload = () => {
      if (leer_img.readyState == 2) {
          id_img.src = leer_img.result;
      }
  }
  leer_img.readAsDataURL(event.target.files[0]);
}