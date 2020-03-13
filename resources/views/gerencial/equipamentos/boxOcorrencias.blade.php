<div class="tab-pane" id="ocorrencia">

    <!--Label Ocorrencia-->
    <table class="table table-bordered">
        <tbody>
        @if ($eventos->count() != 0)
            <tr>
                <th colspan="2" class="text-center">Ocorrências</th>
            </tr>
            <table id="tabela1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="50%">Evento</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Público Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($eventos as $evento)
                    <tr class="evento" id="enviado">
                        <td>{{ $evento->nome_evento }} <span
                                    class="text-center text-red text-bold expirado"></span></td>
                        <td class="dataFrequencia">{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                        <td>{{ date('H:i', strtotime($evento->horario)) }}</td>
                        <td>{{$evento->total}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfooter>
                    <thead>
                    <tr>
                        <th width="50%">Evento</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Público Total</th>
                    </tr>
                    </thead>
                </tfooter>
            </table>
        @else
            <tr>
                <th colspan="2" class="text-center">Não ha ocorrências cadastradas</th>
            </tr>
        @endif
        </tbody>
    </table>
</div>