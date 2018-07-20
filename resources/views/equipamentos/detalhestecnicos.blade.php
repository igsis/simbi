@extends('layouts.master')

@section('conteudo')

    <div class="container">
        <div style="text-align: center;">
            <h2>
                Detalhes Técnicos<br>
                <small>{{$equipamento->nome}}</small>
            </h2>
        </div>

        <hr>

        <form method="POST" action="{{ route('equipamentos.gravaDetalhes', $equipamento->id) }}">
            {{ csrf_field() }}

            
        </form>

    </div>

@endsection