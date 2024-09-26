
        <script src="{{ asset('js/app.js') }}"></script> 
        <script src="{{ asset('js/custom/main.js') }}"></script>
        <script src="{{ asset('js/custom/config/config.js') }}"></script>
        <script src="{{ asset('js/custom/user/user.js') }}"></script>
        <script src="{{ asset('js/custom/comments/comments.js') }}"></script> <!-- Convertir en Clase -->
        <script src="{{ asset('js/custom/publications/publications.js') }}"></script>
        <script src="{{ asset('js/custom/likes/like.js') }}"></script>
        <script src="{{ asset('js/custom/followers/followers.js') }}"></script>
        <script src="{{ asset('js/custom/chat/chat.js') }}"></script>
        <script src="{{ asset('js/custom/game/game.js') }}"></script>
        @stack('scripts')
    </body>
</html>

