@extends('layouts.master')

@section('conteudo')

<div class="col-lg-4 col-lg-offset-4">
		<h1><i class="glyphicon glyphicon-user"></i> Editar {{$user->name}}</h1>
		<hr>

        <form method="POST" action="{{ url('usuarios', [$user->id]) }}" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
			<div class="form-group">
        		<label for="name">Nome</label>
        		<input class="form-control" name="name" type="text" value="{{$user->name}}" id="name">
    		</div>

    		<div class="form-group">
        		<label for="email">Email</label>
        		<input class="form-control" name="email" type="email" value="{{$user->email}}" id="email">
    		</div>

            
            <h5><b>Adicionar Cargo</b></h5>

            <div class='form-group'>
                @if(!(Auth::user()->hasrole('Funcionario')))
                        <input type="radio" value="0" name="roles" checked>
                        <label for="semCargo">Sem Cargo</label><br>

                        @hasrole('Administrador')
                            <input type="radio" value="1" name="roles">
                            <label for="Administrador">Administrador</label><br>
                        @endhasrole
                        
                        <input type="radio" value="2" name="roles">
                        <label for="Coordenador">Coordenador</label><br>
                        
                @endif  
                    <input type="radio" value="3" name="roles">
                    <label for="Funcionario">Funcionario</label><br>
            </div>
            @if($user->name == Auth::user()->name)
       			<div class="form-group">
            		<label for="password">Senha</label><br>
            		<input class="form-control" name="password" type="password" value="" id="password">
            	</div>

        		<div class="form-group">
            		<label for="password">Confirmar Senha</label><br>
            		<input class="form-control" name="password_confirmation" type="password" value="">
    		    </div>
            @endif
    		<input class="btn btn-primary" type="submit" value="Editar">
        </form>
        @if($user->name != Auth::user()->name)
        <form>
            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Resetar a Senha?" data-message='Desejar realmente resetar a senha deste usuario?' data-button="Resetar Senha">Resetar Senha</button>
        </form>
        @endif
        @include('layouts.excluir_confirm')
@endsection
@section('scripts_adicionais')
<!-- Script Msg Resetar Senha -->
    <script type="text/javascript">
        $('#confirmDelete').on('show.bs.modal', function (e)
        {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $button = $(e.relatedTarget).attr('data-button');
            $(this).find('.modal-footer #confirm').text($button);

            // Pass form reference to modal for submission on yes/ok
            var button = $(e.relatedTarget).closest('button');
            $(this).find('.modal-footer #confirm').data('button', button);
        });
         
        // Form confirm (yes/ok) handler, submits form
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function()
        {
           window.location.replace("{{route('usuarios.index')}}");
        });

        $(document).ready(function () {
            $('input:radio[name="roles"][value={{$user->roles->first()->id}}]').attr('checked', true);
        });
    </script>
@endsection