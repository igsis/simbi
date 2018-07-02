<!-- Adicionar Serviço -->
  <div class="modal fade" id="addServico" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Adicionar novo Serviço?</h4>
        </div>
        <div class="modal-body">
          <form method="POST" id="addServico" action="{{route('equipamentos.index')}}">
            {{csrf_field()}}
            <label>Descrição</label>
            <input class="form-control" type="text" name="descricao">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <input type="submit" class="btn btn-success" name="novoServico" value="Adicionar">
        </div>
          </form>
      </div>
    </div>
  </div>

<!-- Adicionar Sigla -->
  <div class="modal fade" id="addSigla" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         <h4 class="modal-title">Adicionar Nova Sigla?</h4>
       </div>
       <div class="modal-body">
         <form method="POST" id="addSigla" action="{{route('equipamentos.index')}}">
           {{csrf_field()}}
           <div class="form-group">
             <label>Sigla</label>
             <input class="form-control" type="text" name="sigla">
           </div>
           <div class="form-group">
             <label>Descrição</label>
             <input class="form-control" type="text" name="descricao">
           </div>
           <div class="form-group">
             <label>Roteiro</label>
             <input class="form-control" type="text" name="roteiro">
           </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
         <input type="submit" class="btn btn-success" name="novaSigla" value="Adicionar">
       </div>
         </form>
     </div>
   </div>
  </div>

<!-- Adicionar Secretaria -->
  <div class="modal fade" id="addSecretaria" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         <h4 class="modal-title">Adicionar nova Secretaria?</h4>
       </div>
       <div class="modal-body">
         <form method="POST" id="addSecretaria" action="{{route('equipamentos.index')}}">
           {{csrf_field()}}
           <div class="form-group">
             <label>Sigla</label>
             <input class="form-control" type="text" name="sigla">
           </div>
           <div class="form-group">
             <label for="descricao">Descrição</label>
             <input class="form-control" type="text" name="descricao">
           </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
         <input type="submit" class="btn btn-success" name="novaSecretaria" value="Adicionar">
       </div>
         </form>
     </div>
   </div>
  </div>

<!-- Adicionar Sub. Administrativa -->
   <div class="modal fade" id="addSubAdmin" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Adicionar nova Sub. Administrativa?</h4>
        </div>
        <div class="modal-body">
          <form method="POST" id="addSubAdmin" action="{{route('equipamentos.index')}}">
            {{csrf_field()}}
            <label>Descrição</label>
            <input class="form-control" type="text" name="descricao">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <input type="submit" class="btn btn-success" name="novaSubordinacaoAdministrativa" value="Adicionar">
        </div>
          </form>
      </div>
    </div>
  </div>

<!-- Adicionar Prefeitura Regional -->
    <div class="modal fade" id="addPrefeituraRegional" role="dialog" aria-labelledby="addPrefeituraRegionalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Adicionar nova Prefeitura Regional?</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" id="addPrefeituraRegional" action="{{route('equipamentos.index')}}">
                        {{csrf_field()}}
                        <label>Descrição</label>
                        <input class="form-control" type="text" name="descricao">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-success" name="novaPrefeituraRegional" value="Adicionar">
                </div>
                </form>
            </div>
        </div>
    </div>

<!-- Adicionar Distrito -->
    <div class="modal fade" id="addDistrito" role="dialog" aria-labelledby="addDistritoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Adicionar novo Distrito?</h4>
                </div>
                <div class="modal-body">
                  <form method="POST" id="addDistrito" action="{{route('equipamentos.index')}}">
                        {{csrf_field()}}
                        <label>Descrição</label>
                        <input class="form-control" type="text" name="descricao">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-success" name="novoDistrito" value="Adicionar">
                </div>
                </form>
            </div>
        </div>
    </div>