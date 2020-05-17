@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4 text-right">
        <a class="btn btn-secondary" href="{{route('role.index')}}">Voltar</a>
    </div>
    @isset($role)
    <div class="card mb-5">
        <div class="card-header bg-white border-0 pb-0">
            <h1 class="card-title h3">{{$role->label}}</h1>
        </div>
        <div class="card-body table-responsive">
            <table class="table nowrap table-hover w-100">
                <thead class="bg-light">
                    <tr>
                        <th scope="col">Campo</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                     <tr>
                        <td>Identificação</td>
                        <td>{{$role->id}}</td>
                    </tr>
                    <tr>
                        <td>Nome</td>
                        <td>{{$role->name}}</td>
                    </tr>
                    {{--<tr>
                        <td>Privilégios</td>
                        <td>
                            @forelse ($role->role as $item)
                                <span class="badge badge-success">{{$item->label}}</span><br>
                            @empty
                                <span class="badge badge-light">Nenhum</span>
                            @endforelse

                        </td>
                    </tr>--}}
                    <tr>
                        <td>Criado</td>
                        <td>{{$role->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Atualizado</td>
                        <td>{{$role->updated_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    @endisset
</div>

@endsection
