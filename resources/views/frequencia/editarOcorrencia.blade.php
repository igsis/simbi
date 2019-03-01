@include('layouts.br')
@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Eventos Culturais')

@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> Editar evento</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $evento->nome_evento }}</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{route('frequencia.updateOcorrencia', $ocorrencia->id)}}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="tipoEvento">Categoria do Evento</label>
                            <input type="text" readonly class="form-control" value="{{ $evento->tipoEvento->tipo_evento }}">
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="form-group ">
                                    <label for="email">Data</label>
                                    <input class="form-control" type="date" name="data" value="{{$ocorrencia->data}}" onblur="arrumaData()">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group ">
                                    <label for="login">Hora</label>
                                    <input class="form-control" type="text" data-mask="00:00" name="hora" id="hora" placeholder="Digite a hora" value="{{$ocorrencia->horario}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="diaSemana">Dia da semana</label>
                                <input type="text" readonly class="form-control" name="diaSemana" id="diaSemana" value="{{ ucwords(strftime('%A', strtotime($ocorrencia->data))) }}">
                            </div>
                        </div>

                        <button class="btn btn-success" >Atualizar</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
        function arrumaData() {
            var data = document.querySelector('input[name="data"]').value;

            data = new Date(data);

            dayName = new Array ("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado", "Domingo");

            document.querySelector('input[name="diaSemana"').value = dayName[data.getDay() + 1];
        }
    </script>

    <script type="text/javascript">
        // let botao = document.querySelector('#pesquisar');
        //
        // botao.addEventListener('click', () => {
        //     let idEvento = document.querySelector('input[name="evento"]').value;
        //     console.log(idEvento);
        //     fetch(`http://smcsistemas.prefeitura.sp.gov.br/igsis/funcoes/api_simbi.php?id=${idEvento}`).then(resposta => {
        //         console.log(resposta);
        //         return resposta.json();
        //     }).then(dados => {
        //         if(dados){
        //             let obj = JSON.stringify(dados)
        //             console.log(`${JSON.stringify(dados)}`);
        //
        //             let percorrer = JSON.parse(obj)
        //             console.log(percorrer);
        //             console.log(percorrer['idEvento']);
        //             console.log(percorrer['nomeEvento']);
        //             console.log(percorrer['projeto']);
        //
        //             document.querySelector('input[name="nomeEvento"]').value = percorrer['nomeEvento'];
        //
        //             console.log("Deu certo");
        //         }
        //         else{
        //             // alterarCadastro(cadastro);
        //             // console.log(" Não Encontrado");
        //
        //             document.querySelector('input[name="nomeEvento"]').value = 'Não Encontrado';
        //
        //         }
        //     });
        //
        // });
    </script>

@endsection
