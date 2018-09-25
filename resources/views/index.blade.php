@extends('layouts.master')

@section('conteudo')
	<div style="text-align: center;">
		<h2>Bem Vindo ao SIMBI</h2>
		<h3>Sistema de Indicadores das Bibliotecas Públicas Municipais</h3>
	</div>

    @if(Auth::guest())
        @include('auth.login')
    @else
		<hr>
		@if($ocorrencias != null && $frequenciasCadastradas != null)
			@foreach($ocorrencias as $ocorrencia)
				@if(!(in_array($ocorrencia->id, $frequenciasCadastradas)) && $ocorrencia->publicado == 1)
					<?php
							$dataOcorrencia = strtotime($ocorrencia->data);
							$diaHoje = strtotime(date('Y-m-d'));

							$res = $dataOcorrencia - $diaHoje;

							$res = $res / 86400;

							$faltaFrequencia = 0;

							if($res < 0){
								$faltaFrequencia = 1;
							}

					?>
				@endif
			@endforeach
			@if($faltaFrequencia == 1)
				<div class="alert alert-danger" role="alert">
					<strong>Frequências!</strong> Existem frequências a serem adicionadas.
				</div>
			@endif
		@endif

		<hr>
	@endif
@endsection