@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('news.search')}}" method="get" class="mb-5">
            @csrf
            <div class="input-group mb-3">
            <input type="search" name="search" id="search" class="form-control form-control-lg" placeholder="Pesquisar título da postagem, autor e email do autor ..." @isset($search) value="{{$search}}" @endisset>
                <div class="input-group-prepend">
                    @isset($search)
                    <a href="{{route('news.index')}}" class="btn btn-lg pb-1 btn-danger text-white" data-toggle="tooltip" data-placement="bottom" title="Limpar pesquisa"><i class="fas fa-times"></i></a>
                    @endisset
                    <button type="submit" title="Pesquisar" class="btn btn-lg btn-primary rounded-right pb-1" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    @can('news-create')
        <div class="mb-4 text-right">
            <a class="btn btn-success" href="{{route('news.create')}}">Adicionar Posts</a>
        </div>
    @endcan()
    @forelse($news as $post)
        @can('news-show')
        <div class="card mb-5 border-0 shadow">
            <div class="card-header bg-white border-0 pb-0">
                <h1 class="card-title float-left h3">{{$post->title}}</h1>
                <div class="float-right">
                    @can('news-show')
                        <a href="{{route('news.show',['news' => $post->id])}}" class="btn btn-sm btn-info" title="Ver" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-eye"></i></a>
                    @endcan()
                    @can('news-edit')
                        <a href="{{route('news.edit',['news' => $post->id])}}" class="btn btn-sm btn-warning" title="Editar" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    @endcan()
                    @can('news-destroy')
                        <form action="{{route('news.destroy',['news' => $post->id])}}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Você deseja excluir esta postagem?')" title="Excluir" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-trash"></i></button>
                    </form>
                    @endcan()
                </div>
            </div>
            <div class="card-body">
                <p class="card-text text-justify">{{Str::limit($post->description,500)}}</p>
            </div>
            <div class="card-footer">
                <small class="font-weight-bold">Autor: {{$post->user->name}}</small><br>
                <small class="timezone-date">Postado: {{$post->created_at}}</small>
            </div>
        </div>
        @endcan()
    @empty
    <p>Nenhum posts encontrado</p>
    @endforelse
</div>

    <div class="d-flex justify-content-center">
        @isset($search)
            {!! $news->appends($_GET)->links() !!}
        @else
            {!! $news->links()!!}
        @endisset

    </div>
@endsection
