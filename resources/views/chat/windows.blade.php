<div class="tab-pane fade" id="chat">
    <h5 class="card-title">Chat</h5>
    <!-- Contenedor del Chat -->
    <div class="chat-container">
        <div class="chat-container__box">
            <!-- Mensajes del chat -->
            <div class="chat-container__message chat-container__message--received">
                <div class="chat-container__message-content"></div>
            </div>
            <div class="chat-container__message chat-container__message--sent">
                <div class="chat-container__message-content"></div>
            </div>
        </div>
        <!-- Área de entrada de texto -->
        <div class="chat-container__input">
            <button type="button" id="emojiButton" class="btn btn-secondary chat__emojis-toggle">😄 Emojis</button>
            <input type="text" class="chat__input" placeholder="Escribe el mensaje">
            <button type="button" class="sendMessage">Enviar</button>
        </div>
        <!-- Aquí se inyectará el emoji-picker -->
        <div class="form__cntn-emojis"></div>
    </div>
</div>