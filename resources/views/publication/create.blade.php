<div class="col-12">
    <div class="card info-card sales-card card-publication">
        <div class="card-body">
            <input id="userLogin" type="hidden" value="{{ Auth::user()->id }}"></input>
            <div class="d-flex align-items-center">
                <div class="button modal__btn-open" id="openModal">
                    ¿Qué estás Pensando, {{ Auth::user()->alias }}.?
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal - Crear Publicación -->
<div class="modal" id="modal-create-publication">
    <div class="modal__content">
        <div class="modal__header">
            <h5>Crear Publicación</h5>
            <button class="modal__close" id="closeModal">×</button>
        </div>
        <div class="modal__body">
            <form action="{{ action('PublicationController@save') }}" method="POST" enctype="multipart/form-data" class="modal__form-publication-create">
                <!-- CSRF Token -->
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea class="form-control button modal__publication-textarea" name="comentarioPublicacion" placeholder="Escribe tu Comentario"></textarea>
                </div>
                <div class="form-group modal__group">
                    <div class="modal__form-actions">
                        <button type="button" class="button modal__button--emoji-toggle"><i class="modal__icon emoji-31"></i></button>
                        <label for="modal__for-file" class="button modal__image-upload">
                            <span class="modal__image-upload-cntn"><i class="modal__icon emoji-32"></i></span> Agregar fotos
                            <input type="file" id="modal__for-file" name="imagenPublicacion">
                        </label>
                    </div>
                    <!-- Aquí se inyectará el emoji-picker -->
                    <div class="modal__cntn-emojis"></div>
                    <!-- Contenedor de las vistas previas de las imágenes -->
                    <div class="modal__image-preview">
                        <div class="modal__image-wrapper"></div>
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
