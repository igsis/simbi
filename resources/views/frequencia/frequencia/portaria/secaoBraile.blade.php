@extends('layouts.master2')
@include('layouts.br')
@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection


@section('titulo','Público de Seção Braile')

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
                <i class="fa fa-users"></i>
                Público de Seção Braile
                <small>{{ $equipamento->nome }}</small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de público de Seção Braile</h3>
                </div>
                <div class="box-body">
                    <table id="tabela1" class="table table-bordered table-striped">
                        <thead>
                        @if ($equipamento->secaoBrailes->count() != 0)
                            <tr>
                                <th>Data</th>
                                <th>Dia da Semana</th>
                                <th>Total</th>
                                <th>Data Envio</th>
                                <th>Operação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipamento->secaoBrailes as $frequencia)
                                <tr align="center">
                                    <td>{{ date('d/m/Y', strtotime($frequencia->data)) }}</td>
                                    <td>{{ ucwords(strftime('%A', strtotime($frequencia->data))) }}</td>
                                    <td>{{ $frequencia->quantidade }}</td>
                                    <td>{{ date('d/m/Y', strtotime($frequencia->data_envio))  }}</td>
                                    <td> <button onclick='preencherCampos("{{ date('d/m/Y', strtotime($frequencia->data)) }}","{{$frequencia->quantidade}}", "{{$frequencia->id}}")'
                                                 class="btn btn-success"
                                                 style="margin-right: 3px"><i
                                                    class="glyphicon glyphicon-plus-sign"></i> Editar
                                        </button>
                                        <button onclick='apagarFrequencia({{$frequencia->id}})'
                                                 class="btn btn-danger"
                                                 style="margin-right: 3px"><i
                                                    class="glyphicon glyphicon-trash"></i> Apagar
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <th colspan="2" class="text-center">Não há frequência cadastradas</th>
                                    </tr>
                                @endif
                        </tbody>
                    </table>

                    <div class="form-group col-md-offset-4 col-md-3">
                        <a href="{{ route('frequencias.enviadas',['type'=>'3']) }}" class="form-control btn btn-warning">
                            Retornar à Lista de Equipamentos
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="modal modal-danger fade" id="apagarModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Apagar</h4>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente apagar este registro</p>
                </div>
                <form action="{{route('frequencia.portaria.destroyBraile')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" id="frequenciaId" name="frequenciaId">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-outline">Apagar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @include('frequencia.frequencia.secaoBraile')
@endsection

@section('scripts_adicionais')

    @include('scripts.tabelas_admin')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        function preencherCampos(data, quantidade, idPublico) {
            limparCampos();
            let formulario = document.querySelector('#formBraile');
            formulario.action = '{{route('frequencia.portaria.updateBraile')}}';
            formulario.setAttribute('method', 'POST')
            document.querySelector('#quantidade').value = quantidade;
            document.querySelector('#calendarioBraile').value = data;
            document.querySelector('#idPublico').value = idPublico;

            $('#SecaoBraile').modal('show');
        }

        function limparCampos() {
             $('#idPublico').val('')
             $('#calendarioBraile').val('')
            $('#quantidade').val('')
        }

        function apagarFrequencia(idFrequencia) {
            $('#apagarModal').modal('show');
            $('#frequenciaId').val(idFrequencia);
        }

    </script>
@endsection