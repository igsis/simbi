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
                <i class="fa fa-university"></i>
                @if($type == 1)
                    Consulta por Equipamentos
                @elseif($type == 2)
                    Empréstimo por Equipamentos
                @elseif($type == 3)
                    Bibliotecas Temáticas por Equipamentos
                @elseif($type == 4)
                    Matrículas por Equipamentos
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
                                                       class="btn bg-olive" style="margin-right: 3px"><i
                                                                class="fa fa-list"></i> &nbsp;Relatório de Consultas </a>

                                            @elseif($type == 2) <!---Emprestimo--->
                                                <a href="{{ route('emprestimo.inserir', [$equipamento->id]) }}"
                                                   class="btn btn-primary" style="margin-right: 3px"><i
                                                            class="fa fa-pencil-square-o"></i> &nbsp;Registrar Consulta</a>
                                                <a href="{{ route('emprestimo.registros', [$equipamento->id]) }}"
                                                   class="btn btn-success" style="margin-right: 3px"><i
                                                            class="fa fa-list"></i> &nbsp;Visualizar Registros</a>

                                                @elseif($type == 2.1)
                                                    <a href="{{ route('emprestimo.relatorio', $equipamento->id) }}"
                                                       class="btn bg-success" style="margin-right: 3px"><i
                                                                class="fa fa-list"></i> &nbsp;Relatório de Empréstimos </a>

                                                @elseif($type == 3) <!---Bibliotecas Temáticas--->
                                                <a href="{{ route('bibliotecas.inserir', [$equipamento->id]) }}"
                                                   class="btn btn-primary" style="margin-right: 3px"><i
                                                            class="fa fa-pencil-square-o"></i> &nbsp;Registrar Biblioteca Temática</a>
                                                <a href="{{ route('bibliotecas.registros', [$equipamento->id]) }}"
                                                   class="btn btn-info" style="margin-right: 3px"><i
                                                            class="fa fa-list"></i> &nbsp;Visualizar Registros</a>

                                                @elseif($type == 3.1)
                                                    <a href="{{ route('bibliotecas.relatorio', $equipamento->id) }}"
                                                       class="btn bg-danger" style="margin-right: 3px"><i
                                                                class="fa fa-list"></i> &nbsp;Relatório de Bibliotecas Temáticas</a>

                                                @elseif($type == 4) <!---Matrícula--->
                                                <a href="{{ route('matricula.inserir', [$equipamento->id]) }}"
                                                   class="btn bg-purple" style="margin-right: 3px"><i
                                                            class="fa fa-pencil-square-o"></i> &nbsp;Registrar Matrícula</a>
                                                <a href="{{ route('matricula.registros', [$equipamento->id]) }}"
                                                   class="btn bg-maroon" style="margin-right: 3px"><i
                                                            class="fa fa-list"></i> &nbsp;Visualizar Registros</a>

                                                @elseif($type == 4.1)
                                                    <a href="{{ route('matricula.relatorio', $equipamento->id) }}"
                                                       class="btn bg-olive" style="margin-right: 3px"><i
                                                                class="fa fa-list"></i> &nbsp;Relatório de Matrículas</a>
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
