<div class="modal fade" id="SecaoBraile" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> Cadastro de Público Seção Braile</h4>
         </div>
         <!-- inicio do form -->
         <form id="formBraile" action="{{route('frequencia.secaoBraile.gravar')}}"
               method="post" autocomplete="off">
            <div class="modal-body">
               {{ csrf_field() }}
               <div class="row">
                  <div class="form-group col-md-5" >
                     <label for="data">Data</label>
                     <input type="text" 
                     class="form-control" 
                     id="calendarioBraile" name="data" autocomplete="off" maxlength="10">
                  </div>

                  <div class="form-group col-md-7">
                     <label for="nome">Quantidade</label>
                     <input type="number" class="form-control" id="quantidade" name="quantidade"
                            value="">
                  </div>
                  <!--<div class="form-group col-md-6" >
                     <label for="data">Período</label> <br>
                     <input type="radio" name="periodo" value="1"> Segunda à Sexta &nbsp;&nbsp;
                     <input type="radio" name="periodo" value="2"> Sábado &nbsp;&nbsp;
                     <input type="radio" name="periodo" value="3"> Domingo
                  </div>-->
               </div>
               <input type="hidden" name="equipamento_id" id="idEquipamentoSecaoBraile" value="">
               <input type="hidden" name="idPublico" id="idPublico" value="">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               <input class="btn btn-success" id="submitForm" type="submit" value="Cadastrar">
            </div>
         </form>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
   $(function () {
       let data = new Date();
       $('#calendarioBraile').datepicker("option", "showAnim", "blind");
       $("#calendarioBraile").datepicker({
   
           dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
           dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
           dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
           monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
           monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
       });
       $('#calendarioBraile').datepicker("option", "dateFormat", "dd/mm/yy");
   });
   
</script>