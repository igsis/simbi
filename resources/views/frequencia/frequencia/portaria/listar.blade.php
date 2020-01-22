@extends('layouts.master2')
@include('layouts.br')
@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Público de Recepção')

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
                Público de Recepção
                <small>{{ $equipamento->nome }}</small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Público de Recepção</h3>
                </div>
                <div class="box-body">
                    <table id="tabela1" class="table table-bordered table-striped">
                        <thead>
                        @if ($equipamento->frequenciasPortarias->count() != 0)
                            <tr>
                                <th>Data</th>
                                <th>Dia da Semana</th>
                                <th>Total</th>
                                <th>Data Envio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipamento->frequenciasPortarias as $frequencia)
                                <tr align="center">
                                    <td>{{ date('d/m/Y', strtotime($frequencia->data)) }}</td>
                                    <td>{{ ucwords(strftime('%A', strtotime($frequencia->data))) }}</td>
                                    <td>{{ $frequencia->quantidade }}</td>
                                    <td>{{ date('d/m/Y', strtotime($frequencia->data_envio))  }}</td>
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
@endsection

@section('scripts_adicionais')

    @include('scripts.tabelas_admin')

@endsection