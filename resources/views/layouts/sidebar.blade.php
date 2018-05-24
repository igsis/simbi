<nav id="sidebar">
    <div id="dismiss">
        <i class="glyphicon glyphicon-arrow-left"></i>
    </div>

    <div class="sidebar-header">
        <h3>Sistema SIMBI</h3>
    </div>

    <ul class="list-unstyled components">
        
        <li class="active">
            <a href="{{url('/')}}">
            	<i class="glyphicon glyphicon-home"></i>
            	Inicio
        	</a>
        </li>
        <li>
            @hasanyrole('Coordenador|Administrador')
                <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="glyphicon glyphicon-user"></i>
                    Usuário
                </a>
                <ul class="collapse list-unstyled" id="userSubmenu">
                    <li><a href="{{ route('usuarios.index') }}">Painel de Usuarios</a></li>
                    @hasrole('Administrador')
                        <li><a href="{{ route('usuarios.cadastro') }}">Cadastrar Usuario</a></li>
                    @endhasrole
                </ul>
            @endhasanyrole
        </li>
            <li>
                <a href="#modSubmenu" data-toggle="collapse" aria-expanded="false">
                	<i class="glyphicon glyphicon-th-large"></i>
                	Módulos</a>
                <ul class="collapse list-unstyled" id="modSubmenu">
                    <li><a href="{{route('equipamentos.index')}}">Equipamentos</a></li>
                    <li><a href="#">Módulo 2</a></li>
                    <li><a href="#">Módulo 3</a></li>
                </ul>
            </li>
        <li>
            <a href="#">
                <i class="glyphicon glyphicon-send"></i>
                Contato</a>
        </li>
    </ul>
</nav>