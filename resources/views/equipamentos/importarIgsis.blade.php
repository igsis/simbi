@extends('layouts.master')

@section('tituloPagina')
    <i class="glyphicon glyphicon-home"></i>
    Importar Equipamentos IGSIS
@endsection

@section('conteudo')

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
                @if (!(in_array($equipamento->idLocal, $cadastrados)))
                    <tr>
                        <td>{{$equipamento->sala}}</td>
                        <td>
                            @hasrole('Administrador')
                            <a href="{{ route('equipamentos.cadastro,importe', $equipamento->idLocal) }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Importar Equipamento</a>
                            @endhasrole
                        </td>
                    </tr>
                @else
                    <tr class="bg-success">
                        <td class="bg-success">{{$equipamento->sala}} </td>
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
        </table>
    </div>
    <div class="text-center">
        @if(isset($dataForm))
            {!! $equipamentos->appends($dataForm)->links() !!}
        @else
            {!! $equipamentos->links() !!}
        @endif
    </div>
@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

    </script>

@endsection