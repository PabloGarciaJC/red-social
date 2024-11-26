class GameClass {

    startGameClass() {

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
}

// Instanciamos la clase
let initGame = new GameClass();
initGame.startGameClass();
