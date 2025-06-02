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

    hanged() {
        const wordList = [
            { word: 'desarrollador', category: 'Profesión en tecnología' },
            { word: 'programacion', category: 'Actividad relacionada con la creación de software' },
            { word: 'javascript', category: 'Lenguaje de programación' },
            { word: 'frontend', category: 'Parte del desarrollo web que interactúa con el usuario' },
            { word: 'html', category: 'Lenguaje de marcado para la creación de páginas web' },
            { word: 'css', category: 'Lenguaje para el diseño y estilo de páginas web' },
            { word: 'laravel', category: 'Framework de PHP para desarrollo web' }
        ];
    
        let selectedWord = '';
        let category = '';
        let guessedLetters = [];
        let incorrectGuesses = 0;
        const maxIncorrectGuesses = 6;
    
        const wordDisplay = $('#word-display');
        const lettersContainer = $('#letters');
        const resultDisplay = $('#result');
        const resetButton = $('#resetButton');
        const progressBar = $('#progress-bar');
        const hintButton = $('#hintButton');
        const hintText = $('#hintText');
    
        // Elegir una palabra aleatoria
        const chooseWord = () => {
            const randomIndex = Math.floor(Math.random() * wordList.length);
            selectedWord = wordList[randomIndex].word;
            category = wordList[randomIndex].category;
            guessedLetters = [];
            incorrectGuesses = 0;
            resultDisplay.text('');
            resetButton.hide();
            hintText.hide();
            hintButton.show(); // Aseguramos que el botón de pista esté visible
            updateWordDisplay();
            generateLetterButtons();
            updateProgressBar();
        };
    
        // Mostrar la palabra con guiones bajos para las letras no adivinadas
        const updateWordDisplay = () => {
            wordDisplay.text('');
            for (let i = 0; i < selectedWord.length; i++) {
                const letter = guessedLetters.includes(selectedWord[i]) ? selectedWord[i] : '_';
                wordDisplay.append(letter + ' ');
            }
    
            if (!wordDisplay.text().includes('_')) {
                resultDisplay.text('¡Felicidades, has ganado!');
                resultDisplay.css('color', 'green');
                resetButton.show();
                hintButton.hide();
            } else if (incorrectGuesses >= maxIncorrectGuesses) {
                resultDisplay.text(`¡Has perdido! La palabra era: ${selectedWord}`);
                resultDisplay.css('color', 'red');
                resetButton.show();
                hintButton.hide();
            }
        };
    
        // Generar botones para cada letra del alfabeto
        const generateLetterButtons = () => {
            const alphabet = 'abcdefghijklmnopqrstuvwxyz'.split('');
            lettersContainer.empty();
            alphabet.forEach(letter => {
                const button = $('<div>').text(letter).addClass('letter');
                button.on('click', () => handleLetterClick(button, letter));
                lettersContainer.append(button);
            });
        };
    
        // Manejar el clic en una letra
        const handleLetterClick = (button, letter) => {
            button.addClass('disabled').css('pointer-events', 'none');
    
            if (selectedWord.includes(letter)) {
                guessedLetters.push(letter);
                updateWordDisplay();
            } else {
                incorrectGuesses++;
                updateWordDisplay();
                updateProgressBar();
            }
        };
    
        // Mostrar una pista textual
        const showHint = () => {
            hintText.text(`Pista: ${category}`).show();
            hintButton.hide(); // Desactivar el botón de pista después de usarlo
        };
    
        // Actualizar la barra de progreso
        const updateProgressBar = () => {
            const progress = (incorrectGuesses / maxIncorrectGuesses) * 100;
            progressBar.css('width', `${progress}%`);
        };
    
        // Reiniciar el juego
        const resetGame = () => {
            chooseWord();
        };
    
        // Eventos
        resetButton.on('click', resetGame);
        hintButton.on('click', showHint);
    
        // Iniciar el juego al cargar
        chooseWord();
    }
    
    startGameClass() {
        // Juego de Memoria
        this.memory();
        // Juego de trivia
        this.trivia();
        // Juego Ahorcado (hanged)
        this.hanged();
    }
}

// Instanciamos la clase
let initGame = new GameClass();
initGame.startGameClass();
