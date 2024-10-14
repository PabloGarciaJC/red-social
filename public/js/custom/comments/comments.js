class CommentClass {
    showComments() {
        $(document).on("click", ".btn__comments", (e) => {
            e.preventDefault();
            const $currentTarget = $(e.currentTarget);
            const $wrapperComments = $currentTarget
                .closest(".justify-content-end")
                .find(".wrapper-comments");
            // Evita múltiples animaciones
            if ($wrapperComments.is(":animated")) return;
            // `slideToggle` para la animación de deslizamiento
            $wrapperComments.slideToggle();
        });
    }

    collapseComments() {
        $(".form__collapse").on("click", (e) => {
            $(e.currentTarget)
                .closest(".justify-content-end")
                .find(".wrapper-comments")
                .slideUp();
        });
    }

    save() {
        // Evento para el submit del formulario (solo para texto)
        $(document).off("submit", ".form__comments");
        $(".form__comments").on("submit", function (e) {
            e.preventDefault();
            let form = $(this);

            // Verificar si el input de archivo tiene algo antes de enviar el formulario
            const fileInput = form.find(".image-commets")[0];
            if (fileInput && fileInput.files.length > 0) {
                return;
            }

            // Procesar solo los campos de texto
            let formData = new FormData(form[0]);
            formData.append("post_id", form.data("post-id"));

            // Enviar los datos por AJAX
            $.ajax({
                url: form.attr("action"),
                method: "POST",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.message == "success") {
                        form[0].reset(); // Reiniciar el formulario
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                },
            });
        });

        // Evento para el input de archivos (solo para archivos)
        $(".image-commets").on("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                let form = $(this).closest(".form__comments");
                let formData = new FormData(form[0]);
                formData.append("post_id", form.data("post-id"));

                // Enviar el archivo por AJAX
                $.ajax({
                    url: form.attr("action"),
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });

                        // Limpiar el campo de archivo después del envío
                        form.find(".image-commets").val(''); 
                    },
                    error: function (xhr, status, error) {
                        console.error("Error:", error);
                    },
                });
            }
        });
    }

    delete() {
        $('.comments__btn-delete').on('click', function (e) {
            e.preventDefault();

            let publication = $(this).closest('.col-12.mb-3').find('.form__comments');
            let idPublication = publication.data('post-id');

            let comments = $(this).closest('.comments__btns');
            let idComments = comments.data('id-comments');

            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: $(this).attr('href'),
                data: {
                    _token: csrfToken,
                    idPublication: idPublication,
                    idComments: idComments,
                },
                success: (response) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Comentario Eliminado',
                        showConfirmButton: false,
                        timer: 1000
                    });
                },
                error: (err) => {
                    console.error('Error:', err);
                }
            });
        });
    }

    startCommentClass() {
        this.showComments();
        this.collapseComments();
        this.save();
        this.delete();
    }
}

window.initComment = new CommentClass();
window.initComment.startCommentClass();
