<div class="tab-pane" id="detalhes-tecnicos">
    <!--Label Detalhes Tecnicos-->
    <div class="col text-center botao-margem">
        @if (!isset($equipamento->detalhe))
            @hasanyrole('Coordenador|Administrador')
            <a href="{{ route('equipamentos.criaDetalhes', $equipamento->id) }}" class="btn btn-success botao-margem">Inserir Detalhes Técnicos</a>
            @endhasanyrole
        @else
            @hasanyrole('Coordenador|Administrador')
            <a href="{{ route('equipamentos.criaDetalhes', $equipamento->id) }}" class="btn btn-success botao-margem">Alterar Detalhes Técnicos</a>
            @endhasanyrole
        @endif
    </div>
    <table class="table table-bordered">
        <tbody>
        @if (isset ($equipamento->detalhe))
            <tr>
                <th colspan="2" class="text-center">Detalhes Técnicos</th>
            </tr>

            <tr>
                <th width="30%">Contrato de Uso:</th>
                <td>{{ $equipamento->detalhe->contratoUso->contrato_uso }}</td>
            </tr>
            <tr>
                <th width="30%">Utilização:</th>
                <td>{{ $equipamento->detalhe->utilizacao->utilizacao }}
                </td>
            </tr>
            <tr>
                <th width="30%">Porte:</th>
                <td>{{ $equipamento->detalhe->porte->porte }}</td>
            </tr>
            @if(isset($equipamento->detalhe->padrao->padrao))
            <tr>
                <th width="30%">Padrão:</th>
                <td>{{ $equipamento->detalhe->padrao->padrao }}</td>
            </tr>
            @endif
            <tr>
                <th width="30%">Pavimentos:</th>
                <td>{{ $equipamento->detalhe->pavimento }}</td>
            </tr>
            <tr>
                <th width="30%">Validade AVBC:</th>
                <td>{{ date('d/m/Y', strtotime($equipamento->detalhe->validade_avcb)) }}</td>
            </tr>
            <tr>
                <th width="30%">Prédio Tombado:</th>
                <td class="text-center">{{ $equipamento->detalhe->predio_tombado == 1 ? 'Sim' : 'Não'}}</td>
            </tr>
            @if (isset($equipamento->detalhe->lei))
                <tr>
                <th width="30%">Lei:</th>
                <td class="text-center">{{ $equipamento->detalhe->lei }}</td>
                </tr>    
            @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Detalhes de Acessibilidade</th>
        </tr>
        <tr>
            <th width="30%">Acessibilidade Arquitetonica:</th>
            <td>{{ $equipamento->detalhe->acessibilidade->acessibilidadeArquitetonica->acessibilidade_arquitetonica }}</td>
        </tr>
        <tr>
            <th width="30%">Banheiros Adaptados: </th>
            <td>
                @if ($equipamento->detalhe->acessibilidade->banheiros_adaptados == 0)
                    Não
                @else
                    Sim
                @endif
            </td>
        </tr>
        <tr>
            <th width="30%">Rampas de Acesso: </th>
            <td>
                @if ($equipamento->detalhe->acessibilidade->rampas_acesso == 0)
                    Não
                @else
                    Sim
                @endif
            </td>
        </tr>
        <tr>
            <th width="30%">Elevador: </th>
            <td>
                {{ $equipamento->detalhe->acessibilidade->elevador->elevador }}
            </td>
        </tr>
        <tr>
            <th width="30%">Piso Tátil: </th>
            <td>

                @if ($equipamento->detalhe->acessibilidade->piso_tatil == 0)
                    Não
                @else
                    Sim
                @endif
            </td>
        </tr>
        <tr>
            <th width="30%">Estacionamento Acessivel: </th>
            <td>
                @if ($equipamento->detalhe->acessibilidade->estacionamento_acessivel == 0)
                    Não
                @else
                    Sim
                @endif
            </td>
        </tr>
        <tr>
            <th width="30%">Quantidade de Vagas: </th>
            <td>{{ $equipamento->detalhe->acessibilidade->quantidade_vagas }}</td>
        </tr>
        @else
            <tr>
                <th colspan="2" class="text-center">Não ha detalhes cadastrados</th>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Área Externa</th>
        </tr>
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Estacionamento</th>
        </tr>
        @if (isset($equipamento->estacionamento))
            <tr>
                <th class="text-center" width="50%">Vagas internas: </th>
                <td class="text-center">{{ $equipamento->estacionamento->interno }}</td>
            </tr>
            <tr>
                <th class="text-center" width="50%">Vagas externas: </th>
                <td class="text-center">{{ $equipamento->estacionamento->externo }}</td>
            </tr>
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <th style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addEstacionamento">Adicionar</button>
                    @endhasanyrole
                </th>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Praça</th>
        </tr>
        @if (isset($equipamento->praca))
            <tr>
                <th class="text-center" width="50%">Situado em praça: </th>
                {{-- TODO : Verificar relacionamento da praça --}}
                <td class="text-center">{{ $equipamento->praca->praca == 1 ? 'Sim' : 'Não'}}</td>
            </tr>

            <tr>
                <th class="text-center" width="50%">Classificação: </th>
                {{-- TODO : Verificar relacionamento da praça --}}
                <td class="text-center">{{ $equipamento->praca->classificacao->classificacao }}</td>
            </tr>
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <th style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addPraca">Adicionar</button>
                    @endhasanyrole
                </th>
            </tr>
        @endif
        </tbody>
    </table>
</div>