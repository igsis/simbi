@extends('layouts.master')

@section('titulo','Início')

@section('modulo')
	<div class="col-md-3" style="text-align: center;">
		<br>
		<div class="box box-solid bg-navy color-palette">
			<div class="box-header">
				@if (request()->is('gerencial*'))
					<h3 class="box-title"> <i class="fa fa-users"></i>  Módulo gerencial</h3>
				@elseif (request()->is('acervo*'))
					<h3 class="box-title"> <i class="glyphicon glyphicon-book"></i>  Módulo de acervo</h3>
				@else
					<h3 class="box-title"> <i class="fa fa-calendar"></i>  Módulo de frequência</h3>
				@endif
			</div>
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
@endsection

@section('conteudo')

    @if(Auth::guest())
		@include('auth.login')
    @else
		<div style="text-align: center;">
			<h2>Bem Vindo ao SIMBI</h2>
			<h3>Sistema de Indicadores das Bibliotecas Públicas Municipais</h3>
		</div>
		<hr>

		<?php $faltaFrequencia = 0; ?>
		@if($ocorrencias != null || $frequenciasCadastradas != null)
			@foreach($ocorrencias as $ocorrencia)
				@if(!(in_array($ocorrencia->id, $frequenciasCadastradas)) && $ocorrencia->publicado == 1)
					<?php
						$dataOcorrencia = strtotime($ocorrencia->data);
						$diaHoje = strtotime(date('Y-m-d'));

						$res = $dataOcorrencia - $diaHoje;

						$res = $res / 86400;

						if($res < 0){
							$faltaFrequencia = 1;
						}
					?>
				@endif
			@endforeach
			@if($faltaFrequencia == 1)
				<div class="alert alert-danger" role="alert">
					Existem <strong> frequências </strong> a serem adicionadas.
				</div>
			@else
				<div class="alert alert-success" role="alert">
					Todas as <strong> frequências </strong> estão em dia!
				</div>
			@endif
		@endif

		<hr>
	@endif
@endsection