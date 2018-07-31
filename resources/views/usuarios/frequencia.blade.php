@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-6 col-lg-offset-3">
        <h1><i class="glyphicon glyphicon-user"></i>Frequência de Usuário</h1>
        <hr>

        <form method="POST" action="">
            {{ csrf_field() }}

            <div class="form-group ">
                <label for="evento">Evento</label>
                <input class="form-control" type="text" name="evento">
            </div>

            <div class="form-group ">
                <label for="email">Data</label>
                <input class="form-control" type="date" name="data">
            </div>

            <div class="form-group ">
                <label for="login">Hora</label>
                <input class="form-control" type="text" data-mask="00:00" name="hora" id="hora">
            </div>

            <div class="form-group ">
                <label for="email">Criança</label>
                <input class="form-control" type="number" id="crianca" name="crianca">
            </div>

            <div class="form-group ">
                <label for="jovem">Jovem</label>
                <input class="form-control" type="number" id="jovem" name="jovem" >
            </div>

            <div class="form-group ">
                <label for="adulto">Adulto</label>
                <input class="form-control" type="number" id="adulto" name="adulto" >
            </div>
        
            <div class="form-group ">
                <label for="idoso">Idoso</label>
                <input class="form-control" type="number" id="idoso" name="idoso" >
            </div>

            <div class="form-group ">
                <label for="total">Total</label>
                <input class="form-control" id="total" type="number" disabled>
            </div>

            <div class="form-group ">
                <label for="total">Observação</label>
                <input class="form-control" type="text" name="observacao">
            </div>

            <input class="btn btn-success" type="submit" value="Cadastrar">
        </form>

    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
        

    </script>

@endsection