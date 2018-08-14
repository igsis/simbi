@extends('layouts.master')

@section('conteudo')
    <div class="container-fluid">
        <h1><i class='glyphicon glyphicon-cog'></i> Cargos </h1>
        <hr>
        {{-- <div class="panel-heading">Página {{ $cargos->currentPage() }} de {{ $cargos->lastPage() }}</div> --}}

        <div class="form">
            <form method="POST" class="form form-inline" action="{{route('searchCargo')}}">
                {{ csrf_field() }}
                <input type="text" name="cargo" class="form-control" placeholder="Cargo" title="Pesquisa pela Descrição">
                <select name="publicado" class="form-control">
                    <option value="1">Selecione</option>
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
                    <th width="50%">Cargo</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cargos as $cargo)
                    <tr>
                        <td>{{$cargo->cargo}}</td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#cargo"
                                    data-id="{{$cargo->id}}"
                                    data-cargo="{{$cargo->cargo}}">
                                <i class="glyphicon glyphicon-pencil"> </i> Editar
                            </button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#desativar"
                                    data-id="{{$cargo->id}}"
                                    data-title="{{$cargo->cargo}}"
                                    data-route="{{route('deleteCargo', '')}}">
                                <i class="glyphicon glyphicon-remove"> </i> Excluir
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <button class="btn btn-success" data-toggle="modal" data-target="#cargo"><i class="glyphicon glyphicon-plus"></i></button>

        <!-- Editar Cargo -->
        <div class="modal fade" id="cargo" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST"> {{-- action Pelo js --}}
                            {{ csrf_field() }}
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-success" name="novoCargo" value="">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layouts.desativar')
    </div>
    <div class="text-center">
        @if(isset($dataForm))
            {!! $cargos->appends($dataForm)->links() !!}
        @else
            {!! $cargos->links() !!}
        @endif
    </div>

@endsection
@section('scripts_adicionais')
    <script type="text/javascript">

        // Alimenta o modal com informações de cada Tipo de Serviço
        $('#cargo').on('show.bs.modal', function (e)
        {
            if ($(e.relatedTarget).attr('data-id'))
            {
                let id = $(e.relatedTarget).attr('data-id');
                let cargo = $(e.relatedTarget).attr('data-cargo');
                $(this).find('.modal-title').text(` Editar ${cargo}`);
                $(this).find('.modal-footer input').attr('value', 'Editar');
                $(this).find('form input[name="cargo"]').attr('value', cargo);
                $(this).find('form').append(`<input type="hidden" name="_method" value="PUT">`)
                $(this).find('form').attr('action', `{{route('editCargo', '')}}/${id}`);
            }else
            {
                $(this).find('.modal-title').text('Adicionar Cargo');
                $(this).find('.modal-footer input').attr('value', 'Adicionar');
                $(this).find('form input[type="text"]').attr('value', '');
                $(this).find('form').attr('action', `{{route('createCargo')}}`);
            }
        });
    </script>

    @include('scripts.desativar_modal')
@endsection