class GameClass {

    memory() {
        // Lista de emojis como clases SVG
        const emojis = [
            { emoji: "🍎", className: "emoji-40" },
            { emoji: "🍌", className: "emoji-41" },
            { emoji: "🍒", className: "emoji-42" },
            { emoji: "🍍", className: "emoji-43" },
            { emoji: "🍉", className: "emoji-44" },
            { emoji: "🥭", className: "emoji-45" },
            { emoji: "🍋", className: "emoji-46" },
            { emoji: "🍑", className: "emoji-47" }
        ];

        let cards = [...emojis, ...emojis]; // Duplicar para pares
        let firstCard = null;
        let secondCard = null;
        let lockBoard = false;

        // Barajar y generar el tablero de juego
        function setupBoard() {
            cards = shuffle(cards);
            $('.memory-game__board').empty();

            cards.forEach((card, index) => {
                $('.memory-game__board').append(`
                        <div class="memory-game__card" data-id="${index}">
                            <span class="form__emoji" data-emoji="${card.emoji}">
                                <i class="${card.className}" style="display: none;"></i>
                            </span>
                        </div>
                    `);
            });
        }

        // Barajar las cartas
        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // Manejar clic en las cartas
        $('.memory-game__board').on('click', '.memory-game__card', function () {
            if (lockBoard || $(this).hasClass('memory-game__card--flipped') || $(this).hasClass('memory-game__card--matched')) return;

            $(this).addClass('memory-game__card--flipped');
            $(this).find('i').show();

            if (!firstCard) {
                firstCard = $(this);
            } else {
                secondCard = $(this);
                checkMatch();
            }
        });

        // Verificar si las dos cartas coinciden
        function checkMatch() {
            const firstEmoji = firstCard.find('.form__emoji').data('emoji');
            const secondEmoji = secondCard.find('.form__emoji').data('emoji');

            if (firstEmoji === secondEmoji) {
                firstCard.add(secondCard).addClass('memory-game__card--matched');
                resetBoard();
            } else {
                lockBoard = true;
                setTimeout(() => {
                    firstCard.removeClass('memory-game__card--flipped').find('i').hide();
                    secondCard.removeClass('memory-game__card--flipped').find('i').hide();
                    resetBoard();
                }, 1000);
            }
        }

        function resetBoard() {
            [firstCard, secondCard] = [null, null];
            lockBoard = false;
        }

        setupBoard();
    }


    trivia() {
        const quizData = [
            {
                question: "¿Cuál es el río más largo de Europa?",
                options: ["Danubio", "Volga", "Rin", "Loira"],
                correct: 1 // Volga
            },
            {
                question: "¿Qué país es conocido como la 'Tierra de los tulipanes'?",
                options: ["Dinamarca", "Países Bajos", "Bélgica", "Suiza"],
                correct: 1 // Países Bajos
            },
            {
                question: "¿En qué ciudad se encuentra la Torre Eiffel?",
                options: ["Londres", "París", "Roma", "Madrid"],
                correct: 1 // París
            },
            {
                question: "¿Qué país tiene más islas en Europa?",
                options: ["Grecia", "Suecia", "Noruega", "Croacia"],
                correct: 1 // Suecia
            },
            {
                question: "¿Cuál es el país más pequeño de Europa?",
                options: ["Mónaco", "Liechtenstein", "San Marino", "Ciudad del Vaticano"],
                correct: 3 // Ciudad del Vaticano
            }
        ];

        let currentQuestion = 0;
        let score = 0;

        function updateTitle() {
            $("#current-question").text(currentQuestion + 1);
            $("#total-questions").text(quizData.length);
        }

        function loadQuestion() {
            const question = quizData[currentQuestion];
            $(".quiz-question").text(question.question);
            $(".quiz-options").empty();
            question.options.forEach((option, index) => {
                $(".quiz-options").append(`<li data-index="${index}">${option}</li>`);
            });
            updateTitle();
        }

        function showResult() {
            $("#quiz").addClass("hidden");
            $("#quiz-result").removeClass("hidden");
            $(".quiz-result").text(`¡Terminaste! Tu puntuación es: ${score}/${quizData.length}`);
        }

        $(document).ready(function () {
            updateTitle();
            loadQuestion();

            $(".quiz-options").on("click", "li", function () {
                const selectedOption = $(this).data("index");
                const correctOption = quizData[currentQuestion].correct;

                // Si la respuesta es correcta
                if (selectedOption === correctOption) {
                    Swal.fire({
                        title: '¡Correcto!',
                        text: '¡Respuesta correcta!',
                        icon: 'success',
                        // imageUrl: 'ruta/a/tu/imagen-correcta.png',
                        imageWidth: 100,
                        imageHeight: 100,
                        confirmButtonText: 'Siguiente',
                        willClose: () => { // Se ejecuta cuando se cierra la alerta
                            score++;
                            setTimeout(() => {
                                currentQuestion++;
                                if (currentQuestion < quizData.length) {
                                    loadQuestion();
                                } else {
                                    showResult();
                                }
                            }, 0);
                        }
                    });
                } else {
                    // Si la respuesta es incorrecta
                    Swal.fire({
                        title: 'Incorrecto',
                        text: `La respuesta correcta era: ${quizData[currentQuestion].options[correctOption]}`,
                        icon: 'error',
                        // imageUrl: 'ruta/a/tu/imagen-incorrecta.png',
                        imageWidth: 100,
                        imageHeight: 100,
                        confirmButtonText: 'Siguiente',
                        willClose: () => { // Se ejecuta cuando se cierra la alerta
                            setTimeout(() => {
                                currentQuestion++;
                                if (currentQuestion < quizData.length) {
                                    loadQuestion();
                                } else {
                                    showResult();
                                }
                            }, 0);
                        }
                    });
                }
            });

            $("#restart-btn").click(function () {
                currentQuestion = 0;
                score = 0;
                $("#quiz").removeClass("hidden");
                $("#quiz-result").addClass("hidden");
                loadQuestion();
            });
        });

    }

    startGameClass() {
        // Juego de Memoria
        this.memory();
        // Juego de trivia
        this.trivia();
    }
}

// Instanciamos la clase
let initGame = new GameClass();
initGame.startGameClass();
