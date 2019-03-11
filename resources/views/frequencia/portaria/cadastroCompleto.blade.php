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
                                    Escolaridade
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="fundamental">Fundamental</label>
                                <input type="number" class="form-control" name="fundamental" id="fundamental" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="medio">Médio</label>
                                <input type="number" class="form-control" name="medio" id="medio" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="fundamental">Superior</label>
                                <input type="number" class="form-control" name="superior" id="superior" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="naoInformadoEscolaridade">Não Informado</label>
                                <input type="number" class="form-control" name="naoInformadoEscolaridade" id="naoInformadoEscolaridade" onblur="caculoTotal()" onkeyup="caculoTotal()">
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
                                <label for="0_6Anos">0-6 Anos</label>
                                <input type="number" class="form-control" name="0_6Anos" id="idade0_6" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="7_14Anos">7-14 Anos</label>
                                <input type="number" class="form-control" name="7_14Anos" id="idade7_14" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="14_17Anos">15-17 Anos</label>
                                <input type="number" class="form-control" name="14_17Anos" id="idade15_17" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="18_29Anos">18-29 Anos</label>
                                <input type="number" class="form-control" name="18_29Anos" id="idade18_29" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="30_59Anos">30-59 Anos</label>
                                <input type="number" class="form-control" name="30_59Anos" id="idade30_59" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="60ouMais">60 ou mais</label>
                                <input type="number" class="form-control" name="60ouMais" id="idade60ouMais" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="naoInformadoIdade">Não Informado</label>
                                <input type="number" class="form-control" name="naoInformadoIdade" id="naoInformadoIdade" onblur="caculoTotal()" onkeyup="caculoTotal()">
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
                                <input type="number" class="form-control" name="amarela" id="amarela" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="branca">Branca</label>
                                <input type="number" class="form-control" name="branca" id="branca" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="indigena">Indígena</label>
                                <input type="number" class="form-control" name="indigena" id="indigena" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="parda">Parda</label>
                                <input type="number" class="form-control" name="parda" id="parda" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="preta">Preta</label>
                                <input type="number" class="form-control" name="preta" id="preta" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="naoInformadoCor">Não Informado</label>
                                <input type="number" class="form-control" name="naoInformadoCor" id="naoInformadoCor" onblur="caculoTotal()" onkeyup="caculoTotal()">
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
                                <input type="number" class="form-control" name="feminino" id="feminino" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="masculino">Masculino</label>
                                <input type="number" class="form-control" name="masculino" id="masculino" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="naoInformadoSexo">Não Informado</label>
                                <input type="number" class="form-control" name="naoInformadoSexo" id="naoInformadoSexo" onblur="caculoTotal()" onkeyup="caculoTotal()">
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
                            <div class="form-group col-md-4">
                                <label for="visual">Visual</label>
                                <input type="number" class="form-control" name="visual" id="visual" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="auditiva">Auditiva</label>
                                <input type="number" class="form-control" name="auditiva" id="auditiva" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="motora">Motora</label>
                                <input type="number" class="form-control" name="motora" id="motora" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="mental">Mental</label>
                                <input type="number" class="form-control" name="mental" id="mental" onblur="caculoTotal()" onkeyup="caculoTotal()">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4 col-md-offset-4">
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
