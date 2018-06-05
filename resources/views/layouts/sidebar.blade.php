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
            	Início
        	</a>
        </li>
        <li>
            @hasanyrole('Coordenador|Administrador')
                <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="glyphicon glyphicon-user"></i>
                    Usuários
                </a>
                <ul class="collapse list-unstyled" id="userSubmenu">
                    <li><a href="{{ route('usuarios.index') }}">Lista de Usuários</a></li>
                    @hasrole('Administrador')
                        <li><a href="{{ route('usuarios.cadastro') }}">Cadastrar Usuários</a></li>
                    @endhasrole
                </ul>
            @endhasanyrole
        </li>
            <li>
                <a href="#modSubmenu" data-toggle="collapse" aria-expanded="false">
                	<i class="glyphicon glyphicon-th-large"></i>
                	Equipamentos</a>
                <ul class="collapse list-unstyled" id="modSubmenu">
                    <li><a href="{{route('equipamentos.index')}}">Lista de Equipamentos</a></li>
                    <li><a href="{{ route('equipamentos.cadastro') }}"><i class="fas fa-users"></i>Cadastrar Equipamentos</a></li>
                </ul>
            </li>
        <li>
            <a href="#">
                <i class="glyphicon glyphicon-send"></i>
                Contato</a>
        </li>
    </ul>
</nav>