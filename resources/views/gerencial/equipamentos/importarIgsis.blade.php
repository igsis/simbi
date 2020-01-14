@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Importar Equipamentos Siscontrat')

@section('conteudo')

    <!-- Novo codigo -->

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
                Importar Equipamentos Siscontrat
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pesquisa de Equipamentos</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="50%">Nome do Equipamento</th>
                                <th>Operação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($equipamentos as $equipamento)
                                @if (!(in_array($equipamento->id, $cadastrados)))
                                    <tr>
                                        <td>{{$equipamento->local}}</td>
                                        <td>
                                            @hasrole('Administrador')
                                            <a href="{{ route('equipamentos.cadastro,importe', $equipamento->id) }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Importar Equipamento</a>
                                            @endhasrole
                                        </td>
                                    </tr>
                                @else
                                    <tr class="bg-success">
                                        <td class="bg-success">{{$equipamento->local}} </td>
                                        <td class="bg-success">
                                            @hasrole('Administrador')
                                            <a href="{{ route('equipamentos.index', ['type'=>1]) }}" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i> Lista de Equipamentos</a>
                                            @endhasrole
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @include('layouts.excluir_confirm')
                            </tbody>
                            <tfoot>
                            <tr>
                                <th width="50%">Nome do Equipamento</th>
                                <th>Operação</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Fim Novo codigo -->

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

    </script>

    @includeIf('scripts.tabelas_admin')
@endsection