@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header font-weight-bold">Editar a permissão</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('permission.update', ['role' => $role->id]) }}" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" disabled value="{{$role->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" disabled value="{{ $role->label }}">
                            </div>
                        </div>



                    @error('permissions')
                        <strong class="text-danger m-1">{{ $message }}</strong>
                    @enderror

                    <div class="form-group border p-2">
                        <h2 class="h5 font-weight-bold">Permissões</h2>
                        @forelse ($permission as $item)
                            <div class="custom-control custom-switch col-12 pt-1">
                                <input type="checkbox" class="custom-control-input" name="permissions[]" @if(in_array($item->id, $role->permission->pluck('id')->toArray())) checked @endif value="{{$item->id}}" id="customSwitch{{$item->name}}">
                                <label class="custom-control-label" for="customSwitch{{$item->name}}">{{Str::limit($item->label,30)}}</label>
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
                                <a href="{{route('permission.index')}}" class="btn btn-light active ml-3"> Cancelar</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
