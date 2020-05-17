@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header font-weight-bold">Adicionar Usuário</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}" autocomplete="off">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
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
                                        document.getElementById('timezone').value = "{{ old('timezone') ?? 'America/Sao_Paulo' }}";
                                    </script>
                                    @error('timezone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        @error('roles')
                            <strong class="text-danger m-1">{{ $message }}</strong>
                        @enderror

                        <div class="form-group border p-2">
                            <h2 class="h5 font-weight-bold">Regras</h2>
                            @forelse ($roles as $role)
                                <div class="custom-control custom-switch col-12">
                                    <input type="checkbox" class="custom-control-input" name="roles[]" value="{{$role->id}}" id="customSwitch{{$role->name}}">
                                    <label class="custom-control-label" for="customSwitch{{$role->name}}">{{Str::limit($role->label,30)}}</label>
                                </div>
                            @empty
                                Nenhum regra criada.
                            @endforelse
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Salvar') }}
                                </button>
                                <a href="{{route('user.index')}}" class="btn btn-light active ml-3"> Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
