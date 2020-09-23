@extends('layouts.master2')

@section('titulo','Editar Evento')

@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header"><i class="glyphicon glyphicon-flag"></i> Editar Evento <br></h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <form method="POST" action="{{route('eventos.update', [$equipamento->id, $eventos->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="form-group">
                                <label for="evento_ocorrencia_id">Nome do Evento</label>
                                <input class="form-control" type="text" id="nome" name="nome" value="{{$eventos->nome_evento}}">
                            </div>
                        </div>

                        <div class="row">
                            <div id="divTipoEvento" class="form-group col-md-5 col-sm-10">
                                <div class="form-group ">
                                    <label for="email">Tipo Evento</label>
                                    <select name="tipoEvento" id="tipoEvento" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($tipoEvento as $evento)
                                            @if ($evento->id == old('tipoEvento') || $evento->id == $eventos->tipo_evento_id)
                                                <option value="{{ $evento->id }}" selected>{{ $evento->tipo_evento }}</option>
                                            @else
                                                <option value="{{ $evento->id }}">{{ $evento->tipo_evento }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-xs-2 col-md-1 col-sm-2">
                                <label for="">&emsp;</label>
                                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addTipoEvento">
                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"/>
                                </button>
                            </div>
                            <div id="divProjEspecial" class="form-group col-md-5 col-sm-10">
                                <div class="form-group ">
                                    <label for="jovem">Projeto Especial</label>
                                    <select name="projetoEspecial" id="projetoEspecial" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($projetoEspecial as $projeto)
                                            @if($projeto->id == old('projetoEspecial') || $eventos->projeto_especial_id == $projeto->id))
                                                <option value=" {{ $projeto->id }} " selected    >{{ $projeto->projeto_especial }}</option>
                                            @else
                                                <option value=" {{ $projeto->id }}">{{ $projeto->projeto_especial }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-xs-2 col-md-1 col-sm-2">
                                <label for="">&emsp;</label>
                                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addProjEspecial">
                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"/>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="form-group ">
                                    <label for="adulto">Forma de Contratação</label>
                                    <select name="contratacao" id="contratacao" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($contratacao as $contrata)
                                            @if ($contrata->id == old('contratacao') || $eventos->contratacao_forma_id == $contrata->id)
                                                <option value="{{$contrata->id}}" selected>{{$contrata->forma_contratacao}}</option>
                                            @else
                                                <option value="{{$contrata->id}}">{{$contrata->forma_contratacao}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="form-group ">
                                    <label>Área do Evento</label>
                                    <select name="areaEvento" id="areaEvento" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($areaEvento as $area)
                                            @if ($area->id == old('areaEvento') || $eventos->area_evento_id == $area->id)
                                                <option value="{{ $area->id }}" selected>{{ $area->area }}</option>
                                            @else
                                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success"> Editar</button>
                    </form>
                </div>
            </div>

        </section>
    </div>
    @include('layouts.funcionario_modal', ['idModal' => 'addTipoEvento', 'titulo' => 'Adicionar novo Tipo de Evento', 'actionForm' => 'createTipoEvento', 'nameModal' => 'tipo_evento', 'equipamentoId' => '0', 'idInput' => 'novoTipoEvento', 'funcaoJS' => 'insertTipoEvento'])
    @include('layouts.funcionario_modal', ['idModal' => 'addProjEspecial', 'titulo' => 'Adicionar novo Projeto Especial', 'actionForm' => 'createProjetoEspecial', 'nameModal' => 'projeto_especial', 'equipamentoId' => '0', 'idInput' => 'novoProjetoEspecial', 'funcaoJS' => 'insertProjEspecial'])

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
        function insertTipoEvento()
        {
            let select = document.getElementById("tipoEvento"),
                div = document.getElementById("divTipoEvento"),
                i = {{$tipoEvento->count()}},
                txtVal = document.getElementById("novoTipoEvento").value,
                newOption = document.createElement("OPTION"),
                newInput = document.createElement("INPUT"),
                newOptionVal = document.createTextNode(txtVal);

            if (txtVal !== "")
            {
                newOption.appendChild(newOptionVal);
                newOption.setAttribute("value", `${i + 1}`);
                select.insertBefore(newOption, select.lastChild);
                newOption.setAttribute('selected', 'selected');

                newInput.setAttribute("type", "hidden");
                newInput.setAttribute("name", "novoTipoEvento");
                newInput.setAttribute("value", newOptionVal.textContent);
                div.insertBefore(newInput, div.lastChild);
            }
            $('#addTipoEvento').modal('hide');
            $("input[id='novoTipoEvento']").val('');
        }
        function insertProjEspecial()
        {
            let select = document.getElementById("projetoEspecial"),
                div = document.getElementById("divProjEspecial"),
                i = {{$tipoEvento->count()}},
                txtVal = document.getElementById("novoProjEspecial").value,
                newOption = document.createElement("OPTION"),
                newInput = document.createElement("INPUT"),
                newOptionVal = document.createTextNode(txtVal);

            if (txtVal !== "")
            {
                newOption.appendChild(newOptionVal);
                newOption.setAttribute("value", `${i + 1}`);
                select.insertBefore(newOption, select.lastChild);
                newOption.setAttribute('selected', 'selected');

                newInput.setAttribute("type", "hidden");
                newInput.setAttribute("name", "novoProjEspecial");
                newInput.setAttribute("value", newOptionVal.textContent);
                div.insertBefore(newInput, div.lastChild);
            }
            $('#addProjEspecial').modal('hide');
            $("input[id='novoProjEspecial']").val('');
        }

    </script>
@endsection
