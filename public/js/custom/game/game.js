class GameClass {

    startGameClass() {

        const images = ['🍎', '🍌', '🍒', '🍓', '🍉', '🍇', '🍍', '🥭'];
        let cards = [...images, ...images];
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
                            <img src="path-to-your-image/${card}.png" alt="${card}">
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
            $(this).find('img').show();

            if (!firstCard) {
                firstCard = $(this);
            } else {
                secondCard = $(this);
                checkMatch();
            }
        });

        // Verificar si las dos cartas coinciden
        function checkMatch() {
            if (firstCard.find('img').attr('src') === secondCard.find('img').attr('src')) {
                firstCard.add(secondCard).addClass('memory-game__card--matched');
                resetBoard();
            } else {
                lockBoard = true;
                setTimeout(() => {
                    firstCard.removeClass('memory-game__card--flipped').find('img').hide();
                    secondCard.removeClass('memory-game__card--flipped').find('img').hide();
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
