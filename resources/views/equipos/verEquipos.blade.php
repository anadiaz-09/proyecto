@extends('dashboard')

@section('titulo', 'Detalles del equipo')

@section('contenido')
    <div class="container">
        <div class="card card-jugadores">
            <div class="card-header" style="background-color: #6fce6f;">
                <h1 style="color: #000000; font-size: 30px;"><strong> {{ $equipo->nombre }}</strong></h1>
                <h3><strong>Descripción:</strong> {{ $equipo->descripcion }}</h3>
                <h3><strong>Ubicación:</strong> {{ $equipo->ubicacion }}</h3>
                <h3><small>Desde {{  $equipo->fecha_creacion }}</small></h3>
            </div>
            <div class="card-body">
                <h2>Jugadores asignados al equipo</h2><br>

                @if($equipo->jugadores->isEmpty())
                    <p>No hay jugadores en este equipo.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col" class="th"><strong>Nombre</strong></th>
                            <th scope="col" class="th"><strong>Fecha de ingreso</strong></th>
                            <th scope="col" class="th"><strong>Equipo</strong></th>
                            <th scope="col" class="th"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jugadores as $jugador)
                            <tr>
                                <td>{{  $jugador->nombre  }}</td>
                                <td>{{  $jugador->fecha_ingreso  }}</td>
                                <td>{{  $jugador->equipo_id  }}</td>
                                <td>
                                    <a href="{{ route('jugadores.show',['id' => $jugador->id]) }}" class="btn btn-ver btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('jugadores.edit', ['id' => $jugador->id]) }}" class="btn btn-editar btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <button type="button" class="btn btn-borrar btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$jugador->id}}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalEliminar{{$jugador->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar {{$jugador->nombre}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Quiere eliminar el jugador {{$jugador->nombre}}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <form method="post" action="{{ route('jugadores.destroy' , ['id'=>$jugador->id]) }}">
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
    </div>
@endsection
