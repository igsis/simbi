<div class="active tab-pane" id="dados-equipamento">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Dados do Equipamento</th>
        </tr>
        <tr>
            <th width="30%">Nome:</th>
            <td>{{$equipamento->nome}}</td>
        </tr>
        <tr>
            <th width="30%">Tipo de Serviço:</th>
            <td>{{$equipamento->tipoServico->descricao}}</td>
        </tr>
        <tr>
            <th width="30%">Sigla do Equipamento:</th>
            <td>{{$equipamento->equipamento_sigla}}</td>
        </tr>
        <tr>
            <th width="30%">Telefone:</th>
            <td>{{$equipamento->telefone}}</td>
        </tr>
        <tr>
            <th width="30%">Identificação da Secretaria:</th>
            <td>{{$equipamento->secretaria->descricao}}</td>
        </tr>
        <tr>
            <th width="30%">Subordinação Administrativa:</th>
            <td>{{$equipamento->subordinacaoAdministrativa->descricao}}</td>
        </tr>

        @if ($equipamento->tematico == 1)
            <tr>
                <th width="30%">Equipamento Temático:</th>
                <td>Sim</td>
            </tr>
            <tr>
                <th width="30%">Nome da Temática:</th>
                <td>{{$equipamento->nome_tematica}}</td>
            </tr>
        @else
            <tr>
                <th width="30%">Equipamento Temático:</th>
                <td>Não</td>
            </tr>
        @endif

        <tr>
            <th width="30%">Telecentro:</th>
            <td>
                @if ($equipamento->telecentro == 0)
                    Não
                @else
                    Sim
                @endif
            </td>
        </tr>
        <tr>
            <th width="30%">Acervo Especializado:</th>
            <td>
                @if ($equipamento->acervo_especializado == 0)
                    Não
                @else
                    Sim
                @endif
            </td>
        </tr>
        <tr>
            <th width="30%">Núcleo Braile:</th>
            <td>
                @if ($equipamento->nucleo_braile == 0)
                    Não
                @else
                    Sim
                @endif
            </td>
        </tr>
        <tr>
            <th width="30%">Status:</th>
            <td>{{$equipamento->status->descricao}}</td>
        </tr>
        </tbody>
    </table>
    @foreach ($equipamento->funcionamentos as $funcionamento)
        @if ($funcionamento->publicado == 1)
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th colspan="2" class="text-center">
                        @if (($funcionamento->segunda == 1) && ($funcionamento->terca == 1) && ($funcionamento->quarta == 1) && ($funcionamento->quinta == 1) && ($funcionamento->sexta == 1) && ($funcionamento->sabado == 1) && ($funcionamento->domingo == 1))
                            Todos os Dias
                        @elseif (($funcionamento->segunda == 1) && ($funcionamento->terca == 1) && ($funcionamento->quarta == 1) && ($funcionamento->quinta == 1) && ($funcionamento->sexta == 1) && ($funcionamento->sabado == 0) && ($funcionamento->domingo == 0))
                            Segunda a Sexta
                        @elseif  (($funcionamento->segunda == 0) && ($funcionamento->terca == 0) && ($funcionamento->quarta == 0) && ($funcionamento->quinta == 0) && ($funcionamento->sexta == 0) && ($funcionamento->sabado == 1) && ($funcionamento->domingo == 1))
                            Final de Semana
                        @elseif  (($funcionamento->segunda == 0) && ($funcionamento->terca == 1) && ($funcionamento->quarta == 1) && ($funcionamento->quinta == 1) && ($funcionamento->sexta == 1) && ($funcionamento->sabado == 1) && ($funcionamento->domingo == 1))
                            Terça a Domingo
                        @else
                            {{ ($funcionamento->segunda == 1) ? "Segunda " : " " }}
                            {{ ($funcionamento->terca == 1) ? "Terça " : " " }}
                            {{ ($funcionamento->quarta == 1) ? "Quarta " : " " }}
                            {{ ($funcionamento->quinta == 1) ? "Quinta " : " " }}
                            {{ ($funcionamento->sexta == 1) ? "Sexta " : " " }}
                            {{ ($funcionamento->sabado == 1) ? "Sabado " : " " }}
                            {{ ($funcionamento->domingo == 1) ? "Domingo " : " " }}
                        @endif

                    </th>
                </tr>
                <tr>
                    <th width="30%">Abre às:</th>
                    <td>{{ date('G:i', strtotime($funcionamento->hora_inicial)) }}</td>
                </tr>
                <tr>
                    <th width="30%">Fecha às:</th>
                    <td>{{ date('G:i', strtotime($funcionamento->hora_final)) }}</td>
                </tr>
                </tbody>
            </table>
        @endif
    @endforeach
</div>