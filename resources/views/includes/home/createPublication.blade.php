<div class="col-12">
    <div class="card info-card sales-card">
        <div class="card-body">
            <br>
            <input id="userLogin" type="hidden" value="{{ Auth::user()->id }}"></input>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" data-bs-toggle="modal"
                    style="cursor:pointer; text-align: center;" data-bs-target="#exampleModal"
                    placeholder="¿Qué estás Pensando, {{ Auth::user()->alias }}.?">
            </div>
            <hr>
        </div>
    </div>
</div>

<!-- Modal - Crear Publicacion  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;">Crear Publicación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ action('PublicationController@save') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Escribe tu Comentario</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="comentarioPublicacion"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Subir Imagen</label><br>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1"
                            name="imagenPublicacion">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

