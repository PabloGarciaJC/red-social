<div class="col-12">
    <div class="card info-card sales-card card-publication">
        <div class="card-body">
            <input id="userLogin" type="hidden" value="{{ Auth::user()->id }}"></input>
            <div class="d-flex align-items-center">
                <div class="button modal__btn-open" id="openModal">
                    <span class="modal__texto">
                        ¿Qué estás Pensando, {{ Auth::user()->alias }}.?
                    </span>
                    <span class="modal__icon-movil">
                        <i class="emoji-38"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>