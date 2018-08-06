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
            <a href="#admSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-cog"></i>
                Administrativo
            </a>
            <ul class="collapse list-unstyled" id="admSubmenu">

                <li>
                    <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false">
                        <i class="glyphicon glyphicon-user"></i>
                        Usuários
                    </a>
                    <ul class="collapse list-unstyled" id="userSubmenu">
                        <li><a href="{{ route('usuarios.index', ['type' => '1']) }}">Lista de Usuários</a></li>
                        @hasrole('Administrador')
                        <li><a href="{{ route('usuarios.cadastro') }}">Cadastrar Usuários</a></li>
                        <li><a href="{{ route('usuarios.index', ['type' => '0']) }}"> Usuários Desativados</a></li>
                        @endhasrole
                    </ul>
                </li>

                <li>
                    <a href="#equipSubmenu" data-toggle="collapse" aria-expanded="false">
                        <i class="glyphicon glyphicon-th-large"></i>
                        Equipamentos</a>
                    <ul class="collapse list-unstyled" id="equipSubmenu">
                        <li><a href="{{route('equipamentos.index', ['type' => '1'])}}">Lista de Equipamentos</a></li>
                        <li><a href="{{ route('equipamentos.cadastro') }}"><i class="fas fa-users"></i>Cadastrar Equipamentos</a></li>
                        <li><a href="{{route('equipamentos.index', ['type' => '0'])}}">Equipamentos Desativados</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#gerenciar" data-toggle="collapse" aria-expanded="false">
                        <i class="glyphicon glyphicon-cog"></i>
                        Gerenciar
                    </a>
                    <ul class="collapse list-unstyled" id="gerenciar">
                        <li><a href="{{route('tipoServico')}}">Tipo de Serviço</a></li>
                        <li><a href="{{route('siglaEquipamento')}}">Sigla do Equipamento</a></li>
                        <li><a href="{{route('secretaria')}}">Indentificação da Secretaria</a></li>
                        <li><a href="{{route('subordinacaoAdministrativa')}}">Subordinação Administrativa</a></li>
                        <li><a href="{{route('prefeituraRegional')}}">Prefeituras Regionais</a></li>
                        <li><a href="{{route('distrito')}}">Distrito</a></li>
                    </ul>
                </li>
            </ul>
            @endhasanyrole

            <li>
                <a href="#freqSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="glyphicon glyphicon-book"></i>
                    Frequência</a>
                <ul class="collapse list-unstyled" id="freqSubmenu">
                    <li><a href="{{ route('frequencia.index') }}">Inserir Nova Frequência</a></li>
                    <li><a href="{{ route('frequencia.relatorio') }}">Relatório de Frequencias</a></li>
                </ul>
            </li>
        </li>
        {{--<li>
            @hasanyrole('Coordenador|Administrador')
                <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="glyphicon glyphicon-user"></i>
                    Usuários
                </a>
                <ul class="collapse list-unstyled" id="userSubmenu">
                    <li><a href="{{ route('usuarios.index', ['type' => '1']) }}">Lista de Usuários</a></li>
                    @hasrole('Administrador')
                        <li><a href="{{ route('usuarios.cadastro') }}">Cadastrar Usuários</a></li>
                        <li><a href="{{ route('usuarios.index', ['type' => '0']) }}"> Usuários Desativados</a></li>
                        <li><a href="{{ route('frequencia') }}"> Frequência Usuários</a></li>
                    @endhasrole
                </ul>
            @endhasanyrole
        </li>--}}

    </ul>
</nav>