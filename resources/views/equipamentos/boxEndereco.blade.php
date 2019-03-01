<div class="tab-pane" id="dados-endereco">
    <!--Label Dados Endereço-->
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Dados do Endereço</th>
        </tr>

        <tr>
            <th width="30%">Endereço:</th>
            <td>{{$equipamento->endereco->logradouro}}</td>
        </tr>
        <tr>
            <th width="30%">Bairro:</th>
            <td>{{$equipamento->endereco->bairro}}</td>
        </tr>
        <tr>
            <th width="30%">Número:</th>
            <td>{{$equipamento->endereco->numero}}</td>
        </tr>
        <tr>
            <th width="30%">Complemento:</th>
            <td>{{$equipamento->endereco->complemento}}</td>
        </tr>
        <tr>
            <th width="30%">CEP:</th>
            <td>{{$equipamento->endereco->cep}}</td>
        </tr>
        <tr>
            <th width="30%">Cidade:</th>
            <td>{{$equipamento->endereco->cidade}}</td>
        </tr>
        <tr>
            <th width="30%">UF:</th>
            <td>{{$equipamento->endereco->estado}}</td>
        </tr>
        <tr>
            <th width="30%">Prefeitura Regional:</th>
            <td>{{$equipamento->endereco->prefeituraRegional->descricao}}</td>
        </tr>
        <tr>
            <th width="30%">Distrito:</th>
            <td>{{$equipamento->endereco->distrito->descricao}}</td>
        </tr>
        <tr>
            <th width="30%">Macrorregião:</th>
            <td>{{$equipamento->endereco->macrorregiao->descricao}}</td>
        </tr>
        <tr>
            <th width="30%">Região:</th>
            <td>{{$equipamento->endereco->regiao->descricao}}</td>
        </tr>
        <tr>
            <th width="30%">Regional:</th>
            <td>{{$equipamento->endereco->regional->descricao}}</td>
        </tr>
        </tbody>
    </table>
</div>