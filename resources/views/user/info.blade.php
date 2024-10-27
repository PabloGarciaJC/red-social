<div class="tab-pane fade show {{ session('message') || $errors->any() ? '' : 'active' }} profile-overview" id="perfil">
    {{-- Mensaje de Notificacion de estados --}}
    {!! $alertMessage !!}
    @if (session('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger text-center" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <h5 class="card-title">Sobre Mi</h5>
    <p class="small">{{ Auth::user()->sobreMi }}</p>
    <h5 class="card-title">Detalles de mi Perfil</h5>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Nombre</div>
        @foreach ($usuario as $user)
            <div class="col-lg-9 col-md-8">{{ $user->nombre }}</div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Apellido</div>
        @foreach ($usuario as $user)
            <div class="col-lg-9 col-md-8">{{ $user->apellido }}</div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Empresa</div>
        @foreach ($usuario as $user)
            <div class="col-lg-9 col-md-8">{{ $user->empresa }}</div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Cargo</div>
        @foreach ($usuario as $user)
            <div class="col-lg-9 col-md-8">{{ $user->cargo }}</div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Pais</div>
        @foreach ($usuario as $user)
            <div class="col-lg-9 col-md-8">{{ $user->pais }}</div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Dirección</div>
        @foreach ($usuario as $user)
            <div class="col-lg-9 col-md-8">{{ $user->direccion }}</div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Móvil</div>
        @foreach ($usuario as $user)
            <div class="col-lg-9 col-md-8">{{ $user->movil }}</div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Email</div>
        @foreach ($usuario as $user)
            <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
        @endforeach
    </div>
</div>