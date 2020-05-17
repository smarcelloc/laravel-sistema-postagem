@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-2 table-responsive">
    <table class="table table-sm datatable table-hover w-100">
        <thead class="bg-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Permissão</th>
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
                <td>
                    @forelse ($role->permission as $item)
                        <span class="badge badge-success mr-1">{{$item->label}}</span>
                    @empty
                        <span class="badge badge-light">Nenhum</span>
                    @endforelse
                </td>
                <td style="width:0.8rem">
                    @can('role-edit')
                    <a href="{{route('permission.edit', ['role' => $role->id])}}" class="btn btn-sm btn-success" title="Alterar permissão" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-key" data-toggle="tooltip" data-placement="bottom"></i></a>
                    @endcan()
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

@endsection
