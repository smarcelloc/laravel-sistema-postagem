@extends('layouts.app')

@section('content')
<div class="container">
    @can('user-create')
        <div class="mb-4 text-right">
            <a class="btn btn-success" href="{{route('user.create')}}">Adicionar Usuário</a>
        </div>
    @endcan()

    <div class="card p-2 table-responsive">
    <table class="table datatable nowrap table-hover w-100">
        <thead class="bg-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Privilégio</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 0; @endphp
            @foreach ($users as $user)
            <tr>
                <td>{!!++$count!!}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @forelse ($user->role as $item)
                        <span class="badge badge-pill badge-success mr-1">{{$item->label}}</span>
                    @empty
                        <span class="badge badge-pill badge-light">Nenhum</span>
                    @endforelse
                </td>
                <td class="text-center">
                    @can('user-create')
                    <a href="{{route('user.show', ['user' => $user->id])}}" class="btn btn-sm btn-info" title="Ver" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-eye" data-toggle="tooltip" data-placement="bottom"></i></a>
                    @endcan()
                    @can('user-edit')
                    <a href="{{route('user.edit', ['user' => $user->id])}}" class="btn btn-sm btn-warning" title="Editar" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-edit" data-toggle="tooltip" data-placement="bottom"></i></a>
                    @endcan()
                    @can('user-destroy')
                    <form action="{{route('user.destroy',['user' => $user->id])}}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Você deseja excluir esta regra?')" class="btn btn-sm btn-danger" title="Excluir" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-trash"></i></button>
                    </form>
                    @endcan()
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
