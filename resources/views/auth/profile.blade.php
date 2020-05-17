@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header font-weight-bold">Alterar meu perfil</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile') }}" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? Auth::user()->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? Auth::user()->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" describedby="help-password" name="password" autocomplete="new-password">
                                <small id="help-password" class="form-text text-muted">Caso não deseja alterar, deixa em branco</small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="timezone" class="col-md-4 col-form-label text-md-right">{{ __('Fuso Horário') }}</label>

                                <div class="col-md-6">
                                    <select name="timezone" id="timezone" class="custom-select @error('timezone') is-invalid @enderror required">
                                            @foreach (Config('list-timezones') as $item)
                                                <option value="{!! $item['value'] !!}">{!! $item['label'] !!}</option>
                                            @endforeach
                                    </select>
                                    <script>
                                        document.getElementById('timezone').value = "{{ old('timezone') ?? Auth::user()->timezone }}";
                                    </script>
                                    @error('timezone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Criado</label>

                                    <div class="col-md-6">
                                    <span class="form-control text-truncate bg-light">{{Auth::user()->created_at}}</span>
                                    </div>
                            </div>

                            <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Atualizado</label>

                                    <div class="col-md-6">
                                    <span class="form-control text-truncate bg-light">{{Auth::user()->updated_at}}</span>
                                    </div>
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary mt-3">
                                    {{ __('Alterar Perfil') }}
                                </button>
                                <a href="{{URL::previous()}}" class="btn btn-light active mt-3 ml-3"> Cancelar</a>
                                @if(Auth::user()->id != 1)
                                <form action="{{route('profile.delete')}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Você deseja deletar sua conta?')" class="btn mt-3 d-inline btn-link text-danger">Deletar conta</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
