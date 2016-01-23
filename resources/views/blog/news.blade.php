@extends('../templates/layout')
@section('titlePage'){{'News'}}@endsection
@section('content')

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
		        <div class="intro-lead-in">Bienvenido seas a nuestra Sección de Noticias</div>
		        <div class="intro-heading">Blog Masónico S.·.F.·.U.·.</div>
		        <a href="#post" class="page-scroll btn btn-xl">Leer Más</a>
		    </div>
		</div>
	</header>
	<section id = "post" style = "height:auto;">
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
							<h4 class = "text-justify">
							
							</h4>
							<br>
							<div align = "center">
								<?php
									$tags = explode(',', $p->tags)
								?>
								<h5 class = "text-info">Temas relacionados.</h5>
								<i class="fa fa-tags "></i>	
								@foreach($tags as $t)
									<a href="../tag/{{$t}}"><label class = "label label-primary">{{$t}}</label></a>

									
								@endforeach

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
		<div class="container" align = "center">
			<?php 
				echo $posts -> render()

			?>

		</div>
	</section>	
@stop