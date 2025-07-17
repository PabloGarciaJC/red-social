@extends('layouts.app')

@section('core-content')
<main id="main" class="main">
    <div class="card info-card sales-card">
        <div class="intro-board">
            <div class="card__info">
                <span class="title__intro">Lista de Usuarios</span>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Alias</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Cambiar Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->alias }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <form action="{{ route('roles.updateStatus', $user->id) }}" method="POST" style="display:inline;" class="form__status">
                                    @csrf
                                    @method('PATCH')
                                    <label class="switch">
                                        <input type="checkbox" name="status" onchange="this.form.submit()" {{ $user->status === 'active' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
