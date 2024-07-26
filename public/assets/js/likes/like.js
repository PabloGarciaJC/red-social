
function like(idPublication) {

  let likePublication = document.getElementById('btn-like' + idPublication);
  likePublication.classList.remove('like');
  likePublication.innerHTML = 'Dislike';
  likePublication.classList.add('dislike');
  likePublication.setAttribute('id', 'btn-dislike' + idPublication);
  likePublication.setAttribute('onclick','dislike('+ idPublication +');');
  let urlAjax = baseUrl + 'like/' + idPublication;
  ajaxPeticionLike(urlAjax);

}
  
function ajaxPeticionLike(urlAjax){

  $.ajax({
    type: "GET",
    url: urlAjax,
    success: function (response) {
   
      if(response.like){
        console.log('Has dado like a la publicacion');
      }else{
        console.log('Error al dar like');
      }

    }
  })

}










  

    // let like = document.getElementById('btn-like');

    // like.addEventListener('click', (event) => {

      // like.classList.remove('like');
      // like.innerHTML = 'Deslike';
      // like.classList.add('dislike');


      // let urlLikeAjax = baseUrl + 'publicationDelete/' + idPublicacion;

  

      // $.$.ajax({
      //   type: "method",
      //   url: "url",
      //   data: "data",
      //   dataType: "dataType",
      //   success: function (response) {
          
      //   }
      // });


    // })




  





