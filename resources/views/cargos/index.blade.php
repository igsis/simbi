@extends('layouts.master')

@section('conteudo')

	<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="glyphicon glyphicon-eye-open"></i> Cargos</h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Cargos</th>
                    <th>Permissões</th>
                    <th>Operações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('cargos/'.$role->id.'/editar') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Editar</a>

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ URL::to('cargos/cadastro') }}" class="btn btn-success">Adicionar Cargo</a>

</div>

@endsection