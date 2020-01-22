@extends('layouts.masterauth')

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
            margin-top: 100px;
        }
    </style>
@endsection

@section('conteudo')
    <div class="margem">
        <div class="row">
            <center>
                <div class="form-group col-md-6">
                    <a href="{{url('/gerencial')}}"><i class="fa fa-users fa-5x" aria-hidden="true"></i>
                        <h3>Gerencial</h3>
                    </a>
                </div>

                <div class="form-group col-md-6">
                    <a href="{{url('/frequencia')}}"><i class="fa fa-calendar fa-5x" aria-hidden="true" ></i>
                        <h3>Frequência</h3>
                    </a>
                </div>
            </center>
        </div>
    </div>
@endsection