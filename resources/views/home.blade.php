@extends('adminlte::page')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid box-success">
			<div class="box-header with-border">
				<div class="box-title">Students</div>
			</div>
			<div class="box-body">
				<div class="chart" style="height: 300px;" >
					<canvas id="pieChart" style="height: 100%;"></canvas>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
