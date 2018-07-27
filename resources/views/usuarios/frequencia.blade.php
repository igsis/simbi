@extends('layouts.master')


@section('scripts_css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet">
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.pt-BR.min.js')}}"></script>
@endsection

@section('conteudo')



    <div class="col-lg-6 col-lg-offset-3">
        <h1><i class="glyphicon glyphicon-user"></i>Frequência de Usuário</h1>
        <hr>

        <form method="POST" action="">
            {{ csrf_field() }}
            <label for="name">Data</label>
            <div class="input-group date" data-provide="datepicker">                
                <input type="text" class="form-control">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
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

    </div>

@endsection

@section('scripts_adicionais')

    <script type="text/javascript">
        $('#exemplo').datepicker({
            format: 'dd/mm/yyyy'
        });
    </script>

@endsection