
@isset($messages)
    @include('layouts.head')

    <main class="py-4">
        @include('includes.home.nav')
        @include('includes.home.sidebar')
        @yield('dynamic-content')
    </main>
    
@endisset

{{-- <div class="tab-pane fade" id="chat">
    <h5 class="card-title">Chat</h5>
    <!-- Contenedor del Chat -->
    <div class="chat-container">
        <div class="chat-container__box">
            <!-- Mensajes del chat -->
            <div class="chat-container__message chat-container__message--received">
                <div class="chat-container__message-content">
                   Hello! How are you? 

                    @isset($messages)
                            @foreach($messages as $message)
                                <div class="message">
                                    @if ($message->emisor)
                                        <p><strong>{{ $message->emisor->name }}:</strong> {{ $message->message }}</p>
                                    @else
                                        <p><strong>Unknown User:</strong> {{ $message->message }}</p>
                                    @endif
                                    <span>{{ $message->created_at }}</span>
                                </div>
                            @endforeach
                        @else
                        <a href="{{ route('chat.getMessages', ['userId1' => 110, 'userId2' => 111]) }}">Ir a los mensajes</a>
                    @endisset
                </div>
            </div>
            <div class="chat-container__message chat-container__message--sent">
                <div class="chat-container__message-content">
                   I'm good, thanks! How about you?
                </div>
            </div>
        </div>
        <!-- Área de entrada de texto -->
        <div class="chat-container__input">
            <input type="text" id="messageInput" placeholder="Type a message...">
            <button type="button" id="sendMessage">Send</button>
            <button type="button" id="emojiButton">😊</button>
            <button type="button" id="videoCallButton">Video Call</button>
        </div>
        <!-- Cuadro de emojis -->
        <div id="emojiPicker" class="chat-container__emoji-picker" style="display: none;">
            <span class="chat-container__emoji" onclick="insertEmoji('😊')">😊</span>
            <span class="chat-container__emoji" onclick="insertEmoji('😂')">😂</span>
            <span class="chat-container__emoji" onclick="insertEmoji('😍')">😍</span>
            <span class="chat-container__emoji" onclick="insertEmoji('😉')">😉</span>
            <span class="chat-container__emoji" onclick="insertEmoji('😭')">😭</span>
            <span class="chat-container__emoji" onclick="insertEmoji('😎')">😎</span>
            <span class="chat-container__emoji" onclick="insertEmoji('😡')">😡</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🥺')">🥺</span>
            <span class="chat-container__emoji" onclick="insertEmoji('😜')">😜</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🤔')">🤔</span>
            <span class="chat-container__emoji" onclick="insertEmoji('👍')">👍</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🙏')">🙏</span>
            <span class="chat-container__emoji" onclick="insertEmoji('❤️')">❤️</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🎉')">🎉</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🔥')">🔥</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🤯')">🤯</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🤩')">🤩</span>
            <span class="chat-container__emoji" onclick="insertEmoji('😇')">😇</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🥳')">🥳</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🤪')">🤪</span>
            <span class="chat-container__emoji" onclick="insertEmoji('👀')">👀</span>
            <span class="chat-container__emoji" onclick="insertEmoji('😏')">😏</span>
            <span class="chat-container__emoji" onclick="insertEmoji('💀')">💀</span>
            <span class="chat-container__emoji" onclick="insertEmoji('👻')">👻</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🤤')">🤤</span>
            <span class="chat-container__emoji" onclick="insertEmoji('😴')">😴</span>
            <span class="chat-container__emoji" onclick="insertEmoji('👑')">👑</span>
            <span class="chat-container__emoji" onclick="insertEmoji('💩')">💩</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🦄')">🦄</span>
            <span class="chat-container__emoji" onclick="insertEmoji('🐶')">🐶</span>
        </div>
    </div>
    <!-- Ventana emergente de videollamada -->
    <div id="videoCallModal" class="chat-container__modal" style="display: none;">
        <div class="chat-container__modal-content">
            <span class="chat-container__close" onclick="closeVideoCall()">×</span>
            <h2>Video Call</h2>
            <p>Video call with [User]</p>
        </div>
    </div>
</div> --}}

@isset($messages)
    @include('layouts.footer-script')
@endisset