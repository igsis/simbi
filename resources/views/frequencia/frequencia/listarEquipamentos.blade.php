@extends('layouts.master2')
@section('linksAdicionais')
@includeIf('links.tabelas_AdminLTE')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('titulo','Equipamentos')
@section('conteudo')
<div class="content-wrapper">
   <div class="row">
      <div class="col-xs-12">
         @includeIf('layouts.erros')
      </div>
   </div>
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1 class="page-header">
         <i class="fa fa-users"></i>
         @if($type == 1)
         Público em Equipamentos
         @elseif($type == 2)
         Ocorrência de Eventos em Equipamentos
         @elseif($type == 3)
         Público de Recepção em Equipamentos
         @elseif($type == 4)
            Seção Braile
         @elseif($type == 5)
            Telecentro/Diglab
         @elseif($type == 6)
            Temática
         @elseif($type == 7)
            Óculos
         @endif
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- Default box -->
      <div class="box box-primary">
         <div class="box-header with-border">
            <h3 class="box-title">Lista de Equipamentos</h3>
         </div>
         <div class="box-body">
            <div class="table-responsive">
               <table id="tabela1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Nome do Equipamento</th>
                        <th>Operações</th>
                     </tr>
                  </thead>
                  <tbody>
                  @if ($equipamentos->count() != 0)
                     @foreach($equipamentos as $equipamento)
                        <tr>
                           <th width="40%">{{$equipamento->nome}}</td>
                           <td>
                              @if($type == 1)
                                 <a href="{{ route('frequencia.ocorrencias', [$equipamento->id,1]) }}"
                                    class="btn bg-navy" style="margin-right: 3px"><i class="glyphicon glyphicon-eye-open"></i> &nbsp;
                                    Publico de Evento</a>
                                 @if($equipamento->portaria == 0)
                                    <button type="button" data-toggle="modal"
                                            data-target="#cadastroPortariaSimples"
                                            data-title="Cadastro de Portaria"
                                            class="btn bg-light-blue" style="margin-right: 3px"
                                            onclick="setarIdEquipamento({{ $equipamento->id }}, 'idEquipamento')"> <i
                                               class="glyphicon glyphicon-eye-open"></i> &nbsp; Público de Recepção
                                    </button>
                                    <button type="button"
                                            data-toggle="modal"
                                            data-target="#SecaoBraile"
                                            data-title="Cadastro de Braile"
                                            class="btn btn-success"
                                            style="margin-right: 3px"
                                            onclick="setarIdEquipamento({{ $equipamento->id }}, 'idEquipamentoSecaoBraile')">
                                       <i class="glyphicon glyphicon-eye-open"></i> &nbsp; Seção Braile
                                    </button>
                                    <button type="button"
                                            data-toggle="modal"
                                            data-target="#telecentro"
                                            data-title="Cadastro de Telecentro"
                                            class="btn btn-warning"
                                            style="margin-right: 3px"
                                            onclick="setarIdEquipamento({{ $equipamento->id }}, 'idEquipamentoTelecentro')">
                                       <i class="glyphicon glyphicon-eye-open"></i> &nbsp; TeleCentro
                                    </button>
                                    <button type="button"
                                            data-toggle="modal"
                                            data-target="#tematica"
                                            data-title="Cadastro de Temática"
                                            class="btn btn-info"
                                            style="margin-right: 3px"
                                            onclick="setarIdEquipamento({{ $equipamento->id }}, 'idEquipamentoTematica')">
                                       <i class="glyphicon glyphicon-eye-open"></i> &nbsp; Temática
                                    </button>
                                    <button type="button"
                                            data-toggle="modal"
                                            data-target="#oculos"
                                            data-title="Cadastro de Oculos"
                                            class="btn btn-danger"
                                            style="margin-right: 3px"
                                            onclick="setarIdEquipamento({{ $equipamento->id }}, 'idEquipamentoOculos')">
                                       <i class="glyphicon glyphicon-eye-open"></i> &nbsp; Óculos
                                    </button>
                                 @else
                                    <a href="{{ route('frequencia.portaria.cadastroCompleto',$equipamento->id) }}"
                                       class="btn bg-light-blue" style="margin-right: 3px"><i
                                               class="glyphicon glyphicon-eye-open"></i> &nbsp; Público de Recepção</a>
                                 @endif

                              @elseif($type == 2)
                                 <a href="{{ route('frequencia.ocorrenciasEnviadas', [$equipamento->id,2]) }}"
                                    class="btn bg-navy" style="margin-right: 3px"><i class="glyphicon glyphicon-eye-open"></i> &nbsp;
                                    Ocorrência de Evento
                                 </a>

                              @elseif($type == 3)
                                 <a href="{{ route('frequencia.portaria.listar', $equipamento->id) }}"
                                    class="btn btn-info pull-right" style="margin-right: 3px"><i class="fa fa-users"></i> &nbsp;
                                    Público de Recepção
                                 </a>

                              @elseif($type == 4)
                                 <a href="{{ route('frequencia.portaria.secaoBraile', $equipamento->id) }}"
                                    class="btn btn-success" style="margin-right: 3px"><i class="fa fa-users"></i> &nbsp;
                                    Seção Braile
                                 </a>

                              @elseif($type == 5)
                                 <a href="{{ route('frequencia.portaria.telecentro', $equipamento->id) }}"
                                    class="btn btn-warning" style="margin-right: 3px"><i class="fa fa-users"></i> &nbsp;
                                    Telecentro/DigLab
                                 </a>

                              @elseif($type == 6)
                                 <a href="{{ route('frequencia.portaria.tematica', $equipamento->id) }}"
                                    class="btn bg-navy" style="margin-right: 3px"><i class="fa fa-users"></i> &nbsp;
                                    Temática
                                 </a>

                              @elseif($type == 7)
                                 <a href="{{ route('frequencia.portaria.listar', $equipamento->id) }}"
                                    class="btn btn-danger" style="margin-right: 3px"><i class="fa fa-users"></i> &nbsp;
                                    Óculos
                                 </a>
                              @endif
                           </td>
                        </tr>
                     @endforeach
                  @else
                     <tr>
                        <th colspan="2" class="text-center">Não há equipamentos cadastrados</th>
                     </tr>
                  @endif

                  <tfoot>
                        <tr>
                           <th>Nome do Equipamento</th>
                           <th>Operações</th>
                        </tr>
                  </tfoot>
               </table>
            </div>
         </div>
      </div>
   </section>
</div>

@include('frequencia.frequencia.publicoRecepcao')
@include('frequencia.frequencia.secaoBraile')
@include('frequencia.frequencia.telecentro')
@include('frequencia.frequencia.tematica')
@include('frequencia.frequencia.oculos')
@endsection
@section('scripts_adicionais')
{{--    <script src="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>--}}
@include('scripts.tabelas_admin')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
   function setarIdEquipamento(id, idInput) {
      let idEquipamento = document.querySelector('#'+idInput);
      idEquipamento.value = id;
   }
</script>
@endsection