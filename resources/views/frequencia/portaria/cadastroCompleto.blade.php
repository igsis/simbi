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
            <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> Público Atendido</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $equipamento->nome }}</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{route('frequencia.portaria.gravaCompleto', $equipamento->id)}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="programacaoInterna">Program. interna</label>
                                <input type="number" class="form-control" name="programacaoInterna" id="programacaoInterna">
                            </div>
                            <div class="form-group col-sm-4 col-sm-12">
                                <label for="programacaoExterna">Program. externa</label>
                                <input type="number" class="form-control" name="programacaoExterna" id="programacaoExterna">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="total">Total</label>
                                <input type="text" class="form-control" id="total" name="total" readonly>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                        <input class="btn btn-success" type="submit" value="Cadastrar">
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
