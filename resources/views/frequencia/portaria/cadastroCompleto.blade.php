@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-6 col-lg-offset-3">
        <h1>
            <i class="glyphicon glyphicon-user"></i> Frequência da Portaria <br>
            <small>{{$equipamento->nome}}</small>
        </h1>
        <hr>

        <form method="POST" action="{{route('frequencia.portaria.gravar', $equipamento->id)}}">
            {{ csrf_field() }}

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="nome">Nome/Nome Social</label>
                    <input type="text" class="form-control" class="form-control" id="nome" name="nome" value="{{ old('nome') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="data">Data</label>
                    <input class="form-control" type="date" name="data">
                </div>

                <div class="form-group col-md-4">
                    <label for="status">Sexo</label>
                    <select class="form-control" name="status" id="sexo">
                        <option value="">Selecione...</option>
                        @foreach ($sexos as $sexo)
                            @if ($sexo->id == old('sexo'))
                                <option value="{{$sexo->id}}" selected>{{$sexo->sexo}}</option>
                            @else
                                <option value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="status">Idade</label>
                    <select class="form-control" name="status" id="idade">
                        <option value="">Selecione...</option>
                        @foreach ($idades as $idade)
                            @if ($idade->id == old('idade'))
                                <option value="{{$idade->id}}" selected>{{$idade->idade}}</option>
                            @else
                                <option value="{{$idade->id}}">{{$idade->idade}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="status">Etnia</label>
                    <select class="form-control" name="status" id="etnia">
                        <option value="">Selecione...</option>
                        @foreach ($etnias as $etnia)
                            @if ($etnia->id == old('etnia'))
                                <option value="{{$etnia->id}}" selected>{{$etnia->etnia}}</option>
                            @else
                                <option value="{{$etnia->id}}">{{$etnia->etnia}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="status">Escolaridade</label>
                    <select class="form-control" name="status" id="escolaridade">
                        <option value="">Selecione...</option>
                        @foreach ($escolaridades as $escolaridade)
                            @if ($escolaridade->id == old('$escolaridade'))
                                <option value="{{$escolaridade->id}}" selected>{{$escolaridade->escolaridade}}</option>
                            @else
                                <option value="{{$escolaridade->id}}">{{$escolaridade->escolaridade}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="status">Deficiencia</label>
                    <select class="form-control" name="status" id="deficiencia">
                        <option value="">Selecione...</option>
                        @foreach ($deficiencias as $deficiencia)
                            @if ($deficiencia->id == old('deficiencia'))
                                <option value="{{$deficiencia->id}}" selected>{{$deficiencia->deficiencia}}</option>
                            @else
                                <option value="{{$deficiencia->id}}">{{$deficiencia->deficiencia}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <input class="btn btn-success" type="submit" value="Cadastrar">
        </form>

    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

    </script>

@endsection
