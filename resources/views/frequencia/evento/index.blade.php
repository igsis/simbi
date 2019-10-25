@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Eventos nos Equipamentos')

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
                Eventos nos Equipamentos
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
                                            <a href="{{ route('eventos.listar', $equipamento->id) }}"
                                               class="btn btn-success" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-plus-sign"></i> Eventos</a>
                                        @else
                                            <a href="{{ route('frequencia.listar', $equipamento->id) }}"
                                               class="btn btn-warning" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-stats"></i> Frequência Evento Interno</a>
                                            <a href="#" class="btn btn-warning" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-stats"></i> Frequência Evento Externo</a>
                                            <a href="{{ route('frequencia.portaria.listar', $equipamento->id) }}"
                                               class="btn btn-warning" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-stats"></i> Frequência Mensal</a>
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

@endsection

@section('scripts_adicionais')
    @include('scripts.tabelas_admin')
@endsection
