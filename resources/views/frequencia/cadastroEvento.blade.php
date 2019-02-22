@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-6 col-lg-offset-3">
        <h1>
            <i class="glyphicon glyphicon-flag"></i> Cadastrar Evento <br>
        </h1>
        <hr>

        <form method="POST" action="{{route('eventos.gravar', $equipamento->igsis_id) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="form-group">
                    <label for="evento_ocorrencia_id">Nome do Evento</label>
                    <input class="form-control" type="text" id="nome" name="nome">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <div class="form-group ">
                        <label for="email">Tipo Evento</label>
                        <select name="tipoEvento" id="tipoEvento" class="form-control">
                            <option value="">Selecione...</option>
                            @foreach($tipoEvento as $evento)
                                <option value="{{ $evento->id }}">{{ $evento->tipo_evento }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="form-group ">
                        <label for="jovem">Projeto Especial</label>
                        <select name="projetoEspecial" id="projetoEspecial" class="form-control">
                            <option value="">Selecione...</option>
                            @foreach($projetoEspecial as $projeto)
                                <option value=" {{ $projeto->idProjetoEspecial }}">{{ $projeto->projetoEspecial }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="form-group ">
                        <label for="adulto">Forma de Contratação</label>
                        <select name="contratacao" id="contratacao" class="form-control">
                            <option value="">Selecione...</option>
                            @foreach($contratacao as $contrata)
                                <option value="{{ $contrata->id }}">{{ $contrata->forma_contratacao }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group hidden">
                <label for="id">Igsis Evento id</label>
                <input type="text" name="igsis_evento_id" id="igsis_evento_id" value="{{ $igsis_evento_id + 1}}">
            </div>

            <button class="btn btn-success"> Cadastrar</button>
        </form>


    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

    </script>

    <script type="text/javascript">

    </script>

@endsection
