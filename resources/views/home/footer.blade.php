  {{-- Foter --}}
  <div id="user-data" data-user-id="{{ Auth::user()->id }}"></div>
  <footer id="footer" class="footer {{ !Request::is('/') ? 'footer-no-index' : '' }}">
    <div class="copyright">Desarrollado por <strong>Pablo Garcia JC</strong></div>
</footer>