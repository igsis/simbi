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

        #enviado {
            background-color: rgba(186, 255, 207, .2);
        }


    </style>
@endsection

@section('titulo','Ocorrências de Eventos')

@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div id="mensagem" class="col-xs-12">
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
                            <a href="{{ route('eventos.listar', $equipamento->id) }}" class="btn btn-success"><i
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
                            @if($eventos->count() > 0)
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
                                                <button onclick='preencherCampos("{{ $evento->nome_evento }}","{{$evento->projetoEspecial->projeto_especial}}", "{{ $evento->projetoEspecial->id }}","{{ $evento->id }}")'
                                                        class="btn btn-success"
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
                                                <button onclick='editarFrequencia("{{$evento->projetoEspecial->projetoEspecial}}","{{ $evento->id }}")'
                                                        class="btn btn-success" role="button" id="btnEdita"
                                                        aria-disabled="true"
                                                        style="margin-right: 3px"><i
                                                            class="glyphicon glyphicon-plus-sign"></i>
                                                    Editar Frequencia
                                                </button>
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
                            @else
                                <tr>
                                    <th colspan="4" class="text-center">Não há eventos cadastrados</th>
                                </tr>
                            @endif

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

    <!-- Modal confirmação para deletar -->
    <div class="modal fade" id="modalDeletar" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Excluir ocorrência</h4>
                </div>
                <form action="{{route('evento.ocorrencia.destroy')}}" id="deletarOcorrencia" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
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
                    <h4 class="modal-title">Enviar Frequencia</h4>
                </div>
                <form action="{{route('frequencia.enviarFrequencia')}}" method="post">
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

    <div class="modal fade" id="dlgFrequencia" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nome do evento</h4>
                </div>
                <!-- inicio do form -->
                <form id="formFrequencia" name="formulario">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="hidden">
                            <div class="form-group">
                                <input type="text" id="id">
                                <label for="evento_ocorrencia_id">Id da ocorrencia</label>
                                <input class="form-control" type="text" id="eventoOcorrenciaId"
                                       name="evento_ocorrencia_id">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tipoEvento">Nome do Evento</label>
                            <input type="text" readonly class="form-control" id="nome_evento">
                        </div>

                        <div class="form-group">
                            <label for="tipoEvento">Projeto Especial</label>
                            <input type="text" readonly class="form-control" id="nome_Projeto" value="">
                            <input type="hidden" name="idProjetoEspecial" id="id_Projeto" value="">
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="crianca">Criança</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="qtdCrianca"
                                           name="crianca" value="{{old('crianca')}}" onkeyup="calcular()"
                                           onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="jovem">Jovem</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="qtdJovem"
                                           name="jovem"
                                           value="{{old('jovem')}}" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="adulto">Adulto</label>
                                    <input class="form-control" type="number" id="qtdAdulto" min="0" max="9999"
                                           name="adulto" value="{{old('adulto')}}" onkeyup="calcular()"
                                           onkeyup="calcular()">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group ">
                                    <label for="idoso">Idoso</label>
                                    <input class="form-control" type="number" min="0" max="9999" id="qtdIdoso"
                                           name="idoso"
                                           value="{{old('idoso')}}" onblur="calcular()" onkeyup="calcular()">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="publicoTotal">Publico Total: </label>
                            <input type="text" class="form-control" readonly min="0" max="9999" name="total"
                                   id="qtdPublicoTotal" onload="calcular()">
                        </div>

                        <div class="form-group ">
                            <label for="observacao">Observação</label>
                            <input class="form-control" type="text" id="observacaoFrequencia" name="observacao" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>
                <!-- fim do frm -->
            </div>
        </div>
    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CRSF-TOKEN': '{{ csrf_token() }}'
            }
        });

        function limparCampos() {
            $('#id').val('')
            $('#eventoOcorrenciaId').val('')
            $('#nome_evento').val('')
            $('#id_Projeto').val('')
            $('#qtdCrianca').val(0)
            $('#qtdJovem').val(0)
            $('#qtdAdulto').val(0)
            $('#qtdIdoso').val(0)
            $('#qtdPublicoTotal').val(0)
            $('#observacaoFrequencia').val('')
        }

        function editarFrequencia(projetoEspecial, id) {
            limparCampos();
            let formulario = document.querySelector('#formFrequencia');
            formulario.removeAttribute('method');
            formulario.action = ''
            //editar isso depois quando subir para o servidor
            $.getJSON('/simbi/api/editarFrequencia/' + id, function (data) {
                $('#eventoOcorrenciaId').val(data[0].evento_ocorrencia_id);
                $('#nome_evento').val(data[2].nome_evento);
                $('#nome_Projeto').val(projetoEspecial);
                $('#id_Projeto').val(data[2].projeto_especial_id);
                $('#qtdCrianca').val(data[0].crianca)
                $('#qtdJovem').val(data[0].jovem)
                $('#qtdAdulto').val(data[0].adulto)
                $('#qtdIdoso').val(data[0].idoso)
                $('#observacaoFrequencia').val(data[0].observacao)
                $('#qtdPublicoTotal').val(data[0].total)
                $('#id').val(data[0].id)
                $('#dlgFrequencia').modal('show');
            });
        }

        function salvarFrequencia() {
            let freq = {
                id: $('#id').val(),
                crianca: $('#qtdCrianca').val(),
                jovem: $('#qtdJovem').val(),
                adulto: $('#qtdAdulto').val(),
                idoso: $('#qtdIdoso').val(),
                total: $('#qtdPublicoTotal').val(),
                observacao: $('#observacao').val()
            }

            $.ajax({
                type: "POST",
                url: '/simbi/api/salvarFrequencia/' + freq.id,
                context: this,
                data: freq,
                success: function (data) {
                    console.log('Salvo OK');
                    $('#mensagem').append('<div class="row" align="center">\n' +
                        '        <div class="col-md-12">\n' +
                        '            <div class="box box-success box-solid">\n' +
                        '                <div class="box-header with-border">\n' +
                        '                    <h3 class="box-title">Ocorrencia atualizada com Sucesso</h3>\n' +
                        '                    <div class="box-tools pull-right">\n' +
                        '                        <button type="button" class="btn btn-box-tool" data-widget="remove">\n' +
                        '                            <i class="fa fa-times"></i>\n' +
                        '                        </button>\n' +
                        '                    </div>\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '    </div>')

                },
                error: function (error) {
                    console.log(error)
                }
            })

        }

        $('#formFrequencia').submit(function (event) {
            event.preventDefault();
            if ($('#id').val() != '') {
                salvarFrequencia()
                $('#dlgFrequencia').modal('hide')
            } else {
                let formulario = document.querySelector('#formFrequencia');
                formulario.submit()
            }
        });


        $('#enviarFrequencia').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $message = $(e.relatedTarget).attr('data-footer');
            $(this).find('.modal-footer #confirm ').text($message);

        });

        $('#confirmDelete').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $message = $(e.relatedTarget).attr('data-footer');
            $(this).find('.modal-footer #confirm ').text($message);
        });

        $('#confirmDelete').find('.modal-footer #confirm').on('click', function () {
            $('#modalDeletar').modal('show');
           // $(this).data('form').submit();
        });

        function preencherId(id) {
            document.getElementById('EventoOcorrenciaId').value = id;
            document.getElementById('idOcorrencia').value = id;
        }


        function calcular() {
            let crianca = parseInt(document.getElementById('qtdCrianca').value, 10);
            let jovem = parseInt(document.getElementById('qtdJovem').value, 10);
            let adulto = parseInt(document.getElementById('qtdAdulto').value, 10);
            let idoso = parseInt(document.getElementById('qtdIdoso').value, 10);

            crianca = isNaN(crianca) ? 0 : crianca;
            jovem = isNaN(jovem) ? 0 : jovem;
            adulto = isNaN(adulto) ? 0 : adulto;
            idoso = isNaN(idoso) ? 0 : idoso;

            let calcula = crianca + jovem + adulto + idoso;
            let publico = document.getElementById("qtdPublicoTotal");

            publico.value = String(calcula);
        }

        window.onload = calcular();

        function preencherCampos(nomeEvento, nomeProjeto, idProjeto, idocorrencia) {
            limparCampos();
            let formulario = document.querySelector('#formFrequencia');
            formulario.action = '{{route('frequencia.gravar',$equipamento->id)}}';
            formulario.setAttribute('method', 'POST')
            document.querySelector('#nome_evento').value = nomeEvento;
            document.querySelector('#nome_Projeto').value = nomeProjeto;
            document.querySelector('#id_Projeto').value = idProjeto;
            document.querySelector('#eventoOcorrenciaId').value = idocorrencia;
            document.querySelector('.modal-title').innerHTML = nomeEvento;

            $('#dlgFrequencia').modal('show');

        }

        let sub = document.querySelector('#btn-sub');

        sub.onclick = function () {
            document.querySelector('#form-modal').submit();
        }


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
            }
        });

    </script>
    @include('scripts.tabelas_admin')

@endsection