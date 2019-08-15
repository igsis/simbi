@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Importar Eventos do Igsis')

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
                <i class="glyphicon glyphicon-th-list"></i>
                Eventos Cadastrados
                <small>{{-- $equipamento->nome --}}</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pesquisa de eventos</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="50%">Eventos</th>
                                    <th>Operações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($eventos as $evento)
                                <tr>
                                    <td>{{ $evento->nomeEvento }}</td>
                                    <td>
                                        <button class="btn btn-primary">Importar Evento</button>
                                    </td>
                                </tr>
                            @endforeach
                            @include('layouts.excluir_confirm')
                            </tbody>
                            <tfooter>
                                <tr>
                                    <th width="50%">Eventos</th>
                                    <th>Operações</th>
                                </tr>
                            </tfooter>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts_adicionais')
    @include('scripts.tabelas_admin')
@endsection