@extends('layouts.masterauth')

@section('conteudo')
    <div class="row">
        <center>
            <div class="form-group col-md-6">
                <a href="{{url('/gerencial')}}"> <i class="fa fa-users fa-5x" aria-hidden="true"></i>
                    <h3>Gerencial</h3>
                </a>
            </div>
            <div class="form-group col-md-6">
                <a href="{{url('/frequencia')}}"> <i class="fa fa-calendar fa-5x" aria-hidden="true" ></i>
                    <h3>Frequência</h3>
                </a>
            </div>
        </center>
    </div>
@endsection