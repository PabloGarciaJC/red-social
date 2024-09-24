window.Echo.channel('broadcastPublication-channel')
    .listen('.broadcastPublication-event', (response) => {

        let publication = response.publication;
        let user = publication.user;
        let contenido = (publication.contenido ?? '').trim();

        let cardHtml = `
                          <div class="col-12 mb-3">
                              <div class="card info-card sales-card">
                                  <div class="filter">
                                      <a class="icon" href="#" data-bs-toggle="dropdown">
                                          <i class="bi bi-three-dots"></i>
                                      </a>
                                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                          <li class="dropdown-header text-start">
                                              <span>Opciones</span>
                                          </li>
                                          <li>
                                              <a class="dropdown-item eliminar-publication" href="${baseUrl}publicationDelete/${publication.id}">
                                                Eliminar
                                              </a>
                                          </li>  
                                      </ul>
                                  </div>
                                  <div class="card-body">
                                      <div class="d-flex align-items-center pt-3">
                                          <div class="news">
                                              <div class="post-item clearfix">
                                                  <img src="/fotoPerfil/${user.fotoPerfil}" 
                                                      alt="${user.alias}'s profile picture"
                                                      class="rounded-circle" width="50" height="50"/>
                                                  <a href="/usuario/${user.alias}?estado=confirmado&idNotificacion=0">
                                                      ${user.alias}
                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                      ${publication.imagen ? `
                                          <img src="/publicationImagen/${publication.imagen}" 
                                              alt="Publication Image" 
                                              class="img-fluid rounded mb-3" 
                                              style="max-width: 100%; height: auto;">
                                      ` : ''}
                                      ${contenido !== '' ? `<p class="pt-3">${contenido}</p>` : ''}
                                      <hr>
                                      <div class="row justify-content-end">
                                          <div class="col col-lg-2">
                                              <div class="like" id="btn-like${publication.id}" onclick="like(${publication.id})">
                                                  Like
                                              </div>
                                          </div>
                                          <div class="col col-lg-2 btn__comments">Comentarios (0)</div>
                                          <div id="${publication.id}" class="wrapper-comments" style="display: none;">
                                            <form action="${baseUrl}comentarioSave" method="POST" enctype="multipart/form-data" class="form__comments">
                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                <div class="input-group">
                                                    <div class="file-select">
                                                        <input type="file" name="imagen" id="imagenPublicacion" aria-label="Archivo">
                                                    </div>
                                                    <button type="button" id="emojiToggle" class="btn btn-secondary">😄 Emojis</button>
                                                    <input type="text" class="form-control comentario-input" placeholder="Escribe tu Comentario" name="comentario">
                                                    <button class="btn btn-primary" type="submit">Enviar
                                                    </button>
                                                </div>
                                                <div class="text-center form__collapse">contraer Formulario</div>
                                                <!-- Cuadro de emojis visible inicialmente -->
                                                <div class="emoji-picker" style="display: none; margin-top: 10px;">
                                                    <span class="chat-container__emoji">😊</span>
                                                    <span class="chat-container__emoji">😂</span>
                                                    <span class="chat-container__emoji">😍</span>
                                                    <span class="chat-container__emoji">😉</span>
                                                    <span class="chat-container__emoji">😭</span>
                                                    <span class="chat-container__emoji">😎</span>
                                                    <span class="chat-container__emoji">😡</span>
                                                    <span class="chat-container__emoji">🥺</span>
                                                    <span class="chat-container__emoji">😜</span>
                                                    <span class="chat-container__emoji">🤔</span>
                                                    <span class="chat-container__emoji">👍</span>
                                                    <span class="chat-container__emoji">🙏</span>
                                                    <span class="chat-container__emoji">❤️</span>
                                                    <span class="chat-container__emoji">🎉</span>
                                                    <span class="chat-container__emoji">🔥</span>
                                                    <span class="chat-container__emoji">🤯</span>
                                                    <span class="chat-container__emoji">🤩</span>
                                                    <span class="chat-container__emoji">😇</span>
                                                    <span class="chat-container__emoji">🥳</span>
                                                    <span class="chat-container__emoji">🤪</span>
                                                    <span class="chat-container__emoji">👀</span>
                                                    <span class="chat-container__emoji">😏</span>
                                                    <span class="chat-container__emoji">💀</span>
                                                    <span class="chat-container__emoji">👻</span>
                                                    <span class="chat-container__emoji">🤤</span>
                                                    <span class="chat-container__emoji">😴</span>
                                                    <span class="chat-container__emoji">👑</span>
                                                    <span class="chat-container__emoji">💩</span>
                                                    <span class="chat-container__emoji">🦄</span>
                                                    <span class="chat-container__emoji">🐶</span>
                                                </div>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>`;

        $('#exampleModal').after(cardHtml);

        // Llamada a los métodos desde la instancia
        window.initPublication.showComments();
        window.initPublication.save();
        window.initPublication.collapseComments();
        window.initPublication.emojis();
    });

