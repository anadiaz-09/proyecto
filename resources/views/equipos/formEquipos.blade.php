@extends('dashboard')
@section('titulo')
    @if(isset($equipo))
        <h1>Editar información del equipo</h1>
    @else
        <h1>Crear un nuevo equipo</h1>
    @endif
@endsection
@section('contenido')
    <div class="container">
        <div class="card card-form mx-auto d-block card-form">
            <form method="POST"
                  @if(isset($equipo))
                      action="{{ route('equipos.update', ['id'=>$equipo->id]) }}"
                  @else
                      action="{{ route('equipos.store') }}"
                @endif
            >
                @csrf
                @if(isset($equipo))
                    @method('put')
                @endif
                @csrf
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="{{ isset($equipo) ? $equipo->nombre : old('nombre') }}">
                    <label for="nombre">Nombre</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="fecha_creacion" name="fecha_creacion" placeholder="Fecha de creación" value="{{ isset($equipo) ? $equipo->fecha_creacion : old('fecha_creacion') }}">
                    <label for="fecha_creacion">Fecha de creación</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicación" value="{{ isset($equipo) ? $equipo->ubicacion : old('ubicacion') }}">
                    <label for="ubicacion">Ubicación</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Descripción" id="descripcion" name="descripcion" style="height: 100px">
                        {{ isset($equipo) ? $equipo->descripcion : old('descripcion') }}
                    </textarea>
                    <label for="floatingTextarea2">Descripción</label>
                </div>
                <button type="submit" class="btn btn-ver" style="margin: 2vh;">
                    @if(isset($jugador))
                        Actualizar equipo
                    @else
                        Guardar equipo
                    @endif
                </button>
                <button type="reset" class="btn btn-dark">Limpiar</button>
            </form>
        </div>

        </div>
@endsection
