@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Edição de Frequência')

@section('titulo','Eventos Culturais')


@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header"><i class="glyphicon glyphicon-pushpin"></i> Eventos Culturais </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Contação de histórias</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="">
                        {{ csrf_field() }}

                        <div class="hidden">
                            <div class="form-group">
                                <label for="evento_ocorrencia_id">Id da ocorrencia</label>
                                <input class="form-control" type="text" id="evento_ocorrencia_id" name="evento_ocorrencia_id" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tipoEvento">Categoria do Evento</label>
                            <input type="text" readonly class="form-control" value="Contação de histórias">
                        </div>

                        <div class="form-group">
                            <label for="tipoEvento">Projeto Especial</label>
                            <input type="text" readonly class="form-control" value="Baú de Histórias">
                        </div>


                        <div class="row">
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="email">Criança</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="crianca" name="crianca" value="20" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="jovem">Jovem</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="jovem" name="jovem" value="5" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="adulto">Adulto</label>
                                    <input class="form-control" type="number" id="adulto" min="0" max="9999" name="adulto" value="3" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="idoso">Idoso</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="idoso" name="idoso" value="0" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="publicoTotal">Publico Total: </label>
                            <input type="text" class="form-control" readonly min="0" max="9999" name="total" id="publicoTotal" onload="calcular()">
                        </div>

                        <div class="form-group ">
                            <label for="observacao">Observação</label>
                            <input class="form-control" type="text" name="observacao" value="{{old('observacao')}}">
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
        function calcular() {
            var crianca = parseInt(document.getElementById('crianca').value, 10);
            var jovem = parseInt(document.getElementById('jovem').value, 10);
            var adulto = parseInt(document.getElementById('adulto').value, 10);
            var idoso = parseInt(document.getElementById('idoso').value, 10);

            crianca = isNaN(crianca) ? 0 : crianca;
            jovem = isNaN(jovem) ? 0 : jovem;
            adulto = isNaN(adulto) ? 0 : adulto;
            idoso = isNaN(idoso) ? 0 : idoso;

            var calcula = crianca + jovem + adulto + idoso;
            var publico = document.getElementById("publicoTotal");

            publico.value = String(calcula);
        }

        window.onload = calcular();

    </script>

    <script type="text/javascript">

    </script>

@endsection
