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
        // Evento para el input de Texto
        $(document).off("click", ".form__comments");
        $(".form__comments").on("submit", function (e) {
            e.preventDefault();
            let form = $(this);
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
                        form[0].reset();
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                },
            });
        });

        // Evento para el input de archivos
        $(".image-commets").on("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                let form = $(this).closest(".form__comments");
                let formData = new FormData(form[0]);
                formData.append("post_id", form.data("post-id"));
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
                    },
                    error: function (xhr, status, error) {
                        console.error("Error:", error);
                    },
                });
            }
        });
    }

    // Funcionalidades
    startCommentClass() {
        this.showComments();
        this.collapseComments();
        this.save();
    }
}

window.initComment = new CommentClass();
window.initComment.startCommentClass();
