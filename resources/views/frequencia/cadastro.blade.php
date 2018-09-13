@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-6 col-lg-offset-3">
        <h1>
            <i class="glyphicon glyphicon-user"></i> Eventos Culturais <br>
            <small>{{$equipamento->nome}}</small>
        </h1>
        <hr>

        <form method="POST" action="{{route('frequencia.gravar', $equipamento->id)}}">
            {{ csrf_field() }}

            {{--TODO: Alterar Evento para combobox--}}
            <div class="row">
                <div class="form-group col-md-12">
                    <div class="form-group">
                        <label for="evento">Evento</label>
                        <div class="row">
                            <div class="form-inline col-md-10">
                                <input class="form-control" type="text" name="evento" value="{{old('evento')}}">
                                <input class="btn btn-info form-control" id="pesquisar" type="button" value="Pesquisar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group ">
                <label for="nomeEvento">Nome Evento</label>
                <input class="form-control" type="text" name="nomeEvento" disabled>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <div class="form-group ">
                        <label for="email">Data</label>
                        <input class="form-control" type="date" name="data" value="{{old('data')}}">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group ">
                        <label for="login">Hora</label>
                        <input class="form-control" type="text" data-mask="00:00" name="hora" id="hora" placeholder="Digite a hora" value="{{old('hora')}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                     <div class="form-group ">
                        <label for="email">Criança</label>
                        <input class="form-control" type="number" min="0" max="9999" id="crianca" name="crianca" value="{{old('crianca')}}" onblur="calcular()" onkeyup="calcular()">
                    </div>
                </div>
                <div class="form-group col-md-3">
                     <div class="form-group ">
                        <label for="jovem">Jovem</label>
                        <input class="form-control" type="number" min="0" max="9999" id="jovem" name="jovem" value="{{old('jovem')}}" onblur="calcular()" onkeyup="calcular()">
                    </div>
                </div>
                <div class="form-group col-md-3">
                     <div class="form-group ">
                        <label for="adulto">Adulto</label>
                <input class="form-control" type="number" id="adulto" min="0" max="9999" name="adulto" value="{{old('adulto')}}" onblur="calcular()" onkeyup="calcular()">
                    </div>
                </div>
                <div class="form-group col-md-3">
                     <div class="form-group ">
                        <label for="idoso">Idoso</label>
                        <input class="form-control" type="number" min="0" max="9999" id="idoso" name="idoso" value="{{old('idoso')}}" onblur="calcular()" onkeyup="calcular()">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="publicoTotal">Publico Total: </label>
                <input type="text" class="form-control" readonly min="0" max="9999" name="total" id="publicoTotal" onload="calcular()">
            </div>

            <div class="form-group ">
                <label for="observacao">Observação</label>
                <input class="form-control" type="text" name="observacao" value="{{old('observacao')}}">
            </div>
        </form>

            {{--TODO: Alterar para input quando funcionamento estiver OK--}}
            <button class="btn btn-success" >Cadastrar</button>

    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
        function calcular() {
            var crianca = parseInt(document.getElementById('crianca').value, 10);
            var jovem = parseInt(document.getElementById('jovem').value, 10);
            var adulto = parseInt(document.getElementById('adulto').value, 10);
            var idoso = parseInt(document.getElementById('idoso').value, 10);

            crianca = isNaN(crianca) ? 0 : crianca;
            jovem = isNaN(jovem) ? 0 : jovem;
            adulto = isNaN(adulto) ? 0 : adulto;
            idoso = isNaN(idoso) ? 0 : idoso;

            var calcula = crianca + jovem + adulto + idoso;
            var publico = document.getElementById("publicoTotal");

            publico.value = String(calcula);
        }

        window.onload = calcular();

    </script>

    <script type="text/javascript">
      let botao = document.querySelector('#pesquisar');

        botao.addEventListener('click', () => {
            let idEvento = document.querySelector('input[name="evento"]').value;
            console.log(idEvento);
            fetch(`http://smcsistemas.prefeitura.sp.gov.br/igsis/funcoes/api_simbi.php?id=${idEvento}`).then(resposta => {
                console.log(resposta);
                return resposta.json();
            }).then(dados => {
                if(dados){
                    let obj = JSON.stringify(dados)
                    console.log(`${JSON.stringify(dados)}`);

                    let percorrer = JSON.parse(obj)
                    console.log(percorrer);
                    console.log(percorrer['idEvento']);
                    console.log(percorrer['nomeEvento']);
                    console.log(percorrer['projeto']);

                    document.querySelector('input[name="nomeEvento"]').value = percorrer['nomeEvento'];

                    console.log("Deu certo");
                }
                else{
                    // alterarCadastro(cadastro);
                    // console.log(" Não Encontrado");

                    document.querySelector('input[name="nomeEvento"]').value = 'Não Encontrado';

                }
            });

        });
    </script>

@endsection
