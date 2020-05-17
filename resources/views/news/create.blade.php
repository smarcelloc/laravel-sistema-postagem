@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-5 border-0 shadow">
        <div class="card-header font-weight-bold">Adicionar Posts</div>
        <div class="card-body">
            <form action="{{route('news.store')}}" method="post" accept-charset="UTF-8">
                @csrf
                <div class="form-group">
                    <label for="title">Título</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" autocomplete="title" value="{{old('title')}}" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{!! $message !!}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea name="description" rows="15" class="form-control @error('description') is-invalid @enderror" id="description" required>{{old('description')}}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{!! $message !!}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="{{URL::previous()}}" class="btn btn-light active ml-3"> Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
