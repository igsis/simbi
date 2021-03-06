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
                    <span>Módulos</span>
                </a>
            </li>
            @hasanyrole('Coordenador|Administrador')
            {{--ÁREA GERENCIAL--}}
            @if (request()->is('gerencial*'))
                <li class="header">Gerencial</li>
                <li class="treeview {{ request()->routeIs('funcionarios*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-address-book-o"></i> <span>Pessoas</span>
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
                        <li><a href="{{route('equipamentos.importar')}}">Importar do SisContrat</a></li>
                        <li><a href="{{ route('equipamentos.cadastro') }}">Cadastrar</a></li>
                        <li><a href="{{route('equipamentos.index', ['type' => '0'])}}">Desativados</a></li>
                    </ul>
                </li>
                <li class="treeview {{ request()->routeIs('gerenciar*') ? 'active' : '' }}">
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

            @elseif (request()->is('acervo*'))
                {{--       ÁREA ACERVO         --}}
                <li class="header">Acervo</li>
                <li class="treeview {{ request()->routeIs('consulta*') ? 'active' : '' }}">
                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i><span>Consulta</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('consulta.index',['type'=>'1'])}}"> Registros</a></li>
                        <li><a href="{{ route('consulta.index',['type'=>'1.2'])}}"> Relatório</a></li>
                    </ul>
                </li>

                <li class="treeview {{ request()->routeIs('emprestimo*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-book"></i><span>Empréstimo</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('emprestimo.index',['type'=>'2']) }}"> Registros</a></li>
                        <li><a href="{{ route('emprestimo.index',['type'=>'2.1']) }}"> Relatório</a></li>
                    </ul>

                </li>

                <li class="treeview {{ request()->routeIs('bibliotecas*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-institution"></i><span>Bibliotecas Temáticas</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('bibliotecas.index', ['type' => '3']) }}"> Registros</a></li>
                        <li><a href="{{ route('bibliotecas.index', ['type' => '3.1']) }}"> Relatório</a></li>
                    </ul>
                </li>

                <li class="treeview {{ request()->routeIs('matricula*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-file-text"></i><span>Matrícula</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('matricula.index', ['type' => '4']) }}"> Registros</a></li>
                        <li><a href="{{ route('matricula.index', ['type' => '4.1']) }}"> Relatório</a></li>
                    </ul>
                </li>
            @else
                {{--       ÁREA FREQUENCIA         --}}
                <li class="header">Frequência</li>

                <li class="treeview {{ request()->routeIs('eventos*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-calendar-o"></i> <span>Eventos</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('eventos.index')}}"> Lista </a></li>
                    </ul>
                </li>

                <li class="treeview {{ request()->routeIs('') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Público</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('frequencias.enviadas',['type'=>'1']) }}"> Cadastrar</a></li>
                    </ul>
                </li>
                <li class="treeview {{ request()->routeIs('gerenciar*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-paper-plane"></i> <span>Enviados</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('frequencias.enviadas',['type'=>'2']) }}">Ocorrência de eventos</a></li>
                        <li><a href="{{ route('frequencias.enviadas',['type'=>'3']) }}">Publico de Recepção</a></li>
                        <li><a href="{{ route('frequencias.enviadas',['type'=>'4']) }}">Seção Braille</a></li>
                        <li><a href="{{ route('frequencias.enviadas',['type'=>'5']) }}">Telecentro/DigLab</a></li>
                        <li><a href="{{ route('frequencias.enviadas',['type'=>'6']) }}">Temática</a></li>
                        <li><a href="{{ route('frequencias.enviadas',['type'=>'7']) }}">Óculos</a></li>
                    </ul>
                </li>
                <li class="treeview {{ request()->routeIs('gerenciar*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-bars"></i> <span>Relatório</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('frequencia.relatorio') }}">Frequência de Público</a></li>
                    </ul>
                </li>

            @endif
            @endhasanyrole

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>