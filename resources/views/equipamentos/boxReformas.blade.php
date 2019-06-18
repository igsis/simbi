<div class="tab-pane" id="reformas">
    <!--Label Reformas-->
    <div class="col text-center botao-margem">
        @hasanyrole('Coordenador|Administrador')
        <a href="{{ route('equipamentos.criaReforma', $equipamento->id) }}" class="btn btn-success">Inserir Reforma</a>
        @endhasanyrole
    </div>
    <table class="table table-bordered">
        <tbody>
        @if ($equipamento->reformas->count() != 0)
            <tr>
                <th colspan="2" class="text-center">Reformas</th>
            </tr>
            <tr>
                <td colspan="5">
                    @foreach ($equipamento->reformas as $reforma)
                        <div class="list-group-item">
                            <label>Inicio da Reforma: </label> {{ date('d/m/Y', strtotime($reforma->inicio_reforma)) }} <br>
                            <label>Fim da Reforma : </label> {{ date('d/m/Y', strtotime($reforma->termino_reforma)) }} <br>
                            <label>Descrição da Reforma</label> {{ $reforma->descricao }} <br>
                            <label>Usuário: </label> {{ $reforma->user->funcionario->nome  }}
                        </div>
                    @endforeach
                </td>
            </tr>
        @else
            <tr>
                <th colspan="2" class="text-center">Não ha reformas cadastradas</th>
            </tr>
        @endif
        </tbody>
    </table>
</div>