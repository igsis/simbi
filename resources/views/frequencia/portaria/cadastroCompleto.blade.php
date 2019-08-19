@extends('layouts.master2')

@section('titulo','Cadastrar Ocorrência')
@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> Público Atendido</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $equipamento->nome }}</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{route('frequencia.portaria.gravaCompleto', $equipamento->id)}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Data do evento
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="total">Data</label>
                                <input type="text" class="form-control calendario" name="data" id="data" value="{{old('data')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Escolaridade
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="fundamental">Fundamental</label>
                                <input type="number" class="form-control" name="fundamental" id="fundamental" value="{{old('fundamental')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="medio">Médio</label>
                                <input type="number" class="form-control" name="medio" id="medio" value="{{old('medio')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="fundamental">Superior</label>
                                <input type="number" class="form-control" name="superior" id="superior" value="{{old('superior')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="naoInformadoEscolaridade">Não Informado</label>
                                <input type="number" class="form-control" name="naoInformadoEscolaridade" id="naoInformadoEscolaridade" value="{{old('naoInformadoEscolaridade')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Faixa Etária
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="idade0_6">0-6 Anos</label>
                                <input type="number" class="form-control" name="idade0_6" id="idade0_6" value="{{old('idade0_6')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="idade7_14">7-14 Anos</label>
                                <input type="number" class="form-control" name="idade7_14" id="idade7_14" value="{{old('idade7_14')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="idade15_17">15-17 Anos</label>
                                <input type="number" class="form-control" name="idade15_17" id="idade15_17" value="{{old('idade15_17')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="idade18_29">18-29 Anos</label>
                                <input type="number" class="form-control" name="idade18_29" id="idade18_29" value="{{old('idade18_29')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="idade30_59">30-59 Anos</label>
                                <input type="number" class="form-control" name="idade30_59" id="idade30_59" value="{{old('idade30_59')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="idade60ouMais">60 ou mais</label>
                                <input type="number" class="form-control" name="idade60ouMais" id="idade60ouMais" value="{{old('idade60ouMais')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="naoInformadoIdade">Não Informado</label>
                                <input type="number" class="form-control" name="naoInformadoIdade" id="naoInformadoIdade" value="{{old('naoInformadoIdade')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Cor/Raça
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="amarela">Amarela</label>
                                <input type="number" class="form-control" name="amarela" id="amarela" value="{{old('amarela')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="branca">Branca</label>
                                <input type="number" class="form-control" name="branca" id="branca" value="{{old('branca')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="indigena">Indígena</label>
                                <input type="number" class="form-control" name="indigena" id="indigena" value="{{old('indigena')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="parda">Parda</label>
                                <input type="number" class="form-control" name="parda" id="parda" value="{{old('parda')}}"  onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="preta">Preta</label>
                                <input type="number" class="form-control" name="preta" id="preta" value="{{old('preta')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="naoInformadoCor">Não Informado</label>
                                <input type="number" class="form-control" name="naoInformadoCor" id="naoInformadoCor" value="{{old('naoInformadoCor')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Sexo
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="feminino">Feminino</label>
                                <input type="number" class="form-control" name="feminino" id="feminino" value="{{old('feminino')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="masculino">Masculino</label>
                                <input type="number" class="form-control" name="masculino" id="masculino" value="{{old('masculino')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="naoInformadoSexo">Não Informado</label>
                                <input type="number" class="form-control" name="naoInformadoSexo" id="naoInformadoSexo" value="{{old('naoInformadoSexo')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Pessoas com deficiência
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="visual">Visual</label>
                                <input type="number" class="form-control" name="visual" id="visual" value="{{old('visual')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="auditiva">Auditiva</label>
                                <input type="number" class="form-control" name="auditiva" id="auditiva" value="{{old('auditiva')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="motora">Motora</label>
                                <input type="number" class="form-control" name="motora" id="motora" value="{{old('motora')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="mental">Mental</label>
                                <input type="number" class="form-control" name="mental" id="mental" value="{{old('mental')}}" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="total">Total</label>
                                <input type="number" class="form-control" name="total" id="total" readonly>
                            </div>
                        </div>
                        <input class="btn btn-success" type="submit" value="Cadastrar">
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
        function caculoTotal() {
            //Escolaridade
            var fundamental = parseInt(document.querySelector('#fundamental').value);
            var medio = parseInt(document.querySelector('#medio').value);
            var superior = parseInt(document.querySelector('#superior').value);
            var naoInformadoEscola = parseInt(document.querySelector('#naoInformadoEscolaridade').value)

            fundamental = isNaN(fundamental) ? 0 : fundamental;
            medio = isNaN(medio) ? 0 : medio;
            superior = isNaN(superior) ? 0 : superior;
            naoInformadoEscola =isNaN(naoInformadoEscola) ? 0 : naoInformadoEscola;

            //Sexo
            var feminino = parseInt(document.querySelector('#feminino').value);
            var masculino = parseInt(document.querySelector('#masculino').value);
            var naoInformadoSexo = parseInt(document.querySelector('#naoInformadoSexo').value);

            feminino = isNaN(feminino) ? 0 : feminino;
            masculino = isNaN(masculino) ? 0 : masculino;
            naoInformadoSexo = isNaN(naoInformadoSexo) ? 0 : naoInformadoSexo;

            //Faixa etária
            var idade0_6 = parseInt(document.querySelector('#idade0_6').value);
            var idade7_14 = parseInt(document.querySelector('#idade7_14').value);
            var idade15_17 = parseInt(document.querySelector('#idade15_17').value);
            var idade18_29 = parseInt(document.querySelector('#idade18_29').value);
            var idade30_59 = parseInt(document.querySelector('#idade30_59').value);
            var idade60OuMais = parseInt(document.querySelector('#idade60ouMais').value);
            var naoInformadoIdade = parseInt(document.querySelector('#naoInformadoIdade').value);

            idade0_6 = isNaN(idade0_6) ? 0 : idade0_6;
            idade7_14 = isNaN(idade7_14) ? 0 : idade7_14;
            idade15_17 = isNaN(idade15_17) ? 0 : idade15_17;
            idade18_29 = isNaN(idade18_29) ? 0 : idade18_29;
            idade30_59 = isNaN(idade30_59) ? 0 : idade30_59;
            idade60OuMais = isNaN(idade60OuMais) ? 0 : idade60OuMais;
            naoInformadoIdade = isNaN(naoInformadoIdade) ? 0 : naoInformadoIdade;

            //Cor/Raça
            var amarela = parseInt(document.querySelector('#amarela').value);
            var branca = parseInt(document.querySelector('#branca').value);
            var indigena = parseInt(document.querySelector('#indigena').value);
            var parda = parseInt(document.querySelector('#parda').value);
            var preta = parseInt(document.querySelector('#preta').value);
            var naoInformadoCor = parseInt(document.querySelector('#naoInformadoCor').value);

            amarela = isNaN(amarela) ? 0 : amarela;
            branca = isNaN(branca) ? 0 : branca;
            indigena = isNaN(indigena) ? 0 : indigena;
            parda = isNaN(parda) ? 0 : parda;
            preta = isNaN(preta) ? 0 : preta;
            naoInformadoCor = isNaN(naoInformadoCor) ? 0 : naoInformadoCor;

            //Pessoas com deficiência
            var visual = parseInt(document.querySelector('#visual').value);
            var auditiva = parseInt(document.querySelector('#auditiva').value);
            var motora = parseInt(document.querySelector('#motora').value);
            var mental = parseInt(document.querySelector('#mental').value);

            visual = isNaN(visual) ? 0 : visual;
            auditiva = isNaN(auditiva) ? 0 : auditiva;
            motora = isNaN(motora) ? 0 : motora;
            mental = isNaN(mental) ? 0 : mental;


            //Calculo
            var total = fundamental + medio + superior +naoInformadoEscola;
            total = total + feminino +  masculino + naoInformadoSexo;
            total = total + idade0_6 + idade7_14 + idade15_17 + idade18_29 + idade30_59 + idade60OuMais + naoInformadoIdade;
            total = total + amarela + branca + indigena + parda + preta + naoInformadoCor;
            total = total + visual + auditiva + motora + mental;

            var txtTotal = document.getElementById('total');

            txtTotal.value = String(total);
        }

        window.onload = caculoTotal();
    </script>

    <script type="text/javascript">

    </script>

@endsection

@section('scripts_adicionais')
    {{--    <script src="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>--}}
    @include('scripts.tabelas_admin')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $( ".calendario" ).datepicker({
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
            });
            $('.calendario').datepicker("option","showAnim","blind");
            $('.calendario').datepicker( "option", "dateFormat", "dd/mm/yy");
        });
    </script>
@endsection
@section('linksAdicionais')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection