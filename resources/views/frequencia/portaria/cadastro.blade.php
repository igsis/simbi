@extends('layouts.master2')


@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> Público Atendido</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        {{$equipamento->nome}}
                    </h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{route('frequencia.portaria.gravar', $equipamento->id)}}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="form-group">
                                <label for="nome">Nome/Nome Social</label>
                                <input type="text" class="form-control" class="form-control" id="nome" name="nome" value="{{ old('nome') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input class="form-control" type="date" name="data">
                            </div>
                        </div>

                        <input class="btn btn-success" type="submit" value="Cadastrar">
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

    </script>

@endsection
