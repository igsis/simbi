@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-6 col-lg-offset-3">
        <h1><i class="glyphicon glyphicon-user"></i>Frequência de Usuário</h1>
        <hr>

        <form method="POST" action="">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Data</label>
                <input class="form-control" type="date" name="name" id="name">
            </div>

        
            <div class="form-group ">
                <label for="login">Hora</label>
                <input class="form-control" type="number" name="login" id="login" maxlength="7">
            </div>

            <div class="form-group ">
                <label for="email">Criança</label>
                <input class="form-control" type="number" name="crianca">
            </div>

            <div class="form-group ">
                <label for="jovem">Jovem</label>
                <input class="form-control" type="number" name="jovem" >
            </div>


            <div class="form-group ">
                <label for="adulto">Adulto</label>
                <input class="form-control" type="number" name="adulto" >
            </div>
        
            <div class="form-group ">
                <label for="idoso">Idoso</label>
                <input class="form-control" type="number" name="idoso" >
            </div>

            <div class="form-group ">
                <label for="total">Total</label>
                <input class="form-control" type="number"  >
            </div>

            <input class="btn btn-success" type="submit" value="Cadastrar">
        </form>

    </div>

@endsection