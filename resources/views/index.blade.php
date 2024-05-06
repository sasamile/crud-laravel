@extends('layouts.base')

@section('content')
<div class="row">

    <div style="display:grid; grid-template-columns: 2; justify-content: center; align-items: center;">
        
            <h2 style="color: white; font-weight: bold; text-transform: uppercase; padding-top: 100px; padding-bottom: 5px;">CRUD de Tareas</h2>
        

       
            <a href="{{route('tasks.create')}}" class="btn btn-primary">Crear tarea</a>

        
    </div>




    @if(Session::get('success'))
    <div class="alert alert-success">
        <strong>{{ Session::get('success') }}</strong> <br>
    </div>
    @endif

    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>

            @foreach ($tasks as $task)
            <tr>
                <td class="fw-bold">{{$task -> title}}</td>
                <td>{{$task -> description}}</td>
                <td>
                    {{date('d/m/Y', strtotime($task-> due_date))}}
                </td>
                <td>

                    @if($task -> status == 'Pendiente')
                    <span style="background-color: red; font-weight: bold; border-radius: 10px; padding:10px; display: flex; justify-content: center; align-items: center">
                        {{$task -> status}}
                    </span>
                    @elseif($task -> status == 'En progreso')
                    <span style="background-color: #B8A95C; font-weight: bold; border-radius: 10px; padding:10px; display: flex; justify-content: center; align-items: center">
                        {{$task -> status}}
                    </span>

                    @elseif($task -> status == 'Completo')
                    <span style="background-color: green; font-weight: bold; border-radius: 10px; padding:10px; display: flex; justify-content: center; align-items: center">
                        {{$task -> status}}
                    </span>
                    @endif


                </td>
                <td>
                    <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-warning">Editar</a>

                    <form action="{{route('tasks.destroy',$task)}}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>
        {{$tasks->links()}}
    </div>
</div>
@endsection