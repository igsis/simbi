@extends('layouts.master')

@section('conteudo')

    <h1><i class="glyphicon glyphicon-home"></i>
        Importar Equipamentos IGSIS
    </h1>
    <div class="panel-heading">Pagina {{$equipamentos->currentPage()}} de {{$equipamentos->lastPage()}}</div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="50%">Nome do Equipamento</th>
                <th>Operação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($equipamentos as $equipamento)
                    <tr>
                        <td>{{$equipamento->sala}}</td>
                        <td>
                            @hasrole('Administrador')
                                <a href="{{ route('equipamentos.cadastro,importe', $equipamento->idLocal) }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Importar Equipamento</a>
                            @endhasrole
                        </td>
                    </tr>
            @endforeach
            @include('layouts.excluir_confirm')
            </tbody>
        </table>
    </div>
    <div class="text-center">
        @if(isset($dataForm))
            {!! $equipamentos->appends($dataForm)->links() !!}
        @else
            {!! $equipamentos->links() !!}
        @endif

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

    </script>

@endsection