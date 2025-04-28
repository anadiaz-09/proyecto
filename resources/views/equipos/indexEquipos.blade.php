@extends('dashboard')

@section('nuevo')
    <a href="{{ route('equipos.create') }}" class="btn btn-crear btn-sm"><i class="fa-solid fa-plus"></i><strong> Nuevo equipo</strong></a>
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

    <div class="container">
        <div class="container d-flex justify-content-center align-items-center" style="width: 40vw; height: 10vh;  ">
            @if($equipos->isEmpty())
                <p>No hay equipos disponibles.</p>
            @else
        </div>

            <div class="row">
                @foreach($equipos as $equipo)
                    <div class="col-md-4">
                        <div class="card card-club">
                            <div class="card-header header-equipo">
                                <small>Desde {{ \Carbon\Carbon::parse($equipo->fecha_creacion)->format('d-m-Y') }}</small>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><strong>{{ $equipo->nombre }}</strong></h5>
                                <p class="card-text">{{ $equipo->descripcion }}</p>
                                <br><hr><br>
                                <a href="{{ route('equipos.show', ['id'=> $equipo->id]) }}" class="btn btn-ver btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('equipos.edit', ['id'=> $equipo->id]) }}" class="btn btn-editar btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button type="button" class="btn btn-borrar btn-sm" data-bs-toggle="modal" data-bs-target="#MODALELIMINARC{{$equipo->id}}" >
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="MODALELIMINARC{{$equipo->id}}" tabindex="-1" aria-labelledby="MODALELIMINARCLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="MODALELIMINARCLabel">Eliminar Equipo</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar el equipo <strong>{{ $equipo->nombre }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                                    <form method="post" action="{{ route('equipos.destroy' , ['id'=>$equipo->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Eliminar" class="btn btn-success">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
