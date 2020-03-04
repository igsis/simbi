@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Acervo')

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
                <i class="fa  fa-list"></i>
                @if($type == 1)
                    Consulta por Equipamentos
                @elseif($type == 2)
                    Empréstimo por Equipamentos
                @else
                    Relatório por Equipamentos
                @endif
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
                                <th>Operações</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if ($equipamentos->count() != 0)
                                    @foreach($equipamentos as $equipamento)
                                        <tr>
                                            <td>{{$equipamento->nome}}</td>
                                            <td>
                                            @if($type == 1) <!---Consulta--->
                                                <a href="{{ route('consulta.inserir', [$equipamento->id]) }}"
                                                       class="btn bg-purple" style="margin-right: 3px"><i
                                                                class="fa fa-pencil-square-o"></i> &nbsp;Registrar Consulta</a>
                                                <a href="{{ route('consulta.registros', [$equipamento->id]) }}"
                                                   class="btn bg-navy" style="margin-right: 3px"><i
                                                            class="fa fa-list"></i> &nbsp;Visualizar Registros</a>

                                            @elseif($type == 1.2)
                                                    <a href="{{ route('consulta.relatorio', $equipamento->id) }}"
                                                       class="btn bg-navy" style="margin-right: 3px"><i
                                                                class="fa fa-list"></i> &nbsp;Relatório </a>

                                            @elseif($type == 2) <!---Emprestimo--->
                                                <a href="{{ route('emprestimo.inserir', [$equipamento->id]) }}"
                                                   class="btn bg-purple" style="margin-right: 3px"><i
                                                            class="fa fa-pencil-square-o"></i> &nbsp;Registrar Consulta</a>
                                                <a href="{{ route('emprestimo.registros', [$equipamento->id]) }}"
                                                   class="btn bg-navy" style="margin-right: 3px"><i
                                                            class="fa fa-list"></i> &nbsp;Visualizar Registros</a>

                                                @elseif($type == 2.2)
                                                    <a href="{{ route('emprestimo.relatorio', $equipamento->id) }}"
                                                       class="btn bg-navy" style="margin-right: 3px"><i
                                                                class="fa fa-list"></i> &nbsp;Relatório </a>
                                            @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="2" class="text-center">Não há equipamentos cadastrados</th>
                                    </tr>
                                @endif
                            </tbody>
                            <tfooter>
                                <thead>
                                <tr>
                                    <th>Nome do Equipamento</th>
                                    <th>Operações</th>
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
