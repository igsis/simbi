<div class="tab-pane" id="area">
    <!--Label Area-->
    <div class="col text-center botao-margem">
        @if (!isset($equipamento->area))
            @hasanyrole('Coordenador|Administrador')
            <a href="{{ route('equipamentos.criaArea', $equipamento->id) }}" class="btn btn-success">Inserir Áreas</a>
            @endhasanyrole
        @else
            @hasanyrole('Coordenador|Administrador')
            <a href="{{ route('equipamentos.criaArea', $equipamento->id) }}" class="btn btn-success">Alterar Área</a>
            @endhasanyrole
        @endif
    </div>
    <table class="table table-bordered">
        <tbody>
        @if (isset($equipamento->area))
            <tr>
                <th colspan="2" class="text-center">Área (m²)</th>
            </tr>
            <tr>
                <th width="30%">Área Interna: </th>
                <td>{{ $equipamento->area->interna }}</td>
            </tr>
            <tr>
                <th width="30%">Área Auditório: </th>
                <td>{{ $equipamento->area->auditorio }}</td>
            </tr>
            <tr>
                <th width="30%">Área do Teatro: </th>
                <td>{{ $equipamento->area->teatro }}</td>
            </tr>
            <tr>
                <th width="30%">Área Total Construída: </th>
                <td>{{ $equipamento->area->total_construida }}</td>
            </tr>
            <tr>
                <th width="30%">Área Total Terreno: </th>
                <td>{{ $equipamento->area->total_terreno }}</td>
            </tr>
        @else
            <tr>
                <th colspan="2" class="text-center">Não ha áreas cadastradas</th>
            </tr>
        @endif
        </tbody>
    </table>
</div>