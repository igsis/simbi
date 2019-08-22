@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
    <style>
        .expirado {
            color: red;
        }

        .quaseExpirado {
            color: darkorange;
        }

        .evento td:first-child {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bolder;
            margin: 0;
        }

        .evento td:nth-child(4) {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-direction: row;
        }

        #enviado{
            background-color: rgba(186,255,207,.2);
        }


    </style>
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
                            <a href="{{ route('eventos.listar', $equipamento->igsis_id) }}" class="btn btn-success"><i
                                        class="glyphicon glyphicon-plus"></i> Adicionar Ocorrências</a>
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
                                    <tr class="evento">
                                        <td>{{ $evento->nome_evento }}</td>
                                        <td class="dataFrequencia">{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                                        <td>{{ date('H:i', strtotime($evento->horario)) }}</td>
                                        <td>
                                            <a href="{{ route('frequencia.editarOcorrencia', $evento->id) }}"
                                               class="btn btn-info desabilitar" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-edit"></i> Editar</a>
                                            <button onclick="preencherCampos('{{ $evento->nome_evento }}','{{$evento->projetoEspecial->projetoEspecial}}', '{{ $evento->projetoEspecial->idProjetoEspecial }}','{{ $evento->id }}')"
                                                    class="btn btn-success" data-title="{{$evento->nome_evento}}"
                                                    data-toggle="modal" data-target="#cadastroFrequencia"
                                                    style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-plus-sign"></i> Frequência
                                            </button>
                                            @hasrole('Administrador')
                                            <button class="btn btn-danger desabilitar" type="button"
                                                    data-toggle="modal"
                                                    data-target="#confirmDelete"
                                                    data-title="Cancelar {{$evento->nome_evento}}?"
                                                    data-message='Desejar realmente cancelar esta ocorrência?'
                                                    data-footer="Confirmar"
                                                    onclick="preencherId('{{$evento->id}}')"><i
                                                        class="glyphicon glyphicon-trash"></i> Cancelar
                                            </button>
                                            @endhasrole
                                        </td>
                                    </tr>
                                @else
                                    <tr class="evento" id="enviado">
                                        <td>{{ $evento->nome_evento }} <span
                                                    class="text-center text-red text-bold expirado"></span></td>
                                        <td class="dataFrequencia">{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                                        <td>{{ date('H:i', strtotime($evento->horario)) }}</td>
                                        <td id="tdEditar">
                                            <a href="{{ route('frequencia.editarOcorrencia', $evento->id) }}"
                                               class="btn btn-info desabilitar" style="margin-right: 3px" id="btnEdita"><i
                                                        class="glyphicon glyphicon-edit"></i> Editar</a>
                                            <a href="{{ route('frequencia.editar', $frequenciasCadastradas) }}"
                                               class="btn btn-success" role="button" id="btnEdita" aria-disabled="true"
                                               style="margin-right: 3px"><i class="glyphicon glyphicon-plus-sign"></i>
                                                Editar Frequencia</a>
                                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                                    data-target="#enviarFrequencia"
                                                    data-title="{{$evento->nome_evento}}"
                                                    data-message='Desejar realmente enviar?' data-footer="Enviar"
                                                    onclick="preencherId('{{$evento->id}}')"
                                                    onclick="preencherId('{{$evento->id}}')"><i
                                                        class="glyphicon glyphicon-send"></i>&nbsp Enviar
                                            </button>
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
                                <input class="form-control" type="text" id="evento_ocorrencia_id"
                                       name="evento_ocorrencia_id" value="">
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
                                    <label for="crianca">Criança</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="crianca"
                                           name="crianca" value="{{old('crianca')}}" onblur="calcular()"
                                           onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="jovem">Jovem</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="jovem" name="jovem"
                                           value="{{old('jovem')}}" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="adulto">Adulto</label>
                                    <input class="form-control" type="number" id="adulto" min="0" max="9999"
                                           name="adulto" value="{{old('adulto')}}" onblur="calcular()"
                                           onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="idoso">Idoso</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="idoso" name="idoso"
                                           value="{{old('idoso')}}" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="publicoTotal">Publico Total: </label>
                            <input type="text" class="form-control" readonly min="0" max="9999" name="total"
                                   id="publicoTotal" onload="calcular()">
                        </div>

                        <div class="form-group ">
                            <label for="observacao">Observação</label>
                            <input class="form-control" type="text" name="observacao" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-sub" form="form-modal" class="btn btn-success"
                                data-dismiss="modal">Cadastrar
                        </button>
                        <!-- fim do form -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Excluir?</h4>
                </div>
                <form action="{{route('evento.ocorrencia.destroy')}}" id="deletarOcorrencia" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p>Confirma?</p>
                        <div class="form-group">
                            <label for="observacao">Motivo do Cancelamento</label>
                            <input type="text" id="observacao" class="form-control" name="observacao">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="EventoOcorrenciaId">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
                        <button type="submit" class="btn btn-danger" id="confirm">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="enviarFrequencia" role="dialog" aria-labelledby="confirmEnvio" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Excluir?</h4>
                </div>
                <form action="{{route('frequencia.enviarFrequencia')}}" id="deletarOcorrencia" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>Confirma?</p>
                    </div>
                    <input type="hidden" name="equipamento_igsis" value="{{$igsis_id}}">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="idOcorrencia">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success" id="confirm">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

        $('#enviarFrequencia').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $message = $(e.relatedTarget).attr('data-footer');
            $(this).find('.modal-footer #confirm ').text($message);

            // Pass form reference to modal for submission on yes/ok
            //  var form = $(e.relatedTarget).closest('form');
            //  $(this).find('.modal-footer #confirm').data('form', form);
        });

        $('#confirmDelete').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $message = $(e.relatedTarget).attr('data-footer');
            $(this).find('.modal-footer #confirm ').text($message);

            // Pass form reference to modal for submission on yes/ok
            //  var form = $(e.relatedTarget).closest('form');
            //  $(this).find('.modal-footer #confirm').data('form', form);
        });

        // Form confirm (yes/ok) handler, submits form
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function () {
            $(this).data('form').submit();
        });

        function preencherId(id) {
            document.getElementById('EventoOcorrenciaId').value = id;
            document.getElementById('idOcorrencia').value = id;
        }

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
        function preencherCampos(nomeEvento, nomeProjeto, idProjeto, idocorrencia) {

            document.querySelector('#nomeEvento').value = nomeEvento;
            document.querySelector('#nomeProjeto').value = nomeProjeto;
            document.querySelector('#idProjeto').value = idProjeto;
            document.querySelector('#evento_ocorrencia_id').value = idocorrencia;
            document.querySelector('.modal-title').innerHTML = nomeEvento;

        }

        let sub = document.querySelector('#btn-sub');

        sub.onclick = function () {
            document.querySelector('#form-modal').submit();
        }


    </script>

    <script>

        $(document).ready(function () {

            let linhaTb = document.querySelectorAll('.evento');

            let dataHoje = new Date();
            let dia = dataHoje.getDate().toString();
            let mes = (dataHoje.getMonth() + 1).toString();
            let ano = dataHoje.getFullYear().toString();

            if (dia.length == 1) dia = "0" + dia;
            if (mes.length == 1) mes = "0" + mes;

            for (let linha of linhaTb) {

                let dataFreq = $(linha).children('.dataFrequencia').text();
                let data = dataFreq.split('/');

                if (data[1] == 12) {
                    if (ano < data[2] && dia <= 10) {
                        $(linha).children('td:first-child').append('<span class="quaseExpirado">Data quase expirando</span>');
                    } else if (ano > data[2] && dia >= 10) {
                        $(linha).children('td:first-child').append('<span class="expirado">Data Expirada (Envie a ocorrência)</span>').css('margin-right: 15px');
                        let btn = $(linha).find('.desabilitar');
                        btn.attr('disabled', true);
                    }
                } else if (data[1] < mes) {
                    if (data[1] == parseInt(mes) - 1) {
                        if (dia <= 10) {
                            $(linha).children('td:first-child').append('<span class="quaseExpirado">Data quase expirando</span>');
                        } else {
                            $(linha).children('td:first-child').append('<span class="expirado">Data Expirada (Envie a ocorrência)</span>').css('margin-right: 15px');
                            let btn = $(linha).find('.desabilitar');
                            btn.attr('disabled', true);
                        }
                    } else {
                        $(linha).children('td:first-child').append('<span class="expirado">Data Expirada (Envie a ocorrência)</span>').css('margin-right: 15px');
                        let btn = $(linha).find('.desabilitar');
                        let ancora = $(linha).find('a');
                        ancora.removeAttr('href', '');
                        btn.attr('disabled', true);
                        $(linha).children('td').removeClass('bg-success');
                    }
                }
                //  else {
                //     $(linha).children('td:first-child').append('<span class="expirado">Data Expirada (Envie a ocorrência)</span>').css('margin-right: 15px');
                //     $(linha).children('td').removeClass('bg-success');
                //     $(linha).removeClass('bg-success').addClass('bg-danger');
                //
                // }
            }
        });

    </script>
    {{--findIndex(checkAdult)--}}
    @include('scripts.tabelas_admin')

@endsection