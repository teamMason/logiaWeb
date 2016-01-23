<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Panel Gran Logia</title>

	@include('../includes/head')
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

</head>
<body class="index">
<div class="row">
	<div class="container-fluid">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{route('adminSite')}}"><i class="fa fa-cogs"></i>  Panel de Control</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="{{route('home')}}">Home</a></li>
						@if (!Auth::guest())
							@if (Auth::user()->isTesorero() or Auth::user()->isAdmin())
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Tesoreria <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#">Consultas</a></li>
										<li><a href="#">Recibos</a></li>
									</ul>
								</li>
							@endif	
							@if (Auth::user()->isAdmin() or Auth::user()->isSecretario() or Auth::user()->isVenerable())
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Miembros <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										@if (Auth::user()->isVenerable())
										<li><a href="{{route('consultaMTaller')}}">Consultas</a></li>
										<li><a href="#">Estadisticas</a></li>
										@endif
										@if (Auth::user()->isAdmin())
										<li><a href="{{route('registrarMiembros')}}">Registrar</a></li>
										<li><a href="{{route('consulta')}}">Consultas</a></li>
										<li><a href="#">Estadisticas</a></li>
										@endif
									</ul>
								</li>
							@endif		
							@if (Auth::user()->isAdmin() or Auth::user()->isSecretario() or Auth::user()->isVenerable())	
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Solicitudes <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										@if (Auth::user()->isAdmin() or Auth::user()->isSecretario())
										<li><a href="{{route('aprobaciones')}}">Aprobaciones</a></li>
										<li><a href="{{route('votaNeofitos')}}">Votaciones Neófitos</a></li>
										@endif
										@if (Auth::user()->isVenerable())
											<li><a href="{{route('registrarSolicitud')}}">Enviar solicitud</a></li>
											<li><a href="{{route('votaciones')}}">Votar por nuevo Miembro</a></li>
										@endif
									</ul>
								</li>
							@endif		
							@if (Auth::user()->isAdmin()  or Auth::user()->isSecretario())
								<li class="dropdown">
									<a  class="dropdown-toggle" data-toggle="dropdown" role="button" >Contacto <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{route('buzon')}}">Buzón</a></li>
										
									</ul>
								</li>
							@endif		
							@if (Auth::user()->isAdmin())
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Blog <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{route('adminBlog')}}">Editar Blogs</a></li>								
									</ul>
								</li>
							@endif
							@if (Auth::user()->isAdmin())
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Biblioteca <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{route('adminBlog')}}">Editar Libros</a></li>								
								</ul>
							</li>
							@endif
							@if (Auth::user()->isVenerable())
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Iniciaciones <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{route('iniciaciones')}}">Tus iniciaciones</a></li>								
								</ul>
							</li>
							@endif
							@if (Auth::user()->isAprendiz())
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Libros <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{route('adminBlog')}}">Libros Aprendiz</a></li>								
									</ul>
								</li>
							@endif	
							@if (Auth::user()->isCompanero())
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Libros <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{route('adminBlog')}}">Libros Aprendiz</a></li>	
										<li><a href="{{route('adminBlog')}}">Libros Companero</a></li>							
									</ul>
								</li>
							@endif	
							@if (Auth::user()->isMaestro())
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Libros <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{route('adminBlog')}}">Libros Aprendiz</a></li>	
										<li><a href="{{route('adminBlog')}}">Libros Companero</a></li>	
										<li><a href="{{route('adminBlog')}}">Libros Maestro</a></li>						
									</ul>
								</li>
							@endif			
						@endif
					</ul>

					<ul class="nav navbar-nav navbar-right">
						@if (Auth::guest())
							<li><a href="{{route('login')}}">Login</a></li>
							<li><a href="{{route('register')}}">Register</a></li>
						@else						
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{route('logout')}}">Logout</a></li>
									@if (Auth::user()->isAdmin())
										<li><a href="#">Administrar Cuenta</a></li>
										<li><a href="#">Padron de Gran Logia</a></li>
									@endif
								</ul>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container-fluid">
			<div class="row">
			@if($_SERVER['REQUEST_URI'] == '/admin')
				@if (Auth::user()->isAdmin() or Auth::user()->isSecretario() or Auth::user()->isVenerable())	
					<div class="col-md-6">
					<img src="../assets/img/portfolio/secretary.png" class="img-thumbnail img-responsive" alt="" width="100%" height="100"> </th>
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">Notificaciones de Miembros</h3>
						  </div>
						  <div class="panel-body">
						    <ul style="list-style-type:none">
						    	<li>Actualmente se está votando por # neofitos diferentes.</li>
						    	@if(Auth::user()->isAdmin() or Auth::user()->isSecretario())
							    	<li>Existen # Solicitudes en espera de Aprobación:</li>
							    	<li>Tienes # mensajes del buzón sin Leer.									</li>
						    	@endif
						    </ul>
						  </div>
						</div>
					</div>				
				@endif
			@else	
			
				@yield('content')
			@endif
			</div>
		</div>
		<br>	

		<footer>			
		@include('includes.footer')
		</footer>
		<!-- Scripts -->

		<script type="text/javascript" src="{!! asset('assets/js/jquery.js') !!}"></script>
		<script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>

	    @yield('scripts')		

	    
	
	</div>
</div>
</body>

</html>

