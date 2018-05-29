@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-6 col-lg-offset-3">
        <h1><i class="glyphicon glyphicon-user"></i>Cadastrar Usuario</h1>
        <hr>

        <form method="POST" action="{{ route('usuarios.index') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Nome</label>
                <input class="form-control" type="text" name="name" id="name">
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="login">Login</label>
                    <input class="form-control" type="text" name="login" id="login" maxlength="7">
                </div>

                <div class="form-group col-md-9">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>
            </div>

            <div class="form-group">
                <label for="roles">Cargo</label>
                <select class="form-control" name="roles" id="roles">
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            <input class="btn btn-primary" type="submit" value="Adicionar">
        </form>

    </div>

@endsection