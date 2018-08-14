@extends('layouts.master')

@section('conteudo')
    <div class="container-fluid">
        <h1><i class='glyphicon glyphicon-cog'></i> Distritos </h1>
        <hr>
        {{-- <div class="panel-heading">Página {{ $distritos->currentPage() }} de {{ $distritos->lastPage() }}</div> --}}

        <div class="form">
            <form method="POST" class="form form-inline" action="{{route('searchDistrito')}}">
                {{ csrf_field() }}
                <input type="text" name="descricao" class="form-control" placeholder="Descrição" title="Pesquisa pela Descrição">
                <select name="publicado" class="form-control">
                    <option value="0">Selecione</option>
                    <option value="1">Ativo</option>
                    <option value="0">Desativado</option>
                </select>
                <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            </form>
        </div><br>

        <div class="table-responsive">
            <table class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($distritos as $distrito)
                    <tr>
                        <td>{{$distrito->descricao}}</td>
                        <td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#ativar"
                                    data-id="{{$distrito->id}}"
                                    data-title="{{$distrito->descricao}}"
                                    data-route="{{route('toActivateDistrito', '')}}">
                                <i class="glyphicon glyphicon-ok"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Editar Distrito -->
        <div class="modal fade" id="distrito" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST"> {{-- action Pelo js --}}
                            {{ csrf_field() }}
                            <label>Descrição</label>
                            <input class="form-control" type="text" name="descricao">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-success" name="novoDistrito" value="">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layouts.desativar')
    </div>
    <div class="text-center">
        @if(isset($dataForm))
            {!! $distritos->appends($dataForm)->links() !!}
        @else
            {!! $distritos->links() !!}
        @endif
    </div>

@endsection
@section('scripts_adicionais')
    @include('scripts.desativar_modal')
@endsection