@extends('layouts.master')

@section('linksAdicionais')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>
@endsection

@section('titulo','Consulta')

@section('tituloPagina')
    <i class="fa fa-pencil-square-o"></i>
    Registrar Consulta <small>{{$equipamento->nome}}</small>
@endsection


@section('conteudo')

    <form method="POST" action="{{ route('consulta.update', [$equipamento->id, $consulta->id]) }}" autocomplete="off">
        {{ csrf_field() }}

        <div class="row">
            <div class="form-group col-md-offset-3 col-md-3">
                <label for="data">Mês - Ano</label>
                <input type="text" class="form-control" id="calendario" name="data" value="{{ date('m/d/Y', strtotime($consulta->data)) }}" autocomplete="off" maxlength="10">
            </div>
            <div class="form-group col-md-4">
                <label>Período</label>
                <h5>
                    <input type="radio" name="periodo" value="1" checked> Segunda à Sexta &nbsp;&nbsp;
                    <input type="radio" name="periodo" value="2" > Sábado &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="periodo" value="3"> Domingo
                </h5>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="form-group col-md-offset-3 col-md-3">
                <label for="livro">Livro</label>
                <input type="number" class="form-control" name="livro" id="livro"
                       value="{{ $consulta->livro }}" onblur="calcular()" onkeyup="calcular()">
            </div>
            <div class="form-group col-md-3">
                <label for="audioVisual">Audio-visual</label>
                <input type="number" class="form-control" name="audioVisual" id="audioVisual"
                       value="{{ $consulta->audio_visual }}" onblur="calcular()" onkeyup="calcular()">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-offset-3 col-md-3">
                <label for="manga">Mangá</label>
                <input type="number" class="form-control" name="manga" id="manga"
                       value="{{ $consulta->manga }}" onblur="calcular()" onkeyup="calcular()">
            </div>
            <div class="form-group col-md-3">
                <label for="jornal">Jornal</label>
                <input type="number" class="form-control" name="jornal" id="jornal"
                       value="{{ $consulta->jornal }}" onblur="calcular()" onkeyup="calcular()">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-offset-3 col-md-3">
                <label for="revista">Revista</label>
                <input type="number" class="form-control" name="revista" id="revista"
                       value="{{ $consulta->revista }}" onblur="calcular()" onkeyup="calcular()">
            </div>
            <div class="form-group col-md-3">
                <label for="suportes">Suportes</label>
                <input type="number" class="form-control" name="suportes" id="suportes"
                       value="{{ $consulta->suportes }}" onblur="calcular()" onkeyup="calcular()">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-offset-3 col-md-3">
                <label for="total">Total</label>
                <input type="number" class="form-control" name="total" id="total" readonly onload="calcular()">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-offset-5 col-md-2">
                <input type="submit" class="form-control btn btn-primary" name="enviar" value="Salvar">
            </div>
        </div>
    </form>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
        function calcular() {
            let livro = parseInt(document.getElementById('livro').value, 10);
            let audioVisual = parseInt(document.getElementById('audioVisual').value, 10);
            let manga = parseInt(document.getElementById('manga').value, 10);
            let revista = parseInt(document.getElementById('revista').value, 10);
            let jornal = parseInt(document.getElementById('jornal').value, 10);
            let suportes = parseInt(document.getElementById('suportes').value, 10);


            livro = isNaN(livro) ? 0 : livro;
            audioVisual = isNaN(audioVisual) ? 0 : audioVisual;
            manga = isNaN(manga) ? 0 : manga;
            revista = isNaN(revista) ? 0 : revista;
            jornal = isNaN(jornal) ? 0 : jornal;
            suportes = isNaN(suportes) ? 0 : suportes;

            let soma = livro + audioVisual + manga + revista + jornal + suportes;
            let total = document.getElementById("total");

            total.value = String(soma);
        }

        window.onload = calcular();

    </script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            let data = new Date();
            $('#calendario').datepicker("option", "showAnim", "blind");
            $("#calendario").datepicker({

                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                currentText: 'Atual',
                closeText : 'Escolher',

                onClose: function(dateText, inst) {
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                },

                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
            });
            $('#calendario').datepicker("option", "dateFormat", "mm/yy");
        });

    </script>

@endsection
