@extends ('layouts.master')

@section ('conteudo')

    <div class="container">
        <div id="sucesso" hidden class="alert "><em></em></div>
        <div style="text-align: center;">
            <h2>
                Importar
                @foreach($equipamentoIgsis as $igsis)
                    {{ $equipamento = $igsis->sala }}
                    <?php $igsis_id = $igsis->idLocal; ?>
                @endforeach
                do IGSIS

            </h2>
        </div>
        <hr>

        <form method="POST" action="{{ route('equipamentos.index') }}">
            {{ csrf_field() }}

            <div class="form-group has-feedback {{ $errors->has('nome') ? ' has-error' : '' }}">
                <label for="nome">Nome do Equipamento</label>
                <input type="text" class="form-control" name="nome" id="nome" value="{{ $equipamento }}">
            </div>

            <div class="hidden">
                <label for="igisi_id">ID do igsis</label>
                <input type="text" class="form-control" name="igsis_id" id="igsis_id" value="{{ $igsis_id }}">
            </div>

            <div class="row">
                <div class="form-group col-xs-8 col-md-4 has-feedback {{ $errors->has('tipoServico') ? ' has-error' : '' }}">
                    <label for="tipoServico">Tipo de Serviço</label>
                    <select class="form-control" name="tipoServico" id="tipoServico">
                        <option value="">Selecione uma Opção</option>
                        @foreach ($tipoServicos as $tipoServico)
                            @if ($tipoServico->id == old('tipoServico'))
                                <option value="{{$tipoServico->id}}" selected>{{$tipoServico->descricao}}</option>
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

                        <label for=tematico style="padding:0 10px 0 5px;">
                            <input type="radio" name="tematico" value="0" >
                            Não
                        </label>


                        <label for=tematico style="padding:0 10px 0 5px;">
                            <input type="radio" name="tematico" value="1" checked>
                            Sim
                        </label>
                    @else

                        <label for=tematico style="padding:0 10px 0 5px;">
                            <input type="radio" name="tematico" value="0" checked>
                            Não
                        </label>


                        <label for=tematico style="padding:0 10px 0 5px;">
                            <input type="radio" name="tematico" value="1">
                            Sim
                        </label>
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

            <div style="text-align: center;"><h2>Horario de Funcionamento</h2></div>

            <div class="horario">
                <div class="row">
                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-8" style="padding-bottom: 15px">
                            <input type="hidden" name="funcionamento[0]">
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

                <div class="form-group col-md-12">
                    <a href="{{route('equipamentos.index', ['type' => '1'])}}" class="form-control btn btn-warning">
                        Retornar à Lista de Equipamentos
                    </a>
                </div>
            </div>
        </form>

        @include('layouts.equipamento_modal')
    </div>
@endsection
@section('scripts_adicionais')
    @include('scripts.insere_ajax')
    @include('scripts.busca_cep')
    @include('scripts.duplicar_div', ['divpai' => '.horario'])
    <script type="text/javascript">
        //Script habilita campo Nome Tematica

        $(document).ready(function()
        {
            $('input:radio[name="tematico"]').change(function(e)
            {
                if ($(this).val() == 0)
                {
                    $("#nome_tematica").attr('disabled', true);
                    $("#nome_tematica").attr('placeholder', '');
                    $("#nome_tematica").attr('value', '');
                    $("#nome_tematica").val('');
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

@endsection