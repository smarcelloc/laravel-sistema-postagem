@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4 text-right">
        <a class="btn btn-secondary" href="{{route('user.index')}}">Voltar</a>
    </div>
    @isset($user)
    <div class="card mb-5">
        <div class="card-header bg-white border-0 pb-0">
            <h1 class="card-title h3">{{$user->name}}</h1>
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
                        <td>{{$user->id}}</td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td>Privilégios</td>
                        <td>
                            @forelse ($user->role as $item)
                                <span class="badge badge-pill badge-success">{{$item->label}}</span><br>
                            @empty
                                <span class="badge badge-pill badge-light">Nenhum</span>
                            @endforelse

                        </td>
                    </tr>
                    <tr>
                        <td>Criado</td>
                        <td>{{$user->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Atualizado</td>
                        <td>{{$user->updated_at}}</td>
                    </tr>
                    <tr>
                        <td>Fuso Horário</td>
                        <td>{{$user->timezone}}</td>
                    </tr>
                    <tr>
                        <td>E-mail Verificado</td>
                        <td>{{$user->email_verified_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    @endisset
</div>

@endsection
