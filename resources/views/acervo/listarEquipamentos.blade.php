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
                <i class="fa fa-users"></i>
                @if($type == 1)
                    Consulta em Equipamentos
                @elseif($type == 2)
                    Empréstimo em Equipamentos
                @else
                    Bibliotecas Temáticas em Equipamentos
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
                            @if($type == 1)
                                @if ($equipamentos->count() != 0)
                                    @foreach($equipamentos as $equipamento)
                                        <tr>
                                            <td>{{$equipamento->nome}}</td>
                                            <td>
                                                <a href="{{ route('frequencia.ocorrencias', [$equipamento->id,1]) }}"
                                                   class="btn bg-navy" style="margin-right: 3px"><i
                                                            class="glyphicon glyphicon-eye-open"></i> &nbsp; Publico de Evento</a>
                                                @if($equipamento->portaria == 0)
                                                    <button type="button" data-toggle="modal"
                                                            data-target="#cadastroPortariaSimples"
                                                            data-title="Cadastro de Portaria"
                                                            class="btn bg-light-blue" style="margin-right: 3px"
                                                            onclick="setarIdEquipamento({{ $equipamento->id }})"> <i
                                                                class="glyphicon glyphicon-eye-open"></i> &nbsp; Público de Recepção
                                                    </button>
                                                @else
                                                    <a href="{{ route('frequencia.portaria.cadastroCompleto',$equipamento->id) }}"
                                                       class="btn bg-light-blue" style="margin-right: 3px"><i
                                                                class="glyphicon glyphicon-eye-open"></i> &nbsp; Público de Recepção</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="2" class="text-center">Não há equipamentos cadastrados</th>
                                    </tr>
                                @endif
                            @elseif($type == 2)
                                @if ($equipamentos->count() != 0)
                                    @foreach($equipamentos as $equipamento)
                                        <tr>
                                            <td>{{$equipamento->nome}}</td>
                                            <td>
                                                <a href="{{ route('frequencia.ocorrenciasEnviadas', [$equipamento->id,2]) }}"
                                                   class="btn bg-navy" style="margin-right: 3px"><i
                                                            class="glyphicon glyphicon-eye-open"></i> &nbsp; Ocorrência de Evento</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="2" class="text-center">Não há equipamentos cadastrados</th>
                                    </tr>
                                @endif
                            @else
                                @if ($equipamentos->count() != 0)
                                    @foreach($equipamentos as $equipamento)
                                        <tr>
                                            <td>{{$equipamento->nome}}</td>
                                            <td>
                                                <a href="{{ route('frequencia.portaria.listar', $equipamento->id) }}"
                                                   class="btn btn-info pull-right" style="margin-right: 3px"><i
                                                            class="fa fa-users"></i> &nbsp; Público de Recepção</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="2" class="text-center">Não há equipamentos cadastrados</th>
                                    </tr>
                                @endif
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
