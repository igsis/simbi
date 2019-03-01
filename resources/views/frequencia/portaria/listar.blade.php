@include('layouts.br')
@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Público Atendido')


@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header">Público Atendido</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de publico atendido</h3>
                </div>
                <div class="box-body">
                    <table id="tabela1" class="table table-bordered table-striped">
                        <tbody>
                        @if ($equipamento->frequenciasPortarias->count() != 0)
                            <tr>
                                <th colspan="4" class="text-center">Portaria</th>
                            </tr>
                            <tr>
                            @foreach ($equipamento->frequenciasPortarias as $frequencia)
                                <tr>
                                    <th>Data: {{ date('d/m/Y', strtotime($frequencia->data)) }}</th>
                                    <th>{{ ucwords(strftime('%A', strtotime($frequencia->data))) }}</th>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong>Nome: </strong>{{$frequencia->nome}}</td>
                                </tr>
                                @endforeach
                                </tr>
                                @else
                                    <tr>
                                        <th colspan="2" class="text-center">Não há frequência cadastradas</th>
                                    </tr>
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">

                </div>
                <div class="panel-body">

                </div>
            </div>
            <div class="form-group col-md-offset-4 col-md-4">
                <a href="{{route('frequencia.relatorio')}}" class="form-control btn btn-warning">
                    Retornar à Lista de Equipamentos
                </a>
            </div>
        </div>
@endsection

@section('scripts_adicionais')

    @include('scripts.tabelas_admin')

@endsection