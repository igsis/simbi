@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Frequência nos Equipamentos')

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
                <i class="glyphicon glyphicon-home"></i>
                Frequência nos Equipamentos
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Equipamentos</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nome do Equipamento</th>
                                <th width="60%">Operações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($equipamentos as $equipamento)
                                <tr>
                                    <td>{{$equipamento->nome}}</td>
                                    <td>
                                        @if($type == 1)
                                            <a href="{{ route('frequencia.ocorrencias', $equipamento->igsis_id) }}" class="btn btn-success" style="margin-right: 3px"><i class="glyphicon glyphicon-plus-sign"></i> Eventos</a>
                                            <a href="#" class="btn btn-success" style="margin-right: 3px"><i class="glyphicon glyphicon-plus-sign"></i> Evento Externo</a>
                                            @if ($equipamento->portaria == 1)
                                                <a href="{{route('frequencia.portaria.cadastro', $equipamento->id)}}" class="btn btn-success" style="margin-right: 3px" ><i class="glyphicon glyphicon-plus-sign"></i> Preenchimento Mensal</a>
                                            @else
                                                <button class="btn btn-success" style="margin-right: 3px" data-toggle="modal" data-target="#cadastroPortariaSimples" onclick="{{route('frequencia.portaria.cadastro', $equipamento->id)}}"><i class="glyphicon glyphicon-plus-sign"></i> Preenchimento Mensal</button>
                                            @endif
                                        @else
                                            <a href="{{ route('frequencia.listar', $equipamento->id) }}" class="btn btn-warning" style="margin-right: 3px"><i class="glyphicon glyphicon-stats"></i> Frequência Evento Interno</a>
                                            <a href="#" class="btn btn-warning" style="margin-right: 3px"><i class="glyphicon glyphicon-stats"></i> Frequência Evento Externo</a>
                                            <a href="{{ route('frequencia.portaria.listar', $equipamento->id) }}" class="btn btn-warning" style="margin-right: 3px"><i class="glyphicon glyphicon-stats"></i> Frequência Mensal</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <thead>
                                    <tr>
                                        <th>Nome do Equipamento</th>
                                        <th width="60%">Operações</th>
                                    </tr>
                                </thead>
                            </tfooter>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="cadastroPortariaSimples" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> Público Atendido</h4>
                </div>
                <!-- inicio do form -->
                <form  method="post">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Data do Evento
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="data">Data</label>
                                <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-end-date="0d">
                                <input type="text" class="form-control" name="data" id="data">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                                </div>
                                {{--<label for="data">Data</label>--}}
                                {{--<input class="form-control" type="date" name="data" id="data" value="{{old('data')}}">--}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Público Atendido
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="nome">Quantidade</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ old('quantidade') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input class="btn btn-success" type="submit" value="Cadastrar">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts_adicionais')
    <script src="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" defer>
        $(function () {
            $('#data').datepicker({
                autoclose: true,
                defaultDate: "11/1/2019",
                locale: 'pt-br'
            });
        });
    </script>
    @include('scripts.tabelas_admin')

@endsection
