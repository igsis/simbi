{{--Como declarar:
@include('scripts.duplicar_div', ['divpai' => 'id da div desejada'])--}}

{{--<script type="text/javascript" >--}}
{{--    $('#addInput').on('click', function(e) {--}}
{{--        let i = $('{{$divpai}}').length;--}}
{{--        $('{{$divpai}}').first().clone().find("input").attr('name', function(idx, attrVal) {--}}
{{--            return attrVal.replace('[0]','')+'['+i+']';--}}
{{--        }).removeAttr('checked').end().find("input[type=text]").val('').end().insertBefore('.botoes');--}}
{{--    });--}}

{{--    $('#remInput').on('click', function(e) {--}}
{{--        let i = $('{{$divpai}}').length;--}}
{{--        if (i > 1){--}}
{{--            $('{{$divpai}}').last().remove();--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
<script>
    (function (win, doc) {
        'use strict';
        let $btnRemove = [];
        let mainHorarios = doc.querySelector('.horarios');
        function createHour() {
            let horario = doc.createElement('div');
            horario.className = 'horario';
            horario.innerHTML = '<div class="row">\n' +
                '                                    <hr>\n' +
                '                                    <div class="form-group">\n' +
                '                                        <div class="col-md-offset-3 col-md-8" style="padding-bottom: 15px">\n' +
                '                                            <input type="hidden" name="funcionamento[]">\n' +
                '                                            <input type="checkbox" name="domingo[]" value="1"/><label for="diasemana07"\n' +
                '                                                                                                       style="padding:0 10px 0 5px;">\n' +
                '                                                Domingo</label>\n' +
                '                                            <input type="checkbox" name="segunda[]" value="1"/><label for="diasemana01"\n' +
                '                                                                                                       style="padding:0 10px 0 5px;">\n' +
                '                                                Segunda</label>\n' +
                '                                            <input type="checkbox" name="terca[]" value="1"/><label for="diasemana02"\n' +
                '                                                                                                     style="padding:0 10px 0 5px;">\n' +
                '                                                Terça</label>\n' +
                '                                            <input type="checkbox" name="quarta[]" value="1"/><label for="diasemana03"\n' +
                '                                                                                                      style="padding:0 10px 0 5px;">\n' +
                '                                                Quarta</label>\n' +
                '                                            <input type="checkbox" name="quinta[]" value="1"/><label for="diasemana04"\n' +
                '                                                                                                      style="padding:0 10px 0 5px;">\n' +
                '                                                Quinta</label>\n' +
                '                                            <input type="checkbox" name="sexta[]" value="1"/><label for="diasemana05"\n' +
                '                                                                                                     style="padding:0 10px 0 5px;">\n' +
                '                                                Sexta</label>\n' +
                '                                            <input type="checkbox" name="sabado[]" value="1"/><label for="diasemana06"\n' +
                '                                                                                                      style="padding:0 10px 0 5px;">\n' +
                '                                                Sábado</label>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '\n' +
                '                                <div class="row">\n' +
                '                                    <div class="form-group col-md-offset-4 col-md-2">\n' +
                '                                        <label for="horarioAbertura">Horário de Abertura</label>\n' +
                '                                        <input type="text" class="form-control" name="horarioAbertura[]"\n' +
                '                                               id="horarioAbertura" data-mask="00:00" required>\n' +
                '                                    </div>\n' +
                '                                    <div class="form-group col-md-2">\n' +
                '                                        <label for="horarioFechamento">Horário de Fechamento</label>\n' +
                '                                        <input type="text" class="form-control" name="horarioFechamento[]"\n' +
                '                                               id="horarioFechamento" data-mask="00:00" required>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            <a class="row">\n' +
                '                               <a class="btn btn-danger col-md-6 col-md-offset-3 btnRemove">Remover</a>\n' +
                '                            </div>';
            mainHorarios.appendChild(horario);

             $btnRemove = doc.querySelectorAll('.btnRemove');

             for( let x of $btnRemove){
                 x.addEventListener('click',removeHourn)
             }
        }

        function removeHourn(btn){
            btn.preventDefault();
            let getHorario = this.parentNode;
            getHorario.parentNode.removeChild(getHorario);
        }

        let $btnAdd = doc.querySelector('#addInput');
        $btnAdd.addEventListener('click', createHour ,false);


         // btnAdd.onclick = createHour;

    })(window, document);
</script>