<div class="col-12">
    <div class="card info-card sales-card">
        <div class="card-body">
            <br>
            <input id="userLogin" type="hidden" value="{{ Auth::user()->id }}"></input>
            <div class="d-flex align-items-center">
                <div class="button button--modal-open" id="openModal">
                    ¿Qué estás Pensando, {{ Auth::user()->alias }}.?
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>

<!-- Modal - Crear Publicación -->
<div class="modal" id="exampleModal">
    <div class="modal__content">
        <div class="modal__header">
            <h5>Crear Publicación</h5>
            <button class="modal__close" id="closeModal">×</button>
        </div>
        <div class="modal__body">
            <form action="{{ action('PublicationController@save') }}" method="POST" enctype="multipart/form-data" class="form-publication__create">
                <!-- CSRF Token -->
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="commentTextarea">Escribe tu Comentario</label>
                    <textarea class="form-control publication-input" name="comentarioPublicacion"></textarea>
                </div>
                <div class="form-group">
                    <label for="imageFile" class="modal__image-upload">
                        <span class="modal__image-upload__icon">📁</span> Subir Imagen o Video
                        <input type="file" class="form-control-file" id="imageFile" name="imagenPublicacion">
                    </label>

                    <button type="button" class="modal__button--emoji-toggle">😊</button>
 
                     <!-- Aquí se inyectará el emoji-picker -->
                     <div class="form__cntn-emojis"></div>

                    <div class="modal__image-preview">
                        <img id="imagePreview" src="" alt="Vista previa de la imagen" style="display: none;">
                    </div>
                </div>
                <div class="modal__footer">
                    <button type="button" class="button button--modal-close" id="closeModalFooter">Cerrar</button>
                    <button type="submit" class="button">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>

