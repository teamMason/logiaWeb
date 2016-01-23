@extends('../templates/layout')
@section('content')
	@include('includes.head')

	
	<nav class="navbar navbar-default navbar-fixed-top">
        <!-- Navigation -->
    
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">                
                <a class="navbar-brand page-scroll" href="/">M.·.R.·.G.·.L.·. de Estado Baja California.</a>
            </div>           
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
   
    </nav>
	<header id = "headerNews">
		<div class="container">
		    <div class="intro-text">
		        <div class="intro-lead-in">Artículos Relacionados con:</div>
		        <div class="intro-heading">{{$tag}}</div>
		        <a href="#post" class="page-scroll btn btn-xl">Leer Más</a>
		        
		    </div>
		</div>
	</header>	
	<section id = "post">
		<div class="container">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				@foreach($posts as $p)	
					<div id="row-fluid">
						<div id="container">
							<h3 class = "text-center">{{$p->title}}</h3>
							<div align = "center" id = "articulos">
								<img src="{{$p->photo}}" title = "{{$p->title}}" class = "img-responsive img-thumbnail">
							</div>
																			
							<br>
							<div align = "center">
								<a href="../news/{{$p->slug}}" class = "btn btn-info">Leer Artículo</a>
							</div>
						</div>	
					</div>
					<hr>
				@endforeach
			</div>
			<div class="col-md-2"></div>
		</div>		
	</section>	
	<br>
	
@stop