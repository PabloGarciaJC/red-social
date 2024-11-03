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
            <input type="text" class="button form-control chat__input" placeholder="Escribe el mensaje">
            <button type="button" id="emojiButton" class="button btn-secondary chat__emojis-toggle"><i class="modal__icon emoji-31"></i></button>
            <button type="button" class="button sendMessage"><i class="form__send-icon emoji-34"></i></button>
        </div>
        <!-- Aquí se inyectará el emoji-picker -->
        <div class="emojis-wrapper emojis-wrapper-grid-large"></div>
    </div>
</div>