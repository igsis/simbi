<div class="tab-pane" id="ocorrencia">

    <!--Label Ocorrencia-->
    <table class="table table-bordered">
        <tbody>
        @if ($equipamento->ocorrencias->count() != 0)
            <tr>
                <th colspan="2" class="text-center">Ocorrências</th>
            </tr>
            <tr>
                <td colspan="4">
                    @foreach ($equipamento->ocorrencias as $ocorrencia)
                        <div class="list-group-item">
                            <strong>{{ date('d/m/Y', strtotime($ocorrencia->data)) }}</strong><br>
                            <label>Usuário: </label> {{ $ocorrencia->user->funcionario->nome }}<br>
                            <label>Ocorrência: </label> {{$ocorrencia->ocorrencia}}<br>
                            <label>Observação: </label> {{$ocorrencia->observacao}}
                        </div>
                    @endforeach
                </td>
            </tr>
        @else
            <tr>
                <th colspan="2" class="text-center">Não ha ocorrências cadastradas</th>
            </tr>
        @endif
        </tbody>
    </table>
</div>