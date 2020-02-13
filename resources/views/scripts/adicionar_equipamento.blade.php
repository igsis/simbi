<script>
    (function (win, doc) {
        'use strict';
        let mainVinculo = doc.querySelector('.vinculos');
        function createVinculo() {
            let vinculo = doc.createElement('div');
            vinculo.className = 'vinculo';
            vinculo.innerHTML =     '            <div class="row">\n' +
                '                <div class="form-group col-md-6 has-feedback">\n' +
                '                    <label for="cargo">Biblioteca</label>\n' +
                '                    <select class="form-control" name="equipamento[]" id="">\n' +
                '                        <option value="">Selecione...</option>\n' +
                '                        @foreach ($equipamentos as $equipamento)\n' +
                '                            @if($equipamento->publicado == 1)\n' +
                '                                @if ($equipamento->id == old('equipamento[]'))\n' +
                '                                    <option value="{{$equipamento->id}}" selected>{{$equipamento->nome}}</option>\n' +
                '                                @else\n' +
                '                                    <option value="{{$equipamento->id}}">{{$equipamento->nome}}</option>\n' +
                '                                @endif\n' +
                '                            @endif\n' +
                '                        @endforeach\n' +
                '                    </select>\n' +
                '                </div>\n' +

                '                <div class="form-group col-md-4">\n' +
                '                    <label for="responsabilidadeTipo">Responsabilidade:</label>\n' +
                '                    <select class="form-control" name="responsabilidadeTipo[]" id="cargo">\n' +
                '                        <option value="">Selecione...</option>\n' +
                '                        @foreach($cargos as $cargo)\n' +
                '                            <option value="{{$cargo->id}}">{{$cargo->responsabilidade_tipo}}</option>\n' +
                '                        @endforeach\n' +
                '                     </select>\n' +
                '                 </div>\n' +

                '       <div class="form-group col-md-2">\n' +
                '           <br>  \n' +
                '           <a class="btn btn-danger col-md-12" id="remover" onclick="remover(this)">Remover <i class="fa fa-trash-o"></i></a> \n' +
                '       </div>\n' +
                '</div>';
            mainVinculo.appendChild(vinculo);
        }

        let $btnAdd = doc.querySelector('#addInput');
        $btnAdd.addEventListener('click', createVinculo ,false);

        // btnAdd.onclick = createHour;

    })(window, document);
</script>