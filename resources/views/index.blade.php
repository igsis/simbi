@extends('layouts.index')

@section('linksAdicionais')
    <style type="text/css">
        a:link{
            text-decoration:none;
            color:black;
        }

        a:visited{
            text-decoration:none;
            color:black;
        }

        a:hover{
            text-decoration:none;
            color:black;
        }

        a:active{
            text-decoration:none;
            color:black;
        }

        .margem{
            margin-top: 200px;
        }
    </style>
@endsection

@section('conteudo')

    <div class="margem">
        <div class="login-logo margin-top">
            <a href="{{url('/')}}"><b>SIMBI</b></a>
        </div>
        <div class="row">
            <center>
                <div class="form-group col-md-4">
                    <a href="{{url('/gerencial')}}"><i class="fa fa-users fa-5x" aria-hidden="true"></i>
                        <h3>Gerencial</h3>
                    </a>
                </div>

                <div class="form-group col-md-4">
                    <a href="{{url('/frequencia')}}"><i class="fa fa-calendar fa-5x" aria-hidden="true" ></i>
                        <h3>Frequência</h3>
                    </a>
                </div>

                <div class="form-group col-md-4">
                    <a href="{{url('/acervo')}}"><i class="glyphicon glyphicon-book fa-5x"></i>
                        <h3>Acervo</h3>
                    </a>
                </div>
            </center>
        </div>
    </div>
@endsection