@extends('dashboard')
@section('titulo')
    @if(isset($jugador))
        <h1>Editar información del jugador</h1>
    @else
        <h1>Registrar un nuevo jugador</h1>
    @endif
@endsection
@section('contenido')
    <div class="container">
        <div class="card card-form mx-auto d-block card-form">
            <form method="POST"
                  @if(isset($jugador))
                    action="{{ route('jugadores.update', ['id'=>$jugador->id]) }}"
                  @else
                      action="{{ route('jugadores.store') }}"
                @endif
            >
                @csrf
                @if(isset($jugador))
                    @method('put')
                @endif
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="{{ isset($jugador) ? $jugador->nombre : old('nombre') }}">
                    <label for="nombre">Nombre</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" value="{{ isset($jugador) ? $jugador->correo : old('correo') }}">
                    <label for="correo">Correo electrónico</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="{{ isset($jugador) ? $jugador->telefono : old('telefono') }}">
                    <label for="telefono">Telefono</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" placeholder="Fecha de ingreso" value="{{ isset($jugador) ? $jugador->fecha_ingreso : old('fecha_ingreso') }}">
                    <label for="fecha_creacion">Fecha de ingreso</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" id="equipo_id" aria-label="Floating label select example" name="equipo_id">
                        <option selected>Seleccione el equipo</option>
                        @forelse($equipos as $equipo)
                            <option value="{{ $equipo->id }}"
                            @if(isset($jugador))
                                {{ $equipo->id == $jugador->equipo_id ? "selected" : "" }}>
                                @else
                                    {{ $equipo->id == old('equipo_id') ? "selected" : "" }}>
                                @endif
                                {{ $equipo->nombre }}</option>
                        @empty
                            <option value="0">No hay equipos</option>
                        @endforelse
                    </select>
                    <label for="equipo">Equipo</label>
                </div>
                <button type="submit" class="btn btn-ver" style="margin: 2vh;">
                    @if(isset($jugador))
                        Actualizar jugador
                    @else
                        Guardar jugador
                    @endif
                </button>
                <button type="reset" class="btn btn-dark">Limpiar</button>
            </form>
        </div>

    </div>
@endsection
