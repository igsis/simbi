@extends('layouts.master2')

@section('titulo','Cadastrar Ocorrência')
@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header">
                <i class="glyphicon glyphicon-flag"></i> Cadastrar Ocorrência
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $equipamento->nome }}</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{route('eventos.grava.ocorrencia', [$equipamento->igsis_id, $evento->igsis_evento_id])}}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="form-group">
                                <label for="nome">Nome do Evento</label>
                                <input class="form-control" type="text" id="nome" name="nome" readonly value="{{ $evento->nome_evento }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="form-group ">
                                    <label for="data">Data</label>
                                    <input class="form-control" type="date" name="data" value="{{ old('data') }}" onblur="arrumaData()">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group ">
                                    <label for="hora">Hora</label>
                                    <input class="form-control hora" maxlength="5" type="text" data-mask="00:00" name="hora" id="hora" placeholder="Digite a hora" value="{{ old('hora') }}">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success"> Cadastrar</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
    $(document).ready(function(){
        $(".hora").mask("99:99");
    });
    </script>

    <script type="text/javascript">

    </script>

@endsection
