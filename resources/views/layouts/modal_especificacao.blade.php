<div class="modal fade" id="{{$idModal}}" role="dialog" aria-labelledby="{{$idModal}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{$titulo}}</h4>
            </div>
            @if(isset( $actionForm ))
                <form action="{{route($actionForm,$equipamentoId)}}" method="POST">
                    {{csrf_field()}}
            @endif
            <div class="modal-body">
                <label>{{isset($label)?$label:'Adicionar novo'}}</label>
                <input class="form-control" type="text" name="novo" id="{{$idInput}}" required>
                <br>
                <label>Especificações</label>
                <input class="form-control" type="text" name="especificacao">
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                @if(isset($actionForm))
                        <button class="btn btn-success" type="submit">Adicionar</button>
                    </form>
                @else
                    <button class="btn btn-success" onclick="{{$funcaoJS}}(); arrumar();">Adicionar</button>
                @endif
            </div>
        </div>
    </div>
</div>