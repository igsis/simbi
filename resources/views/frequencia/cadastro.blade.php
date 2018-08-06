@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-6 col-lg-offset-3">
        <h1>
            <i class="glyphicon glyphicon-user"></i> Frequência de Eventos <br>
            <small>{{$equipamento->nome}}</small>
        </h1>
        <hr>

        <form method="POST" action="{{route('frequencia.gravar', $equipamento->id)}}">
            {{ csrf_field() }}

            {{--TODO: Alterar Evento para combobox--}}
            <div class="form-group ">
                <label for="evento">Evento</label>
                <input class="form-control" type="number" name="evento" value="{{old('evento')}}">
            </div>

            <div class="form-group ">
                <label for="nomeEvento">Nome Evento</label>
                <input class="form-control" type="text" name="nomeEvento" disabled>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <div class="form-group ">
                        <label for="email">Data</label>
                        <input class="form-control" type="date" name="data" value="{{old('data')}}">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group ">
                        <label for="login">Hora</label>
                        <input class="form-control" type="text" data-mask="00:00" name="hora" id="hora" placeholder="Digite a hora" value="{{old('hora')}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                     <div class="form-group ">
                        <label for="email">Criança</label>
                        <input class="form-control" type="number" id="crianca" name="crianca" value="{{old('crianca')}}">
                    </div>
                </div>
                <div class="form-group col-md-3">
                     <div class="form-group ">
                        <label for="jovem">Jovem</label>
                        <input class="form-control" type="number" id="jovem" name="jovem" value="{{old('jovem')}}">
                    </div>
                </div>
                <div class="form-group col-md-3">
                     <div class="form-group ">
                        <label for="adulto">Adulto</label>
                <input class="form-control" type="number" id="adulto" name="adulto" value="{{old('adulto')}}">
                    </div>
                </div>
                <div class="form-group col-md-3">
                     <div class="form-group ">
                        <label for="idoso">Idoso</label>
                        <input class="form-control" type="number" id="idoso" name="idoso" value="{{old('idoso')}}">
                    </div>
                </div>
            </div>

            <div class="form-group ">
                <label for="total">Observação</label>
                <input class="form-control" type="text" name="observacao" value="{{old('observacao')}}">
            </div>

            <input class="btn btn-success" type="submit" value="Cadastrar">
        </form>

    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
        

    </script>

@endsection