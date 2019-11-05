@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Ocorrências de Eventos')

@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div id="mensagem" class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header">
                <i class="glyphicon glyphicon-th-list"></i>
                Ocorrências de Eventos - Enviadas
                <small>{{ $equipamento->nome }}</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Ocorrências</h3>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="50%">Eventos</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Total</th>
                                <th>Data de Envio</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($eventos as $evento)
                                    <tr class="evento" id="enviado">
                                        <td>{{ $evento->nome_evento }} <span
                                                    class="text-center text-red text-bold expirado"></span></td>
                                        <td class="dataFrequencia">{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                                        <td>{{ date('H:i', strtotime($evento->horario)) }}</td>
                                        <td>{{$evento->total}}</td>
                                        <td>{{ date('d/m/Y', strtotime($evento->data_envio))}}</td>
                                    </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <thead>
                                <tr>
                                    <th width="50%">Eventos</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Total</th>
                                    <th>Data de Envio</th>
                                </tr>
                                </thead>
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