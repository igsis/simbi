@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Ocorrências de Eventos')

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
                Ocorrências de Eventos
                <small>{{ $equipamento->nome }}</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Ocorrências</h3>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <div class="btn-tabela">
                            <a href="{{ route('eventos.cadastro', $equipamento->igsis_id) }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Adicionar Evento</a>
                            <a href="{{ route('eventos.listar', $equipamento->igsis_id) }}" class="btn btn-success"><i class="glyphicon glyphicon-list"></i> Listar Eventos</a>
                        </div>
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="50%">Eventos</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Operações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($eventos as $evento)
                                <input type="hidden" value="{{ $igsis_id = $evento->igsis_id }}">
                                @if(!(in_array($evento->id, $frequenciasCadastradas)))
                                    <tr>
                                        <td>{{ $evento->nome_evento }}</td>
                                        <td>{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                                        <td>{{ date('H:i', strtotime($evento->horario)) }}</td>
                                        <td>
                                            <a href="{{ route('frequencia.editarOcorrencia', $evento->id) }}" class="btn btn-info" style="margin-right: 3px"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                            <button onclick="preencherCampos('{{ $evento->nome_evento }}','{{$evento->projetoEspecial->projetoEspecial}}', '{{ $evento->projetoEspecial->idProjetoEspecial }}','{{ $evento->id }}')" class="btn btn-success" data-toggle="modal" data-target="#cadastroFrequencia" style="margin-right: 3px"><i class="glyphicon glyphicon-plus-sign"></i> Frequência</button>
                                            @hasrole('Administrador')
                                            <form method="POST" action="{{ route('evento.ocorrencia.destroy', $evento->id) }}" style="display: inline;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Remover {{$evento->nome_evento}}?" data-message='Desejar realmente remover esta ocorrência?' data-footer="Remover"><i class="glyphicon glyphicon-trash"></i> Remover
                                                </button>
                                            </form>
                                            @endhasrole
                                        </td>
                                    </tr>
                                @else
                                    <tr class="bg-success">
                                        <td class="bg-success">{{ $evento->nome_evento }}</td>
                                        <td class="bg-success">{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                                        <td class="bg-success">{{ date('H:i', strtotime($evento->horario)) }}</td>
                                        <td class="bg-success">
                                            <a href="{{ route('frequencia.editarOcorrencia', $evento->id) }}" class="btn btn-info" style="margin-right: 3px"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                            <a href="{{ route('frequencia.editar', $frequenciasCadastradas) }}" class="btn btn-success" role="button" aria-disabled="true" style="margin-right: 3px"><i class="glyphicon glyphicon-plus-sign"></i> Editar Frequencia</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @include('layouts.excluir_confirm')
                            </tbody>
                            <tfooter>
                                <thead>
                                <tr>
                                    <th width="50%">Eventos</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Operações</th>
                                </tr>
                                </thead>
                            </tfooter>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cadastroFrequencia" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nome do evento</h4>
                </div>
                <!-- inicio do form -->
                <form method="POST" action="{{route('frequencia.gravar', $equipamento->id)}}" id="form-modal">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="hidden">
                            <div class="form-group">
                                <label for="evento_ocorrencia_id">Id da ocorrencia</label>
                                <input class="form-control" type="text" id="evento_ocorrencia_id" name="evento_ocorrencia_id" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tipoEvento">Categoria do Evento</label>
                            <input type="text" readonly class="form-control" id="nomeEvento" value="">
                        </div>

                        <div class="form-group">
                            <label for="tipoEvento">Projeto Especial</label>
                            <input type="text" readonly class="form-control" id="nomeProjeto" value="">
                            <input type="hidden" name="idProjetoEspecial" id="idProjeto" value="">
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="email">Criança</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="crianca" name="crianca" value="{{old('crianca')}}" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="jovem">Jovem</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="jovem" name="jovem" value="{{old('jovem')}}" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="adulto">Adulto</label>
                                    <input class="form-control" type="number" id="adulto" min="0" max="9999" name="adulto" value="{{old('adulto')}}" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="idoso">Idoso</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="idoso" name="idoso" value="{{old('idoso')}}" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="publicoTotal">Publico Total: </label>
                            <input type="text" class="form-control" readonly min="0" max="9999" name="total" id="publicoTotal" onload="calcular()">
                        </div>

                        <div class="form-group ">
                            <label for="observacao">Observação</label>
                            <input class="form-control" type="text" name="observacao" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-sub" form="form-modal" class="btn btn-success" data-dismiss="modal">Cadastrar</button>
                        <!-- fim do form -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

        $('#confirmDelete').on('show.bs.modal', function (e)
        {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $message = $(e.relatedTarget).attr('data-footer');
            $(this).find('.modal-footer #confirm ').text($message);

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });

        // Form confirm (yes/ok) handler, submits form
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function()
        {
            $(this).data('form').submit();
        });

    </script>

    <script type="text/javascript">
        function calcular() {
            let crianca = parseInt(document.getElementById('crianca').value, 10);
            let jovem = parseInt(document.getElementById('jovem').value, 10);
            let adulto = parseInt(document.getElementById('adulto').value, 10);
            let idoso = parseInt(document.getElementById('idoso').value, 10);

            crianca = isNaN(crianca) ? 0 : crianca;
            jovem = isNaN(jovem) ? 0 : jovem;
            adulto = isNaN(adulto) ? 0 : adulto;
            idoso = isNaN(idoso) ? 0 : idoso;

            let calcula = crianca + jovem + adulto + idoso;
            let publico = document.getElementById("publicoTotal");

            publico.value = String(calcula);
        }

        window.onload = calcular();

    </script>

    <script>
        function preencherCampos(nomeEvento,nomeProjeto,idProjeto,idocorrencia) {

            document.querySelector('#nomeEvento').value = nomeEvento;
            document.querySelector('#nomeProjeto').value = nomeProjeto;
            document.querySelector('#idProjeto').value = idProjeto;
            document.querySelector('#evento_ocorrencia_id').value = idocorrencia;

        }

        let sub = document.querySelector('#btn-sub');

        sub.onclick = function () {
            document.querySelector('#form-modal').submit();
        }


    </script>

    @include('scripts.tabelas_admin')

@endsection