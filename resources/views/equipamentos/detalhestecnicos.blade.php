@extends('layouts.master')

@section('conteudo')

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
                            <option value="{{$porte->id}}">{{$porte->utilizacao}}</option>
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

            <div class="centralizado">
                <h2>
                    Acessibilidade
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
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
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

            <div class="centralizado">
                <h2>
                    Capacidades
                </h2>
                <hr>
            </div>

            <div class="row">
                <div class="form-group col-md-2 centralizado">
                    <label>Possui Auditório?</label><br>
                    @if (old('auditorio') == 1)
                        <label for="auditorio" style="padding:0 10px 0 5px;">
                            <input type="radio" name="auditorio" value="0" >
                            Não
                        </label>
                        <label for="auditorio" style="padding:0 10px 0 5px;">
                            <input type="radio" name="auditorio" value="1" checked>
                            Sim
                        </label>
                    @else
                        <label for="auditorio" style="padding:0 10px 0 5px;">
                            <input type="radio" name="auditorio" value="0" checked>
                            Não
                        </label>
                        <label for="auditorio" style="padding:0 10px 0 5px;">
                            <input type="radio" name="auditorio" value="1">
                            Sim
                        </label>
                    @endif
                </div>
                <div class="form-group col-md-7">
                    <label for="nomeAuditorio">Nome do Auditório</label>
                    <input type="text" class="form-control" name="nomeAuditorio" id="nomeAuditorio"  value="{{old('nomeAuditorio')}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="capacidadeAuditorio">Capacidade do Auditório</label>
                    <input type="text" class="form-control" name="capacidadeAuditorio" id="capacidadeAuditorio"  value="{{old('capacidadeAuditorio')}}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-2 centralizado">
                    <label>Possui Teatro?</label><br>
                    @if (old('teatro') == 1)
                        <label for="teatro" style="padding:0 10px 0 5px;">
                            <input type="radio" name="teatro" value="0" >
                            Não
                        </label>
                        <label for="teatro" style="padding:0 10px 0 5px;">
                            <input type="radio" name="teatro" value="1" checked>
                            Sim
                        </label>
                    @else
                        <label for="teatro" style="padding:0 10px 0 5px;">
                            <input type="radio" name="teatro" value="0" checked>
                            Não
                        </label>
                        <label for="teatro" style="padding:0 10px 0 5px;">
                            <input type="radio" name="teatro" value="1">
                            Sim
                        </label>
                    @endif
                </div>
                <div class="form-group col-md-7">
                    <label for=nomeTeatro>Nome do Teatro</label>
                    <input type="text" class="form-control" name="nomeTeatro" id="nomeTeatro"  value="{{old('nomeTeatro')}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="capacidadeTeatro">Capacidade do Teatro</label>
                    <input type="text" class="form-control" name="capacidadeTeatro" id="capacidadeTeatro"  value="{{old('capacidadeTeatro')}}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-2 centralizado">
                    <label>Possui Sala Multiuso?</label><br>
                    @if (old('multiuso') == 1)
                        <label for="multiuso" style="padding:0 10px 0 5px;">
                            <input type="radio" name="multiuso" value="0" >
                            Não
                        </label>
                        <label for="multiuso" style="padding:0 10px 0 5px;">
                            <input type="radio" name="multiuso" value="1" checked>
                            Sim
                        </label>
                    @else
                        <label for="multiuso" style="padding:0 10px 0 5px;">
                            <input type="radio" name="multiuso" value="0" checked>
                            Não
                        </label>
                        <label for="multiuso" style="padding:0 10px 0 5px;">
                            <input type="radio" name="multiuso" value="1">
                            Sim
                        </label>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="capacidadeMultiuso">Capacidade da Sala Multiuso</label>
                    <input type="text" class="form-control" name="capacidadeMultiuso" id="capacidadeMultiuso"  value="{{old('capacidadeMultiuso')}}" disabled>
                </div>
                <div class="form-group col-md-3 centralizado">
                    <label>Possui Sala de Estudo em Grupo?</label><br>
                    @if (old('estudoGrupo') == 1)
                        <label for="estudoGrupo" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estudoGrupo" value="0" >
                            Não
                        </label>
                        <label for="estudoGrupo" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estudoGrupo" value="1" checked>
                            Sim
                        </label>
                    @else
                        <label for="estudoGrupo" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estudoGrupo" value="0" checked>
                            Não
                        </label>
                        <label for="estudoGrupo" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estudoGrupo" value="1">
                            Sim
                        </label>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label for="capacidadeEstudoGrupo">Capacidade da Sala de Estudo em Grupo</label>
                    <input type="text" class="form-control" name="capacidadeEstudoGrupo" id="capacidadeEstudoGrupo"  value="{{old('capacidadeEstudoGrupo')}}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-2 centralizado">
                    <label>Possui Sala Infantil?</label><br>
                    @if (old('infantil') == 1)
                        <label for="infantil" style="padding:0 10px 0 5px;">
                            <input type="radio" name="infantil" value="0" >
                            Não
                        </label>
                        <label for="infantil" style="padding:0 10px 0 5px;">
                            <input type="radio" name="infantil" value="1" checked>
                            Sim
                        </label>
                    @else
                        <label for="infantil" style="padding:0 10px 0 5px;">
                            <input type="radio" name="infantil" value="0" checked>
                            Não
                        </label>
                        <label for="infantil" style="padding:0 10px 0 5px;">
                            <input type="radio" name="infantil" value="1">
                            Sim
                        </label>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label for="capacidadeInfantil">Capacidade da Sala Infantil</label>
                    <input type="text" class="form-control" name="capacidadeInfantil" id="capacidadeInfantil"  value="{{old('capacidadeInfantil')}}" disabled>
                </div>
                <div class="form-group col-md-3 centralizado">
                    <label>Possui Sala de Estudo Individual?</label><br>
                    @if (old('estudoIndividual') == 1)
                        <label for="estudoIndividual" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estudoIndividual" value="0" >
                            Não
                        </label>
                        <label for="estudoIndividual" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estudoIndividual" value="1" checked>
                            Sim
                        </label>
                    @else
                        <label for="estudoIndividual" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estudoIndividual" value="0" checked>
                            Não
                        </label>
                        <label for="estudoIndividual" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estudoIndividual" value="1">
                            Sim
                        </label>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="capacidadeEstudoIndividual">Quantidade de Salas de Estudo Individual</label>
                    <input type="text" class="form-control" name="capacidadeEstudoIndividual" id="capacidadeEstudoIndividual"  value="{{old('capacidadeEstudoIndividual')}}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-2 centralizado">
                    <label>Situado em Praça?</label><br>
                    @if (old('praca') == 1)
                        <label for="praca" style="padding:0 10px 0 5px;">
                            <input type="radio" name="praca" value="0" >
                            Não
                        </label>
                        <label for="praca" style="padding:0 10px 0 5px;">
                            <input type="radio" name="praca" value="1" checked>
                            Sim
                        </label>
                    @else
                        <label for="praca" style="padding:0 10px 0 5px;">
                            <input type="radio" name="praca" value="0" checked>
                            Não
                        </label>
                        <label for="praca" style="padding:0 10px 0 5px;">
                            <input type="radio" name="praca" value="1">
                            Sim
                        </label>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label for="classificacao">Classificação da Área Externa</label>
                    <select class="form-control" name="classificacao" id="classificacao"  value="{{old('classificacao')}}" disabled>
                        <option value="">Selecione...</option>
                        @foreach($pracaClassificacoes as $pracaClassificacao)
                            <option value="{{$pracaClassificacao->id}}">{{$pracaClassificacao->classificacao}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3 centralizado">
                    <label>Possui Estacionamento ao Publico?</label><br>
                    @if (old('estacionamentoPublico') == 1)
                        <label for="estacionamentoPublico" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estacionamentoPublico" value="0" >
                            Não
                        </label>
                        <label for="estacionamentoPublico" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estacionamentoPublico" value="1" checked>
                            Sim
                        </label>
                    @else
                        <label for="estacionamentoPublico" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estacionamentoPublico" value="0" checked>
                            Não
                        </label>
                        <label for="estacionamentoPublico" style="padding:0 10px 0 5px;">
                            <input type="radio" name="estacionamentoPublico" value="1">
                            Sim
                        </label>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="qtdVagasPublico">Capacidade do Estacionamento</label>
                    <input type="text" class="form-control" name="qtdVagasPublico" id="qtdVagasPublico"  value="{{old('qtdVagasPublico')}}" disabled>
                </div>
            </div>

            <div class="centralizado">
                <h2>
                    Áreas
                </h2>
                <hr>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="areaInterna">Área Interna</label>
                    <input type="text" class="form-control" name="areaInterna" id="areaInterna"  value="{{old('areaInterna')}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="areaAuditorio">Área do Auditório</label>
                    <input type="text" class="form-control" name="areaAuditorio" id="areaAuditorio"  value="{{old('areaAuditorio')}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="areaTeatro">Área do Teatro</label>
                    <input type="text" class="form-control" name="areaTeatro" id="areaTeatro"  value="{{old('areaTeatro')}}" disabled>
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
    </script>
@endsection