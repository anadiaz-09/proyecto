@extends('dashboard')
@section('titulo', 'Jugadores')
@section('nuevo')
    <a href="{{ route('jugadores.create') }}" class="btn btn-crear btn-sm"><i class="fa-solid fa-plus"></i><strong> Nuevo jugador</strong></a>
@endsection
@section('contenido')
    @if(session('exito'))
        <div class="alert alert-success">
            {{ session('exito') }}
        </div>
    @endif
    @if(session('fracaso'))
        <div class="alert alert-danger">
            {{ session('fracaso') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container" style="margin-top: 2vh;">
        @foreach($equiposConJugadores as $equipo)
            <div class="card mb-3">
                <div class="card-header">
                    <h1><strong>{{ $equipo->nombre }}</strong></h1>
                    <small>Desde {{ \Carbon\Carbon::parse($equipo->fecha_creacion)->format('d-m-Y') }}</small>
                </div>
                <div class="card-body">
                    @if($equipo->jugadores->isEmpty())
                        <p>No hay jugadores en este equipo.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col" class="th"><strong>Nombre</strong></th>
                                <th scope="col" class="th"><strong>Fecha de ingreso</strong></th>
                                <th scope="col" class="th"><strong>Acciones</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($equipo->jugadores as $jugador)
                                <tr>
                                    <td>{{ $jugador->nombre }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jugador->fecha_ingreso)->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('jugadores.show', ['id' => $jugador->id]) }}" class="btn btn-ver btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('jugadores.edit', ['id' => $jugador->id]) }}" class="btn btn-editar btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <button type="button" class="btn btn-borrar btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$jugador->id}}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalEliminar{{$jugador->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar {{ $jugador->nombre }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Quieres eliminar al jugador {{ $jugador->nombre }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <form method="post" action="{{ route('jugadores.destroy', ['id' => $jugador->id]) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="submit" value="Eliminar" class="btn btn-danger">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
