@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4 text-right">
        <a class="btn btn-secondary" href="{{URL::previous()}}">Voltar</a>
    </div>
    @isset($news)
    <div class="card mb-5 border-0 shadow">
        <div class="card-header bg-white border-0 pb-0">
            <h1 class="card-title h3">{{$news->title}}</h1>
        </div>
        <div class="card-body">
            <p class="card-text text-justify">{{$news->description}}</p>
        </div>
        <div class="card-footer">
            <small class="font-weight-bold">Autor: {{$news->user->name}}</small><br>
            <small class="timezone-date">Postado: {{$news->created_at}}</small>
        </div>
    </div>
    @endisset
</div>

@endsection
