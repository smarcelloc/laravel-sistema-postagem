@extends('layouts.app')

@section('content')
<div class="container">
    @can('role-create')
        <div class="mb-4 text-right">
            <a class="btn btn-success" href="{{route('role.create')}}">Adicionar Regras</a>
        </div>
    @endcan()

    <div class="card p-2 table-responsive">
    <table class="table datatable nowrap table-hover w-100">
        <thead class="bg-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 0; @endphp
            @foreach ($roles as $role)
            <tr>
                <td>{!!++$count!!}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->label}}</td>
                <td class="text-center">
                    @if($role->name != 'root')
                    @can('role-create')
                    <a href="{{route('role.show', ['role' => $role->id])}}" class="btn btn-sm btn-info" title="Ver" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-eye" data-toggle="tooltip" data-placement="bottom"></i></a>
                    @endcan()
                    @can('role-edit')
                    <a href="{{route('role.edit', ['role' => $role->id])}}" class="btn btn-sm btn-warning" title="Editar" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-edit" data-toggle="tooltip" data-placement="bottom"></i></a>
                    @endcan()
                    @can('role-destroy')
                    <form action="{{route('role.destroy',['role' => $role->id])}}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Você deseja excluir este usuário?')" class="btn btn-sm btn-danger" title="Excluir" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-trash"></i></button>
                    </form>
                    @endcan()
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

@endsection
