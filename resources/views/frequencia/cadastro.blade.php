@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-6 col-lg-offset-3">
        <h1>
            <i class="glyphicon glyphicon-pushpin"></i> Eventos Culturais <br>
            <small>{{ $evento->nome_evento }}</small>
        </h1>
        <hr>

        <form method="POST" action="{{route('frequencia.gravar', $equipamento->id)}}">
            {{ csrf_field() }}

            <div class="hidden">
                <div class="form-group">
                    <label for="evento_ocorrencia_id">Id da ocorrencia</label>
                    <input class="form-control" type="text" id="evento_ocorrencia_id" name="evento_ocorrencia_id" value="{{$ocorrencia->id}}">
                </div>
            </div>

            <div class="form-group">
                <label for="tipoEvento">Categoria do Evento</label>
                <input type="text" readonly class="form-control" value="{{ $evento->tipoEvento->tipo_evento }}">
            </div>

            <div class="form-group">
                <label for="tipoEvento">Projeto Especial</label>
                <input type="text" readonly class="form-control" value="{{ $evento->projetoEspecial->projeto_especial }}">
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

            <button class="btn btn-success"> Cadastrar</button>
        </form>


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

    </script>

@endsection
