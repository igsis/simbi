<!-- Adicionar Serviço -->
  <div class="modal fade" id="addServico" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Adicionar novo Serviço?</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('equipamentos.cadastro')}}">
            {{csrf_field()}}
            <label>Descrição</label>
            <input class="form-control" type="text" name="descricao">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="confirm">Adicionar</button>
        </div>
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
          <form method="POST" action="{{route('equipamentos.cadastro')}}">
            {{csrf_field()}}
            <label>Descrição</label>
            <input class="form-control" type="text" name="descricao">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="confirm">Adicionar</button>
        </div>
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
          <form method="POST" action="{{route('equipamentos.cadastro')}}">
            {{csrf_field()}}
            <label>Descrição</label>
            <input class="form-control" type="text" name="descricao">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="confirm">Adicionar</button>
        </div>
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
          <form method="POST" action="{{route('equipamentos.cadastro')}}">
            {{csrf_field()}}
            <label>Descrição</label>
            <input class="form-control" type="text" name="descricao">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="confirm">Adicionar</button>
        </div>
      </div>
    </div>
  </div>