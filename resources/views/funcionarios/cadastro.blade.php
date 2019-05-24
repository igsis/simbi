@extends('layouts.master2')

@section('titulo', 'Cadastrar Funcionário')

@section('conteudo')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-header"><i class="fa fa-address-book-o"></i> Cadastrar Funcionário</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="form-group col-md-6 has-feedback {{ $errors->has('escolaridade') ? ' has-error' : '' }}">
            <label for="escolaridade">Nivel de Escolaridade</label>
            <select class="form-control" name="escolaridade" id="escolaridade">
                <option value="">Selecione uma Opção</option>
                @foreach ($escolaridades as $escolaridade)
                    @if ($escolaridade->id == old('escolaridade') || $escolaridade->id == $user->escolaridade_id)
                        <option value="{{$escolaridade->id}}"
                                selected>{{$escolaridade->escolaridade}}</option>
                    @else
                        <option value="{{$escolaridade->id}}">{{$escolaridade->escolaridade}}</option>
                    @endif
                @endforeach
            </select>
        </div>

        @include('layouts.modal', ['idModal' => 'addCargo', 'titulo' => 'Adicionar novo Cargo', 'idInput' => 'novoCargo', 'funcaoJS' => 'insertCargo'])
        @include('layouts.modal', ['idModal' => 'addFuncao', 'titulo' => 'Adicionar nova Função', 'idInput' => 'novaFuncao', 'funcaoJS' => 'insertFuncao'])
        @include('layouts.modal', ['idModal' => 'addSubAdm', 'titulo' => 'Adicionar nova Sub. Administrativa', 'idInput' => 'novaSubAdm', 'funcaoJS' => 'insertSubAdm'])

        <div class="modal fade" id="addSecretaria" role="dialog" aria-labelledby="addSecretariaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Adicionar nova Secretaria</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Sigla:</label>
                            <input class="form-control" type="text" name="secretariaSigla" id="secretariaSigla" maxlength="6">
                        </div>
                        <div class="form-group">
                            <label>Descrição:</label>
                            <input class="form-control" type="text" name="secretariaDescricao" id="secretariaDescricao">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success" onclick="insertSecretaria();">Adicionar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts_adicionais')
    <script>
        function insertCargo()
        {
            let select = document.getElementById("cargo"),
                div = document.getElementById("divCargo"),
                i = {{$cargos->count()}},
                txtVal = document.getElementById("novoCargo").value,
                newOption = document.createElement("OPTION"),
                newInput = document.createElement("INPUT"),
                newOptionVal = document.createTextNode(txtVal);

            if (txtVal !== "")
            {
                newOption.appendChild(newOptionVal);
                newOption.setAttribute("value", `${i + 1}`);
                select.insertBefore(newOption, select.lastChild);
                newOption.setAttribute('selected', 'selected');

                newInput.setAttribute("type", "hidden");
                newInput.setAttribute("name", "novoCargo");
                newInput.setAttribute("value", newOptionVal.textContent);
                div.insertBefore(newInput, div.lastChild);
            }
            $('#addCargo').modal('hide');
            $("input[id='novoCargo']").val('');
        }

        function insertFuncao()
        {
            let select = document.getElementById("funcao"),
                div = document.getElementById("divFuncao"),
                i = {{$funcoes->count()}},
                txtVal = document.getElementById("novaFuncao").value,
                newOption = document.createElement("OPTION"),
                newInput = document.createElement("INPUT"),
                newOptionVal = document.createTextNode(txtVal);

            if (txtVal !== "")
            {
                newOption.appendChild(newOptionVal);
                newOption.setAttribute("value", `${i + 1}`);
                select.insertBefore(newOption, select.lastChild);
                newOption.setAttribute('selected', 'selected');

                newInput.setAttribute("type", "hidden");
                newInput.setAttribute("name", "novaFuncao");
                newInput.setAttribute("value", newOptionVal.textContent);
                div.insertBefore(newInput, div.lastChild);
            }
            $('#addFuncao').modal('hide');
            $("input[id='novoCargo']").val('');
        }

        function insertSubAdm()
        {
            let select = document.getElementById("subordinacaoAdministrativa"),
                div = document.getElementById("divSubAdm"),
                i = {{$subordinacoesAdministrativas->count()}},
                txtVal = document.getElementById("novaSubAdm").value,
                newOption = document.createElement("OPTION"),
                newInput = document.createElement("INPUT"),
                newOptionVal = document.createTextNode(txtVal);

            if (txtVal !== "")
            {
                newOption.appendChild(newOptionVal);
                newOption.setAttribute("value", `${i + 1}`);
                select.insertBefore(newOption, select.lastChild);
                newOption.setAttribute('selected', 'selected');

                newInput.setAttribute("type", "hidden");
                newInput.setAttribute("name", "novaSubAdm");
                newInput.setAttribute("value", newOptionVal.textContent);
                div.insertBefore(newInput, div.lastChild);
            }
            $('#addSubAdm').modal('hide');
            $("input[id='novaSubAdm']").val('');
        }

        function insertSecretaria()
        {
            let select = document.getElementById("identificacaoSecretaria"),
                div = document.getElementById("divSecretaria"),
                i = {{$secretarias->count()}},
                txtVal = document.getElementById("secretariaSigla").value,
                txtVal2 = document.getElementById("secretariaDescricao").value,
                newOption = document.createElement("OPTION"),
                newInput = document.createElement("INPUT"),
                newInput2 = document.createElement("INPUT"),
                newOptionVal = document.createTextNode(txtVal),
                newOptionVal2 = document.createTextNode(txtVal2);

            if (txtVal !== "")
            {
                newOption.appendChild(newOptionVal);
                newOption.setAttribute("value", `${i + 1}`);
                select.insertBefore(newOption, select.lastChild);
                newOption.setAttribute('selected', 'selected');

                newInput.setAttribute("type", "hidden");
                newInput.setAttribute("name", "descricaoSecretaria");
                newInput.setAttribute("value", newOptionVal.textContent);
                div.insertBefore(newInput, div.lastChild);

                newInput2.setAttribute("type", "hidden");
                newInput2.setAttribute("name", "siglaSecretaria");
                newInput2.setAttribute("value", newOptionVal2.textContent);
                div.insertBefore(newInput2, div.lastChild);
            }
            $('#addSecretaria').modal('hide');
            $("input[id='novaSecretaria']").val('');
        }
    </script>
@endsection