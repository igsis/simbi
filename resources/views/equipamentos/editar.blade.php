@extends ('layouts.master2')

@section('tituloPagina')
    Edição do Equipamento <small>{{$equipamento->nome}}</small>
@endsection

@section ('conteudo')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-header">@yield('tituloPagina')</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$equipamento->nome}}</h3>
            </div>
            <form method="POST" action="{{ url('equipamentos', [$equipamento->id]) }}">
                {{ csrf_field() }}
                <div class="box-body">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <label for="nome">Nome do Equipamento</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="{{ $equipamento->nome }}">
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-8 col-md-4">
                            <label for="tipoServico">Tipo de Serviço</label>
                            <select class="form-control" name="tipoServico" id="tipoServico">
                                <option value="">Selecione uma Opção</option>
                                @foreach ($tipoServicos as $tipoServico)
                                    <option value="{{$tipoServico->id}}">{{$tipoServico->descricao}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-xs-4 col-md-2">
                            <label for="tipoServico">Adicionar</label>
                            <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addServico"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                        </div>

                        <div class="form-group col-xs-8 col-md-4">
                            <label for="equipamentoSigla">Sigla do Equipamento</label>
                            <select class="form-control" name="equipamentoSigla" id="equipamentoSigla">
                                <option value="">Selecione uma Opção</option>
                                @foreach ($siglas as $sigla)
                                    <option value="{{$sigla->id}}" selected>{{$sigla->sigla}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-xs-4 col-md-2">
                            <label for="equipamentoSigla">Adicionar</label>
                            <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSigla"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-xs-8 col-md-4">
                            <label for="identificacaoSecretaria">Identificação da Secretaria</label>
                            <select class="form-control" name="identificacaoSecretaria" id="identificacaoSecretaria">
                                <option value="">Selecione uma Opção</option>
                                @foreach ($secretarias as $secretaria)
                                    @if ($secretaria->publicado == 1)
                                        @if ($secretaria->id == old('identificacaoSecretaria'))
                                            <option value="{{$secretaria->id}}" selected>{{$secretaria->sigla}}</option>
                                        @else
                                            <option value="{{$secretaria->id}}">{{$secretaria->sigla}}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-xs-4 col-md-2">
                            <label for="identificacaoSecretaria">Adicionar</label>
                            <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSecretaria"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                        </div>

                        <div class="form-group col-xs-8 col-md-4">
                            <label for="subordinacaoAdministrativa">Subordinação Administrativa</label>
                            <select class="form-control" name="subordinacaoAdministrativa" id="subordinacaoAdministrativa">
                                <option value="">Selecione uma Opção</option>
                                @foreach ($subordinacoesAdministrativas as $subordinacaoAdministrativa)
                                    <option value="{{$subordinacaoAdministrativa->id}}">{{$subordinacaoAdministrativa->descricao}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-xs-4 col-md-2">
                            <label for="subordinacaoAdministrativa">Adicionar</label>
                            <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSubAdmin"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                        </div>
                    </div>

                    <div class="row" >
                        <div class="form-group col-md-3" >
                            <label>Equipamento Tematico?</label><br>

                            <input type="radio" name="tematico" value="0" checked>
                            <label for=tematico style="padding:0 10px 0 5px;">Não</label>

                            <input type="radio" name="tematico" value="1">
                            <label for=tematico style="padding:0 10px 0 5px;">Sim</label>
                        </div>
                        <div class="form-group col-md-6">
                            <label for=nome_tematica>Nome da Tematica</label>
                            <input type="text" class="form-control" name="nome_tematica" id="nome_tematica" value="{{$equipamento->nome_tematica}}" disabled>
                        </div>
                        <div class="form-group col-md-3" style="padding-right: 0px">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" data-mask="(11) 0000-0000" placeholder="(11) xxxx-xxxx" value="{{ $equipamento->telefone }}">
                        </div>
                    </div>

                    <div style="text-align: center;"><h2>Endereço</h2></div>
                    <hr>

                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control" name="cep" id="cep" data-mask="00000-000" placeholder="xxxxx-xxx" value="{{ $equipamento->endereco->cep }}">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="logradouro">Logradouro</label>
                            <input type="text" class="form-control" name="logradouro" id="logradouro" value="{{$equipamento->endereco->logradouro}}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="numero">Número</label>
                            <input type="text" class="form-control" name="numero" id="numero" value="{{$equipamento->endereco->numero}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="form-control" name="complemento" id="complemento" value="{{$equipamento->endereco->complemento}}">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" name="bairro" id="bairro" value="{{$equipamento->endereco->bairro}}" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" name="cidade" id="cidade" value="{{$equipamento->endereco->cidade}}" readonly>
                        </div>

                        <div class="form-group col-md-1">
                            <label for="uf">UF</label>
                            <input type="text" class="form-control" name="uf" id="uf" value="{{$equipamento->endereco->estado}}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="macrorregiao">Macrorregião</label>
                            <select class="form-control" name="macrorregiao" id="macrorregiao">
                                <option value="">Selecione uma Opção</option>
                                @foreach ($macrorregioes as $macrorregiao)
                                    <option value="{{$macrorregiao->id}}">{{$macrorregiao->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="regiao">Região</label>
                            <select class="form-control" name="regiao" id="regiao">
                                <option value="">Selecione uma Opção</option>
                                @foreach ($regioes as $regiao)
                                    <option value="{{$regiao->id}}">{{$regiao->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="regional">Regional</label>
                            <select class="form-control" name="regional" id="regional">
                                <option value="">Selecione uma Opção</option>
                                @foreach ($regionais as $regional)
                                    <option value="{{$regional->id}}">{{$regional->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-8 col-md-4">
                            <label for="prefeituraRegional">Subprefeitura</label>
                            <select class="form-control" name="prefeituraRegional" id="prefeituraRegional">
                                <option value="">Selecione uma Opção</option>
                                @foreach($prefeituraRegionais as $prefeituraRegional)
                                    <option value="{{$prefeituraRegional->id}}">{{$prefeituraRegional->descricao}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-xs-4 col-md-2">
                            <label for="prefeituraRegional">Adicionar</label>
                            <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addPrefeituraRegional"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                        </div>


                        <div class="form-group col-xs-8 col-md-4">
                            <label for="distrito">Distrito</label>
                            <select class="form-control" name="distrito" id="distrito">
                                <option value="">Selecione uma Opção</option>
                                @foreach($distritos as $distrito)
                                    <option value="{{$distrito->id}}">{{$distrito->descricao}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-xs-4 col-md-2">
                            <label for="distrito">Adicionar</label>
                            <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addDistrito"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                        </div>
                    </div>

                    <div class="text-center" ><h2>Horário de Funcionamento</h2></div>
                    @if ($equipamento->funcionamentos->count() == false)
                        <div class="horario">
                            <div class="row">
                                <hr>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-8" style="padding-bottom: 15px">
                                        <input type="hidden" name="funcionamento[0]" value="0">
                                        <input type="checkbox" name="domingo[0]" value="1" /><label for="diasemana07" style="padding:0 10px 0 5px;"> Domingo</label>
                                        <input type="checkbox" name="segunda[0]" value="1"/><label for="diasemana01" style="padding:0 10px 0 5px;"> Segunda</label>
                                        <input type="checkbox" name="terca[0]" value="1" /><label for="diasemana02"  style="padding:0 10px 0 5px;"> Terça</label>
                                        <input type="checkbox" name="quarta[0]" value="1" /><label for="diasemana03" style="padding:0 10px 0 5px;"> Quarta</label>
                                        <input type="checkbox" name="quinta[0]" value="1" /><label for="diasemana04" style="padding:0 10px 0 5px;"> Quinta</label>
                                        <input type="checkbox" name="sexta[0]" value="1" /><label for="diasemana05" style="padding:0 10px 0 5px;"> Sexta</label>
                                        <input type="checkbox" name="sabado[0]" value="1" /><label for="diasemana06" style="padding:0 10px 0 5px;"> Sábado</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-offset-4 col-md-2">
                                    <label for="horarioAbertura">Horario de Abertura</label>
                                    <input type="text" class="form-control" name="horarioAbertura[0]" id="horarioAbertura" data-mask="00:00">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="horarioFechamento">Horario de Fechamento</label>
                                    <input type="text" class="form-control" name="horarioFechamento[0]" id="horarioFechamento" data-mask="00:00">
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($equipamento->funcionamentos()->where('publicado', '=', '1')->get() as $key => $funcionamento)
                            <div class="horario">
                                <div class="row">
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-8" style="padding-bottom: 15px">
                                            <input type="hidden" name="funcionamento[{{$key}}]" value="{{$funcionamento->id}}">
                                            <input type="checkbox" name="domingo[{{$key}}]" value="1" {{$funcionamento->domingo == 1 ? "checked" : ""}}/><label for="diasemana07" style="padding:0 10px 0 5px;"> Domingo</label>
                                            <input type="checkbox" name="segunda[{{$key}}]" value="1"{{$funcionamento->segunda == 1 ? "checked" : ""}}/><label for="diasemana01" style="padding:0 10px 0 5px;"> Segunda</label>
                                            <input type="checkbox" name="terca[{{$key}}]" value="1" {{$funcionamento->terca == 1 ? "checked" : ""}}/><label for="diasemana02"  style="padding:0 10px 0 5px;"> Terça</label>
                                            <input type="checkbox" name="quarta[{{$key}}]" value="1" {{$funcionamento->quarta == 1 ? "checked" : ""}}/><label for="diasemana03" style="padding:0 10px 0 5px;"> Quarta</label>
                                            <input type="checkbox" name="quinta[{{$key}}]" value="1" {{$funcionamento->quinta == 1 ? "checked" : ""}}/><label for="diasemana04" style="padding:0 10px 0 5px;"> Quinta</label>
                                            <input type="checkbox" name="sexta[{{$key}}]" value="1" {{$funcionamento->sexta == 1 ? "checked" : ""}}/><label for="diasemana05" style="padding:0 10px 0 5px;"> Sexta</label>
                                            <input type="checkbox" name="sabado[{{$key}}]" value="1" {{$funcionamento->sabado == 1 ? "checked" : ""}}/><label for="diasemana06" style="padding:0 10px 0 5px;"> Sábado</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-offset-4 col-md-2">
                                        <label for="horarioAbertura">Horario de Abertura</label>
                                        <input type="text" class="form-control" name="horarioAbertura[{{$key}}]" id="horarioAbertura" data-mask="00:00" value="{{$funcionamento->hora_inicial}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="horarioFechamento">Horario de Fechamento</label>
                                        <input type="text" class="form-control" name="horarioFechamento[{{$key}}]" id="horarioFechamento" data-mask="00:00" value="{{$funcionamento->hora_final}}">
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif

                    <hr class="botoes">

                    <div class="row">
                        <div class="form-group col-md-offset-2 col-md-4">
                            <a class="btn btn-info btn-block" href="#void" id="addInput">Adicionar Novo Horario</a>
                        </div>
                        <div class="form-group col-md-4">
                            <a class="btn btn-info btn-block" href="#void" id="remInput">Remover Ultimo Horario</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="telecentro">Possui Telecentro?</label>
                            <select class="form-control" name="telecentro" id="telecentro">
                                @if (old('telecentro') == "1")
                                    <option value="0">Não</option>
                                    <option value="1" selected>Sim</option>
                                @else
                                    <option value="0" selected>Não</option>
                                    <option value="1">Sim</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nucleobraile">Possui Núcleo Braile?</label>
                            <select class="form-control" name="nucleobraile" id="nucleobraile">
                                @if (old('nucleobraile') == "1")
                                    <option value="0">Não</option>
                                    <option value="1" selected>Sim</option>
                                @else
                                    <option value="0" selected>Não</option>
                                    <option value="1">Sim</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="acervoespecializado">Acervo Especializado?</label>
                            <select class="form-control" name="acervoespecializado" id="acervoespecializado">
                                @if (old('acervoespecializado') == "1")
                                    <option value="0">Não</option>
                                    <option value="1" selected>Sim</option>
                                @else
                                    <option value="0" selected>Não</option>
                                    <option value="1">Sim</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="status">Status do Equipamento</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">Selecione uma Opção</option>
                                @foreach ($status as $stats)
                                    <option value="{{$stats->id}}">{{$stats->descricao}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="observacao">Observação</label>
                            <input type="text" class="form-control" name="observacao" id="observacao" value="{{ $equipamento->observacao }}" placeholder disabled>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="ocorrencia">Adicionar Nota</label>
                            <button type="button" id="ocorrencia" class="btn btn-info btn-block" data-toggle="modal" data-id="{{$equipamento->id}}" data-target="#addOcorrencia"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                        </div>

                        <div class="form-group col-md-1 text-center">
                            <label for="ocorrencia">Total</label>
                            <p id="totalOcorrencia" class="text-info"><b></b></p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{route('equipamentos.show', $equipamento->id)}}" class="btn btn-default">
                        Retornar à Detalhes
                    </a>
                    <input type="submit" class="btn btn-primary pull-right" name="enviar" value="Atualizar">
                </div>
            </form>
        </div>
        @include('layouts.equipamento_modal')
        @include('layouts.excluir_confirm')
    </section>
</div>
@endsection
@section('scripts_adicionais')
    @include('scripts.cadastrar_ocorrencia')
    <script type="text/javascript" >
        $('#addInput').on('click', function(e) {
            let i = $('.horario').length;
            $('.horario').first().clone().find("input").attr('name', function(idx, attrVal) {
                return attrVal.replace('[0]','')+'['+i+']';
            }).removeAttr('checked').end().find("input[type=text]").val('').end().insertBefore('.botoes').end().find("input[type=hidden]").val(i+1);
        });

        $('#remInput').on('click', function(e) {
            let i = $('.horario').length;
            if (i > 1){
                $('.horario').last().remove();
            }
        });
    </script>
    <script type="text/javascript">

        $('#addServico').submit(function(e) {
            e.preventDefault();
            let novoServico = $('#addServico input[name="novoServico"]').val();
            let _token = $('#addServico input[name="_token"]').val();
            let descricao = $('#addServico input[name="descricao"]').val();
            $.ajax({
                url: '{{route('equipamentos.index')}}',
                type: 'POST',
                data: {'novoServico': '','_token': _token, 'descricao': descricao},
                success: function(data) {
                    $("#tipoServico option").remove();
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-danger");
                    $("#sucesso").addClass( "alert-success");
                    $("#sucesso em").html("Tipo de serviço inserido com sucesso!");
                    $("#tipoServico").append(`<option value=''>Selecione uma Opção</option>`);
                    $('#addServico').modal('hide');
                    $("#tipoServico").focus();
                    for(let item of data ){
                        $("#tipoServico").append(`<option value='${item.id}'>${item.descricao}<otion>`);
                    }
                },
                error: function() {
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-success");
                    $("#sucesso").addClass( "alert-danger");
                    $("#sucesso em").html(`Erro ao cadastrar Tipo de serviço! Verifique se o campo já foi cadastrado!`);
                    $('#addServico').modal('hide');
                }
            });
            return false;
        });

        $('#addSigla').submit(function(e) {
            e.preventDefault();
            let novaSigla = $('#addSigla input[name="novaSigla"]').val();
            let _token = $('#addSigla input[name="_token"]').val();
            let sigla = $('#addSigla input[name="sigla"]').val();
            let descricao = $('#addSigla input[name="descricao"]').val();
            let roteiro = $('#addSigla input[name="roteiro"]').val();
            $.ajax({
                url: '{{route('equipamentos.index')}}',
                type: 'POST',
                data: {
                    'novaSigla': '',
                    '_token': _token,
                    'sigla':sigla,
                    'descricao': descricao,
                    'roteiro': roteiro
                },
                success: function(data) {
                    $("#equipamentoSigla option").remove();
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-danger");
                    $("#sucesso").addClass( "alert-success");
                    $("#sucesso em").html("Sigla do Equipamento inserida com sucesso!");
                    $("#equipamentoSigla").append(`<option value=''>Selecione uma Opção</option>`);
                    $('#addSigla').modal('hide');
                    $("#equipamentoSigla").focus();
                    for(let item of data ){
                        $("#equipamentoSigla").append(`<option value='${item.id}' selected>${item.sigla}<option>`);
                    }
                },
                error: function() {
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-success");
                    $("#sucesso").addClass("alert-danger");
                    $("#sucesso em").html(`Erro ao cadastrar Sigla do Equipamento! Verifique se o campo já foi cadastrado!`);
                    $('#addSigla').modal('hide');
                }
            });
            return false;
        });

        $('#addSecretaria').submit(function(e) {
            e.preventDefault();
            let novaSecretaria = $("#addSecretaria input[name='novaSecretaria']").val();
            let _token = $("#addSecretaria input[name='_token']").val();
            let sigla = $("#addSecretaria input[name='sigla']").val();
            let descricao = $("#addSecretaria input[name='descricao']").val();
            $.ajax({
                url: '{{route('equipamentos.index')}}',
                type: 'POST',
                data: {'novaSecretaria': '','_token': _token, 'sigla':sigla, 'descricao': descricao},
                success: function(data) {
                    $("#identificacaoSecretaria option").remove();
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-danger");
                    $("#sucesso").addClass( "alert-success");
                    $("#sucesso em").html("Secretaria inserida com sucesso!");
                    $("#identificacaoSecretaria").append(`<option value=''>Selecione uma Opção</option>`);
                    $('#addSecretaria').modal('hide');
                    $("#identificacaoSecretaria").focus();
                    for(let item of data ){
                        $("#identificacaoSecretaria").append(`<option value='${item.id}' selected>${item.sigla}<option>`);
                    }
                },
                error: function() {
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-success");
                    $("#sucesso").addClass("alert-danger");
                    $("#sucesso em").html(`Erro ao cadastrar Secretaria! Verifique se o campo já foi cadastrado!`);
                    $('#addSecretaria').modal('hide');
                }
            });
            return false;
        });

        $('#addSubAdmin').submit(function(e) {
            e.preventDefault();
            let novaSubordinacaoAdministrativa = $("#addSubAdmin input[name='novaSubordinacaoAdministrativa']").val();
            let _token = $("#addSubAdmin input[name='_token']").val();
            let descricao = $("#addSubAdmin input[name='descricao']").val();
            $.ajax({
                url: '{{route('equipamentos.index')}}',
                type: 'POST',
                data: {'novaSubordinacaoAdministrativa': '','_token': _token, 'descricao': descricao},
                success: function(data) {
                    $("#subordinacaoAdministrativa option").remove();
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-danger");
                    $("#sucesso").addClass("alert-success");
                    $("#sucesso em").html("Subordinacao Administrativa inserida com sucesso!");
                    $("#subordinacaoAdministrativa").append(`<option value=''>Selecione uma Opção</option>`);
                    $('#addSubAdmin').modal('hide');
                    for(let item of data ){
                        $("#subordinacaoAdministrativa").append(`<option value='${item.id}'>${item.descricao}<otion>`);
                    }
                    $("#subordinacaoAdministrativa").focus();
                },
                error: function() {
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-success");
                    $("#sucesso").addClass("alert-danger");
                    $("#sucesso em").html(`Erro ao cadastrar Subordinacao Administrativa! Verifique se o campo já foi cadastrado!`);
                    $('#addSubAdmin').modal('hide');
                }
            });
            return false;
        });

        $('#addPrefeituraRegional').submit(function(e) {
            e.preventDefault();
            let novaPrefeituraRegional = $("#addPrefeituraRegional input[name='novaPrefeituraRegional']").val();
            let _token = $("#addPrefeituraRegional input[name='_token']").val();
            let descricao = $("#addPrefeituraRegional input[name='descricao']").val();
            $.ajax({
                url: '{{route('equipamentos.index')}}',
                type: 'POST',
                data: {'novaPrefeituraRegional': '','_token': _token, 'descricao': descricao},
                success: function(data) {
                    $("#prefeituraRegional option").remove();
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-danger");
                    $("#sucesso").addClass( "alert-success");
                    $("#sucesso em").html("Subprefeitura inserida com sucesso!");
                    $("#prefeituraRegional").append(`<option value=''>Selecione uma Opção</option>`);
                    $('#addPrefeituraRegional').modal('hide');
                    $("#prefeituraRegional").focus();
                    for(let item of data ){
                        $("#prefeituraRegional").append(`<option value='${item.id}'>${item.descricao}<otion>`);
                    }
                },
                error: function() {
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-success");
                    $("#sucesso").addClass("alert-danger");
                    $("#sucesso em").html(`Erro ao cadastrar Subprefeitura! Verifique se o campo já foi cadastrado!`);
                    $('#addPrefeituraRegional').modal('hide');
                }
            });
            return false;
        });

        $('#addDistrito').submit(function(e) {
            e.preventDefault();
            let novoDistrito = $("#addDistrito input[name='novoDistrito']").val();
            let _token = $("#addDistrito input[name='_token']").val();
            let descricao = $("#addDistrito input[name='descricao']").val();
            $.ajax({
                url: '{{route('equipamentos.index')}}',
                type: 'POST',
                data: {'novoDistrito': '','_token': _token, 'descricao': descricao},
                success: function(data) {
                    $("#distrito option").remove();
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-danger");
                    $("#sucesso").addClass( "alert-success");
                    $("#sucesso em").html("Distrito inserido com sucesso!");
                    $("#distrito").append(`<option value=''>Selecione uma Opção</option>`);
                    $('#addDistrito').modal('hide');
                    for(let item of data ){
                        $("#distrito").append(`<option value='${item.id}'>${item.descricao}<otion>`);
                    }
                    $("#distrito").focus();
                },
                error: function() {
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-success");
                    $("#sucesso").addClass("alert-danger");
                    $("#sucesso em").html(`Erro ao cadastrar Distrito inserido! Verifique se o campo já foi cadastrado!`);
                    $('#addDistrito').modal('hide');
                }
            });
            return false;
        });
    </script>
    <script type="text/javascript">
        //Script habilita campo Nome Tematica
        let radio = $("input[name='tematico']").val();
        if(radio == 0){
            $("#nome_tematica").attr('disabled', true);
        }else{
            $("#nome_tematica").attr('disabled', false);
        }
        $(document).ready(function()
        {
            $('input:radio[name="tematico"]').change(function(e)
            {
                if ($(this).val() == 0)
                {
                    $("#nome_tematica").attr('disabled', true);
                    $("#nome_tematica").attr('placeholder', '');
                    $("#nome_tematica").attr('value', '');
                } else
                {
                    $("#nome_tematica").attr('disabled', false);
                    $("#nome_tematica").attr('placeholder', 'Insira o nome da Temática');
                    $("#nome_tematica").attr('required', true);
                }
            });
        });
    </script>
    <script type="text/javascript">

        let status = $("#status option:selected").val();
        if(status == '' || status == '1' ){
            $("#observacao").attr('disabled', true);
        }else{
            $("#observacao").attr('disabled', false);
        }
        $(document).ready(function()
        {
            $('select[name="status"]').change(function(e)
            {
                if ($(this).val() == 0 || $(this).val() == 1)
                {
                    $("#observacao").attr('disabled', true);
                    $("#observacao").attr('placeholder', '');
                    $("input[name='observacao']").val('');
                } else if($(this).val() == 2 )
                {
                    $("#observacao").attr('disabled', false);
                    $("#observacao").attr('placeholder', 'Por que está Inativo?');
                    $("#observacao").attr('required', true);
                }
                else if($(this).val() == 3 )
                {
                    $("#observacao").attr('disabled', false);
                    $("#observacao").attr('placeholder', 'Por que está Fechado?');
                    $("#observacao").attr('required', true);
                }
            });
        });
    </script>
    <script type="text/javascript" >
        //Script CEP
        $(document).ready(function() {
            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#logradouro").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function () {
                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#logradouro").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#logradouro").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            }
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    }
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                }
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });


        // Script resgata valor comboBox e Radio Buttons
        $(document).ready(function () {
            $('input:radio[name="tematico"][value={{$equipamento->tematico}}]').attr('checked', true);
            $('#tipoServico').val("{{$equipamento->tipoServico->id}}");
            $('#equipamentoSigla').val("{{$equipamento->equipamentoSigla->id}}");
            $('#identificacaoSecretaria').val("{{$equipamento->secretaria->id}}");
            $('#subordinacaoAdministrativa').val("{{$equipamento->subordinacaoAdministrativa->id}}");
            $('#macrorregiao').val("{{$equipamento->endereco->macrorregiao->id}}");
            $('#regiao').val("{{$equipamento->endereco->regiao->id}}");
            $('#regional').val("{{$equipamento->endereco->regional->id}}");
            $('#telecentro').val("{{$equipamento->telecentro}}");
            $('#acervoespecializado').val("{{$equipamento->acervo_especializado}}");
            $('#nucleobraile').val("{{$equipamento->nucleo_braile}}");
            $('#prefeituraRegional').val("{{$equipamento->endereco->prefeitura_regional_id}}");
            $('#distrito').val("{{$equipamento->endereco->distrito_id}}");
            $('#status').val("{{$equipamento->status->id}}");
        });

        // Script Msg Excluir Usuario
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
@endsection