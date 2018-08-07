@extends('layouts.master')

@section('conteudo')

    {{--TODO: Update para os detalhes tecnicos--}}

    <div class="container">
        <div class="centralizado">
            <h2>
                Detalhes Técnicos<br>
                <small>{{$equipamento->nome}}</small>
            </h2>
        </div>

        <hr>

        <form method="POST" action="{{ route('equipamentos.gravaDetalhes', $equipamento->id) }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="contratoUso">Contrato de Uso</label>
                    <select class="form-control" name="contratoUso" id="contratoUso">
                        <option value="">Selecione...</option>
                        @foreach($contratos as $contrato)
                            <option value="{{$contrato->id}}">{{$contrato->contrato_uso}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="utilizacao">Utilização</label>
                    <select class="form-control" name="utilizacao" id="utilizacao">
                        <option value="">Selecione...</option>
                        @foreach($utilizacoes as $utilizacao)
                            <option value="{{$utilizacao->id}}">{{$utilizacao->utilizacao}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="porte">Porte</label>
                    <select class="form-control" name="porte" id="porte">
                        <option value="">Selecione...</option>
                        @foreach($portes as $porte)
                            <option value="{{$porte->id}}">{{$porte->porte}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="padrao">Padrão</label>
                    <select class="form-control" name="padrao" id="padrao">
                        <option value="">Selecione...</option>
                        @foreach($padroes as $padrao)
                            <option value="{{$padrao->id}}">{{$padrao->padrao}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-offset-3 col-md-3">
                    <label for="pavimento">Pavimentos</label>
                    <input type="text" class="form-control" name="pavimento" id="pavimento">
                </div>
                <div class="form-group col-md-3">
                    <label for="validade">Validade AVBC <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" title="Laudo de Vistoria do Corpo de Bombeiro"></span></label>
                    <input type="date" class="form-control" name="validade" id="validade">
                </div>
            </div>

            <div class="centralizado">
                <h2>
                    Detalhes de Acessibilidade
                </h2>
                <hr>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="acessibilidadeArquitetonica">Acessibilidade Arquitetonica</label>
                    <select class="form-control" name="acessibilidadeArquitetonica" id="acessibilidadeArquitetonica">
                        <option value="">Selecione...</option>
                        @foreach($arquitetonicas as $arquitetonica)
                            <option value="{{$arquitetonica->id}}">{{$arquitetonica->acessibilidade_arquitetonica}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="banheiros">Possui Banheiros Adaptados?</label>
                    <select class="form-control" name="banheiros" id="banheiros">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="rampas">Possui Rampas de Acesso?</label>
                    <select class="form-control" name="rampas" id="rampas">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="elevador">Possui Elevador?</label>
                    <select class="form-control" name="elevador" id="elevador">
                        <option value="">Selecione...</option>
                        @foreach ($elevadores as $elevador)
                            <option value="{{ $elevador->id }}">{{ $elevador->elevador }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="pisoTatil">Possui Piso Tátil?</label>
                    <select class="form-control" name="pisoTatil" id="pisoTatil">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="estacionamentoAcessivel">Possui Estacionamento Acessivel?</label>
                    <select class="form-control" name="estacionamentoAcessivel" id="estacionamentoAcessivel">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="qtdVagasAcessiveis">Quantidade de vagas?</label>
                    <input type="text" class="form-control" name="qtdVagasAcessiveis" id="qtdVagasAcessiveis">
                </div>
            </div>

            <div class="row">
                <hr>
                <div class="form-group col-md-offset-4 col-md-2">
                    <a href="{{route('equipamentos.show', $equipamento->id)}}" class="form-control btn btn-warning">
                        Retornar à Detalhes
                    </a>
                </div>
                <div class="form-group col-md-2">
                    <input type="submit" class="form-control btn btn-primary" name="enviar" value="Cadastrar">
                </div>
            </div>
        </form>
    </div>

@endsection
@section('scripts_adicionais')
    @include('scripts.radio_habilita_input', ['nomeRadio' => 'multiuso', 'idInput' => 'capacidadeMultiuso', 'mensagem' => ''])
    @include('scripts.radio_habilita_input', ['nomeRadio' => 'estudoGrupo', 'idInput' => 'capacidadeEstudoGrupo', 'mensagem' => ''])
    @include('scripts.radio_habilita_input', ['nomeRadio' => 'estudoIndividual', 'idInput' => 'capacidadeEstudoIndividual', 'mensagem' => ''])
    @include('scripts.radio_habilita_input', ['nomeRadio' => 'infantil', 'idInput' => 'capacidadeInfantil', 'mensagem' => ''])
    @include('scripts.radio_habilita_input', ['nomeRadio' => 'estacionamentoPublico', 'idInput' => 'qtdVagasPublico', 'mensagem' => ''])
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('input:radio[name="auditorio"]').change(function(e)
            {
                if ($(this).val() == 0)
                {
                    $("#nomeAuditorio").attr('disabled', true).attr('placeholder', '').attr('value', '').val('');
                    $("#capacidadeAuditorio").attr('disabled', true).attr('placeholder', '').attr('value', '').val('');
                } else
                {
                    $("#nomeAuditorio").attr('disabled', false).attr('placeholder', 'Insira o nome do Auditório').attr('required', true);
                    $("#capacidadeAuditorio").attr('disabled', false).attr('placeholder', '').attr('required', true);
                }
            });
        });

        $(document).ready(function()
        {
            $('input:radio[name="teatro"]').change(function(e)
            {
                if ($(this).val() == 0)
                {
                    $("#nomeTeatro").attr('disabled', true).attr('placeholder', '').attr('value', '').val('');
                    $("#capacidadeTeatro").attr('disabled', true).attr('placeholder', '').attr('value', '').val('');
                } else
                {
                    $("#nomeTeatro").attr('disabled', false).attr('placeholder', 'Insira o nome do Teatro').attr('required', true);
                    $("#capacidadeTeatro").attr('disabled', false).attr('placeholder', '').attr('required', true);
                }
            });
        });

        $(document).ready(function()
        {
            $('input:radio[name="praca"]').change(function(e)
            {
                if ($(this).val() == 0)
                {
                    $("#classificacao").attr('disabled', true).val('');
                } else
                {
                    $("#classificacao").attr('disabled', false).attr('required', true);
                }
            });
        });

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection