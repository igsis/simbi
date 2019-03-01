@include('layouts.br')
@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Eventos Cadastrados')

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
                <small>{{ $equipamento->nome }}</small></h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Eventos</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            </tr>
                        <tbody>
                        @if ($equipamento->frequencias->count() != 0)
                            <tr>
                                <th colspan="4" class="text-center">Frequências Cadastradas</th>
                            </tr>
                            <tr>
                            @foreach ($equipamento->frequencias as $frequencia)
                                <tr>
                                    <th colspan="2">Data: {{ date('d/m/Y', strtotime($frequencia->data)) }}</th>
                                    <th colspan="2">Usuario: {{$frequencia->user->name}}</th>
                                </tr>
                                <tr>
                                    <td>Crianças: {{$frequencia->crianca}}</td>
                                    <td>Jovens: {{$frequencia->jovem}}</td>
                                    <td>Adultos: {{$frequencia->adulto}}</td>
                                    <td>Idosos: {{$frequencia->idoso}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        Total: {{$frequencia->total}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Observação: {{$frequencia->observacao}}</td>
                                </tr>
                                @endforeach
                                </tr>
                                @else
                                    <tr>
                                        <th colspan="2" class="text-center">Não há frequência cadastradas</th>
                                    </tr>
                                @endif
                        </tbody>
                            <tfooter>
                                <tr>
                                </tr>
                            </tfooter>
                    </table>
                </div>
                        <div class="form-group col-md-offset-4 col-md-4">
                            <a href="{{route('frequencia.relatorio')}}" class="form-control btn btn-warning">
                                Retornar à Lista de Equipamentos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('scripts_adicionais')
    @include('scripts.tabelas_admin')
@endsection