@extends('layouts.app')
<!--ponerle titulo a la paginga-->
@section('title', 'Cambio password')
<!--ponerle titulo a la cabecera-->


@section('content') 

<div class="container-fluid" >
		<div class="row">
			<center>
				<p>
					<h1>Buenos días  <strong> {!!"  ". auth()->user()->name."   ". auth()->user()->lastname!!}</strong></h1>
					<br>
					<p >
						<a class="btn btn-danger " href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cancelar
						</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
							</form> 
						</p>
				</p>
			</center>
			<br>
			<br>
			<div class="col-xs-12 col-sm-4" >
					<center>
						<img src="/img/csjCambioPass.png" >
							<br>					
							<center>
							<p>
								<h3>
									Por favor realiza el cambio de contraseña. Está restringido el acceso hasta que se haga la actualización.
								</h3>
							</p>
							</center>
					</center>	
					
				</div>

			<div class="col-xs-12 col-sm-8">
								
			  <div class="col-xs-12 col-md-3"></div>

				<div class=" col-xs-12 col-md-6" >
					<div class="panel panel-default elevation-3 shadow" >
					<div class="panel-heading" style="text-align: center; background-color: #004182; color: #fff;">	<strong><i class="fa fa-key fa-4x  " aria-hidden="true"></i> </strong></div>
					<hr>
					<div class="panel-body">
						@if (session('error'))
							<div class="alert alert-danger">
							{{ session('error') }}
							</div>
							@endif
							@if (session('success'))
							<div class="alert alert-success">
							{{ session('success') }}
							</div>
						@endif
						<form id="passworform" action="{{ route('changePassword') }}" method="POST">
    @csrf
							<div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
								<label for="new-password" class="col-md-4 control-label">Passowrd Actual</label>
								<div class="col-md-12">
									<input id="current-password" type="password" class="form-control" name="current-password" required autocomplete="off">
									@if ($errors->has('current-password'))
										<span class="help-block">
											<strong>{{ $errors->first('current-password') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
								<label for="new-password" class="col-md-4 control-label">Nuevo Password</label>
								<div class="col-md-12">
									<input id="new-password" type="password" class="form-control" name="new-password" autocomplete="off" required>
									@if ($errors->has('new-password'))
										<span class="help-block" style="color: red">
											<strong>{{ $errors->first('new-password') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="new-password-confirm" class="col-md-8 control-label">Confirma Nuevo Password</label>
								<div class="col-md-12">
									<input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" autocomplete="off" required>
								</div>
								<br>
							</div>
							<br>
							<div class="form-group">
								<div class="row">				

									<div class="col-xs-12 col-sm-2"></div>
									<div class="col-xs-12 col-sm-8 ">
									<br>
										<button type="submit" class="btn btn-success btn-block fa fa-unlock-alt elevation-3">
											CAMBIAR CONTRASEÑA
										</button>
									</div>
									<div class="col-xs-12 col-sm-2"></div>
									
								</div>
								<br>
							</div>
							
						</form>
					</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-3"></div>
				</div>
				
			</div>
			


</div>
@endsection
