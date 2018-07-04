@extends ('layouts.master')

@section ('conteudo')

<div class="container">
    <div id="sucesso" hidden class="alert "><em></em></div>
    <div style="text-align: center;">
        <h2>
            Cadastro de Equipamento
        </h2>
    </div>
    <hr>
    
    <form method="POST" action="{{ route('equipamentos.index') }}">
        {{ csrf_field() }}

        <div class="form-group has-feedback {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome">Nome do Equipamento</label>
            <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome') }}">
        </div>

        <div class="row">
            <div class="form-group col-xs-8 col-md-4 has-feedback {{ $errors->has('tipoServico') ? ' has-error' : '' }}">
                <label for="tipoServico">Tipo de Serviço</label>
                <select class="form-control" name="tipoServico" id="tipoServico">
                    <option value="">Selecione uma Opção</option>
                    @foreach ($tipoServicos as $tipoServico)
                        @if ($tipoServico->id == old('tipoServico'))
                            <option value="{{$tipoServico->id}}"selected>{{$tipoServico->descricao}}</option>
                        @else
                            <option value="{{$tipoServico->id}}">{{$tipoServico->descricao}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-xs-4 col-md-2">
                <label for="tipoServico ">Adicionar</label>
                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addServico"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
            </div>

            <div class="form-group col-xs-8 col-md-4 has-feedback {{ $errors->has('equipamentoSigla') ? ' has-error' : '' }}">
                <label for="equipamentoSigla">Sigla do Equipamento</label>
                <select class="form-control" name="equipamentoSigla" id="equipamentoSigla">
                    <option value="">Selecione uma Opção</option>
                    @foreach ($siglas as $sigla)
                        @if ($sigla->id == old('equipamentoSigla'))
                            <option value="{{$sigla->id}}" selected>{{$sigla->sigla}}</option>
                        @else
                            <option value="{{$sigla->id}}">{{$sigla->sigla}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-xs-4 col-md-2">
                <label for="equipamentoSigla">Adicionar</label>
                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSigla"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-8 col-md-4 has-feedback {{ $errors->has('identificacaoSecretaria') ? ' has-error' : '' }}">
                <label for="identificacaoSecretaria">Identificação da Secretaria</label>
                <select class="form-control" name="identificacaoSecretaria" id="identificacaoSecretaria">
                    <option value="">Selecione uma Opção</option>
                    @foreach ($secretarias as $secretaria)
                        @if ($secretaria->id == old('identificacaoSecretaria'))
                            <option value="{{$secretaria->id}}" selected>{{$secretaria->sigla}}</option>
                        @else
                            <option value="{{$secretaria->id}}">{{$secretaria->sigla}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-xs-4 col-md-2">
                <label for="identificacaoSecretaria">Adicionar</label>
                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSecretaria"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
            </div>

            <div class="form-group col-xs-8 col-md-4 has-feedback {{ $errors->has('subordinacaoAdministrativa') ? ' has-error' : '' }}">
                <label for="subordinacaoAdministrativa">Subordinação Administrativa</label>
                <select class="form-control" name="subordinacaoAdministrativa" id="subordinacaoAdministrativa">
                    <option value="">Selecione uma Opção</option>
                    @foreach ($subordinacoesAdministrativas as $subordinacaoAdministrativa)
                        @if ($subordinacaoAdministrativa->id == old('subordinacaoAdministrativa'))
                        <option value="{{$subordinacaoAdministrativa->id}}" selected>{{$subordinacaoAdministrativa->descricao}}</option>
                        @else
                        <option value="{{$subordinacaoAdministrativa->id}}">{{$subordinacaoAdministrativa->descricao}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-xs-4 col-md-2">
                <label for="subordinacaoAdministrativa">Adicionar</label>
                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSubAdmin"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Equipamento Temático?</label><br>
                @if (old('tematico') == 1)
                    <input type="radio" name="tematico" value="0" >
                    <label for=tematico style="padding:0 10px 0 5px;">Não</label>

                    <input type="radio" name="tematico" value="1" checked>
                    <label for=tematico style="padding:0 10px 0 5px;">Sim</label>
                @else
                    <input type="radio" name="tematico" value="0" checked>
                    <label for=tematico style="padding:0 10px 0 5px;">Não</label>

                    <input type="radio" name="tematico" value="1">
                    <label for=tematico style="padding:0 10px 0 5px;">Sim</label>
                @endif
                
            </div>
            <div class="form-group col-md-6">
                <label for=nome_tematica>Nome da Temática</label>
                <input type="text" class="form-control" name="nome_tematica" id="nome_tematica"  value="{{old('nome_tematica')}}" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" name="telefone" id="telefone" data-mask="(11) 0000-0000" placeholder="(11) xxxx-xxxx" value="{{ old('telefone') }}">
            </div>
        </div>

        <div style="text-align: center;"><h2>Endereço</h2></div>
        <hr>

        <div class="row">
            <div class="form-group col-md-2 has-feedback {{ $errors->has('cep') ? ' has-error' : '' }}">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" name="cep" id="cep" data-mask="00000-000" placeholder="xxxxx-xxx" value="{{ old('cep') }}">
            </div>
            <div class="form-group col-md-10">
                <label for="logradouro">Logradouro</label>
                <input type="text" class="form-control" name="logradouro" id="logradouro" readonly value="{{old('logradouro')}}">
            </div>
        </div>

        <div class="row">           
            <div class="form-group col-md-2 has-feedback {{ $errors->has('numero') ? ' has-error' : '' }}">
                <label for="numero">Número</label>
                <input type="text" class="form-control" name="numero" id="numero" value="{{old('numero')}}">
            </div>

            <div class="form-group col-md-3 has-feedback {{ $errors->has('complemento') ? ' has-error' : '' }}">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control" name="complemento" id="complemento" value="{{old('complemento')}}">
            </div>

            <div class="form-group col-md-3">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" name="bairro" id="bairro" readonly value="{{old('bairro')}}">
            </div>            

            <div class="form-group col-md-3">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" name="cidade" id="cidade" readonly value="{{old('cidade')}}">
            </div>

            <div class="form-group col-md-1">
                <label for="uf">UF</label>
                <input type="text" class="form-control" name="uf" id="uf" readonly value="{{old('uf')}}">
            </div>
        </div>

        <div class="row">             
            <div class="form-group col-md-4 has-feedback {{ $errors->has('macrorregiao') ? ' has-error' : '' }}">
                <label for="macrorregiao">Macrorregião</label>
                <select class="form-control" name="macrorregiao" id="macrorregiao">
                    <option value="">Selecione uma Opção</option>
                    @foreach ($macrorregioes as $macrorregiao)
                        @if ($macrorregiao->id == old('macrorregiao'))
                            <option value="{{$macrorregiao->id}}" selected>{{$macrorregiao->descricao}}</option>
                        @else
                            <option value="{{$macrorregiao->id}}">{{$macrorregiao->descricao}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4 has-feedback {{ $errors->has('regiao') ? ' has-error' : '' }}">
                <label for="regiao">Região</label>
                <select class="form-control" name="regiao" id="regiao">
                    <option value="">Selecione uma Opção</option>
                    @foreach ($regioes as $regiao)
                        @if ($regiao->id == old('regiao'))
                            <option value="{{$regiao->id}}" selected>{{$regiao->descricao}}</option>
                        @else
                            <option value="{{$regiao->id}}">{{$regiao->descricao}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4 has-feedback {{ $errors->has('regional') ? ' has-error' : '' }}">
                <label for="regional">Regional</label>
                <select class="form-control" name="regional" id="regional">
                    <option value="">Selecione uma Opção</option>
                    @foreach ($regionais as $regional)
                        @if ($regional->id == old('regional'))
                            <option value="{{$regional->id}}" selected>{{$regional->descricao}}</option>
                        @else
                            <option value="{{$regional->id}}">{{$regional->descricao}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-8 col-md-4 has-feedback {{ $errors->has('prefeituraRegional') ? 'has-error' : ''}}">
                <label for="prefeituraRegional">Prefeituras Regionais</label>
                <select name="prefeituraRegional" id="prefeituraRegional" class="form-control">
                    <option value="">Selecione uma Opção</option>
                    @foreach($prefeituraRegionais as $prefeituraRegional)
                        @if ($prefeituraRegional->id == old('prefeituraRegional'))
                            <option value="{{$prefeituraRegional->id}}" selected>{{$prefeituraRegional->descricao}}</option>
                        @else
                            <option value="{{$prefeituraRegional->id}}">{{$prefeituraRegional->descricao}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
                
            {{-- Add Prefeituras Regionais --}}
            <div class="form-group col-xs-4 col-md-2">
                <label for="prefeituraRegional">Adicionar</label>
                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addPrefeituraRegional"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
            </div>
  
            <div class="form-group col-xs-8 col-md-4 has-feedback {{ $errors->has('distrito') ? 'has-error' : ''}}">
                <label for="distrito">Distrito</label>
                <select name="distrito" id="distrito" class="form-control">
                    <option value="">Selecione uma Opção</option>
                    @foreach($distritos as $distrito)
                        @if ($distrito->id == old('distrito'))
                            <option value="{{$distrito->id}}" selected>{{$distrito->descricao}}</option>
                        @else
                            <option value="{{$distrito->id}}">{{$distrito->descricao}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            {{-- Add Distrito --}}
            <div class="form-group col-xs-4 col-md-2">
                <label for="distrito">Adicionar</label>
                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addDistrito"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
            </div>
        </div>

        {{-- <div class="form-row">
            <center><h3>Horario de Funcionamento</h3></center>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-offset-3 col-md-8" style="padding-bottom: 15px">
                    <input type="checkbox" name="domingo" id="diasemana07" value="1" /><label  style="padding:0 10px 0 5px;"> Domingo</label>
                    <input type="checkbox" name="segunda" id="diasemana01" value="1"/><label style="padding:0 10px 0 5px;"> Segunda</label>
                    <input type="checkbox" name="terca" id="diasemana02" value="1" /><label  style="padding:0 10px 0 5px;"> Terça</label>
                    <input type="checkbox" name="quarta" id="diasemana03" value="1" /><label style="padding:0 10px 0 5px;"> Quarta</label>
                    <input type="checkbox" name="quinta" id="diasemana04" value="1" /><label style="padding:0 10px 0 5px;"> Quinta</label>
                    <input type="checkbox" name="sexta" id="diasemana05" value="1" /><label  style="padding:0 10px 0 5px;"> Sexta</label>
                    <input type="checkbox" name="sabado" id="diasemana06" value="1" /><label style="padding:0 10px 0 5px;"> Sábado</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-offset-3 col-md-3">
                <label for="horarioAbertura">Horario de Abertura</label>
                <input type="text" class="form-control" name="horarioAbertura" id="horarioAbertura" data-mask="00:00">
            </div>
            <div class="form-group col-md-3">
                <label for="horarioFechamento">Horario de Fechamento</label>
                <input type="text" class="form-control" name="horarioFechamento" id="horarioFechamento" data-mask="00:00">
            </div>
        </div> --}}

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
            <div class="form-group col-md-4 has-feedback {{ $errors->has('status') ? ' has-error' : '' }}">
                <label for="status">Status do Equipamento</label>
                <select class="form-control" name="status" id="status">
                    <option value="">Selecione uma Opção</option>
                    @foreach ($status as $stats)
                        @if ($stats->id == old('status'))
                            <option value="{{$stats->id}}" selected>{{$stats->descricao}}</option>
                        @else
                            <option value="{{$stats->id}}">{{$stats->descricao}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-8 has-feedback {{ $errors->has('observacao') ? ' has-error' : '' }}">
                <label for="observacao">Observação</label>
                <input type="text" class="form-control" name="observacao" id="observacao"  value="{{old('observacao')}}" disabled>
            </div>
        </div>
        <div class="row">
            <hr>
            <div class="form-group col-md-12">
                <input type="submit" class="form-control btn btn-primary" name="enviar" value="Cadastrar">
            </div>
        </div>
    </form>
    
    @include('layouts.equipamento_modal')
</div>
@endsection
@section('scripts_adicionais')
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
                        $("#equipamentoSigla").append(`<option value='${item.id}'>${item.sigla}<otion>`);
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
                        $("#identificacaoSecretaria").append(`<option value='${item.id}'>${item.sigla}<otion>`);
                    }
                },
                error: function() {
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-success");
                    $("#sucesso").addClass("alert-danger");
                    $("#sucesso em").html(`Erro ao cadastrar Secretaria! Verifique se o campo já foi cadastrado!`);
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
                    $("#sucesso em").html("Prefeitura Regional inserida com sucesso!");
                    $("#prefeituraRegional").append(`<option value=''>Selecione uma Opção</option>`);
                    $('#addPrefeituraRegional').modal('hide');
                    for(let item of data ){
                        $("#prefeituraRegional").append(`<option value='${item.id}'>${item.descricao}<otion>`);
                    }
                    $("#prefeituraRegional").focus();
                },
                error: function() {
                    $("#sucesso").removeAttr("hidden");
                    $("#sucesso").removeClass("alert-success");
                    $("#sucesso").addClass("alert-danger");
                    $("#sucesso em").html(`Erro ao cadastrar Prefeitura Regional! Verifique se o campo já foi cadastrado!`);
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
                }
            });
            return false;
        });
    </script>
    <script type="text/javascript">
        //Script habilita campo Nome Tematica
        let radio = $("input[name='tematico']:checked").val();
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
    </script>
@endsection