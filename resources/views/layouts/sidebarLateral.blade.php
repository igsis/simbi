<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu Principal</li>
            <li>
                <a href="{{url('/')}}">
                    <i class="glyphicon glyphicon-home"></i>
                    <span>Início</span>
                </a>
            </li>
            @hasanyrole('Coordenador|Administrador')
            <li class="header">Administrativo</li>
            <li class="treeview {{ request()->routeIs('funcionarios*') ? 'active' : '' }}">
                <a href="#"><i class="fa fa-address-book-o"></i> <span>Funcionários</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('funcionarios.index', ['type' => '1'])}}"> Lista</a></li>
                    <li><a href="{{ route('funcionarios.cadastrar') }}"> Cadastrar</a></li>
                    <li><a href="{{ route('funcionarios.index', ['type' => '0']) }}"> Desativados</a></li>
                </ul>
            </li>
            <li class="treeview {{ request()->routeIs('usuarios*') ? 'active' : '' }}">
                <a href="#"><i class="fa fa-user"></i><span>Usuários</span>
                    <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('usuarios.index', ['type' => '1']) }}"> Lista</a></li>
                    <li><a href="{{ route('usuarios.index', ['type' => '0']) }}"> Desativados</a></li>
                </ul>
            </li>
            <li class="treeview {{ request()->routeIs('equipamentos*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-university"></i> <span>Equipamentos</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('equipamentos.index', ['type' => '1'])}}"> Lista</a></li>
                    <li><a href="{{route('equipamentos.importar')}}">Importar do Igsis</a></li>
                    <li><a href="{{ route('equipamentos.cadastro') }}">Cadastrar</a></li>
                    <li><a href="{{route('equipamentos.index', ['type' => '0'])}}">Desativados</a></li>
                </ul>
            </li>

            <li class="treeview {{ request()->routeIs('evento*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-calendar-o"></i> <span>Eventos</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('frequencia.index') }}">Lista</a></li>
                    <li><a href="#">Cadastro</a></li>
                </ul>
            </li>

            <li class="treeview {{ request()->routeIs('frequencia*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Frequência</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('frequencias.enviadas',['type'=>'1']) }}"> Cadastrar</a></li>
                    <li><a href="{{ route('frequencias.enviadas',['type'=>'2']) }}"> Enviadas</a></li>
                    <li><a href="{{ route('frequencia.relatorio') }}">Relatório</a></li>
                </ul>
            </li>
            <li class="treeview {{ request()->routeIs('gerenciar') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Gerenciar</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('cargo')}}">Cargo</a></li>
                    <li><a href="{{route('distrito')}}">Distrito</a></li>
                    <li><a href="{{route('secretaria')}}">Indentificação da Secretaria</a></li>
                    <li><a href="{{route('prefeituraRegional')}}">Subprefeituras</a></li>
                    <li><a href="{{route('subordinacaoAdministrativa')}}">Subordinação Administrativa</a></li>
                    <li><a href="{{route('tipoServico')}}">Tipo de Serviço</a></li>
                    <li><a href="{{ route('equipamentos.lote') }}">Trocar formulário em lote</a></li>
                </ul>
            </li>
            @endhasanyrole

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>