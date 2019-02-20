<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Procurar...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu Principal</li>
            <li class="treeview">
                <a href="{{url('/')}}">
                    <i class="glyphicon glyphicon-home"></i>
                    <span>Início</span>
                </a>
            </li>
            <li class="treeview">
                @hasanyrole('Coordenador|Administrador')
                <a href="#">
                    <i class="glyphicon glyphicon-cog"></i> <span>Administrativo</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> Usuários
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('usuarios.index', ['type' => '1']) }}"> Lista de Usuários</a></li>
                            @hasrole('Administrador')
                                <li><a href="{{ route('usuarios.cadastro') }}"> Cadastrar Usuários</a></li>
                                <li><a href="{{ route('usuarios.index', ['type' => '0']) }}"> Usuários Desativados</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="glyphicon glyphicon-th-large"></i> Equipamentos
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('equipamentos.index', ['type' => '1'])}}">Lista de Equipamentos</a></li>
                            <li><a href="{{route('equipamentos.importar')}}">Importar do Igsis</a></li>
                            <li><a href="{{ route('equipamentos.cadastro') }}">Cadastrar Equipamentos</a></li>
                            <li><a href="{{route('equipamentos.index', ['type' => '0'])}}">Equipamentos Desativados</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cogs"></i> Gerenciar
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('cargo')}}">Cargo</a></li>
                            <li><a href="{{route('distrito')}}">Distrito</a></li>
                            <li><a href="{{route('secretaria')}}">Indentificação da Secretaria</a></li>
                            <li><a href="{{route('prefeituraRegional')}}">Prefeituras Regionais</a></li>
                            <li><a href="{{route('siglaEquipamento')}}">Sigla do Equipamento</a></li>
                            <li><a href="{{route('subordinacaoAdministrativa')}}">Subordinação Administrativa</a></li>
                            <li><a href="{{route('tipoServico')}}">Tipo de Serviço</a></li>
                        </ul>
                    </li>
                </ul>
                @endhasanyrole
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-book"></i> <span>Frequência</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('frequencia.index') }}">Inserir Nova Frequência</a></li>
                    <li><a href="{{ route('frequencia.relatorio') }}">Relatório de Frequencias</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>