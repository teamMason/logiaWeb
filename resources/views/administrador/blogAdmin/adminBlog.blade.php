@extends('administrador.app')
@section('content')
 
<div class="container-fluid">	
	<div class="row-fluid">
		<div class="panel panel-default">
		    <div class="panel-heading ">
		    	<div class="col-md-1"></div>	    	
		    	<div class="col-md-8"><label >Formulario </label></div>
		    	<div><a href="{{route('crearArticle')}}" class="btn btn-success " class ="text-right"><i class="fa fa-plus"></i> Nuevo</a>
		    	</div>
		    </div>
		    <div class="panel-body">
					
					<div class="container" id="admin">
						<table class = "table table-striped table-hover " action="javascript:alert('Submitted')" >
							<thead>
								<th>Titulo</th>
								<th>Autor</th>
								<th>Estatus</th>
								<th>Fecha</th>
								<th class  = "foo">Acciones</th>					
							</thead>
							<tbody>
								@foreach($posts as $p)
								<tr>
									<td>{{$p -> title}}</td>
									<td>{{$p -> autor}}</td>
									<td>{{$p -> estatus}}</td>
									<td>{{$p -> created_at}}</td>
									<td>
										<div class="">
											<a href="admin/post/{{$p -> id}}/edit" class="btn btn-warning "><i class="fa fa-edit"></i></a>												
											<a href="#my_modal" data-toggle="modal" data-book-id="{{$p -> id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>										
										</div>
									</td>									
								</tr>
								@endforeach
								
							</tbody>
						</table>
					</div>
				
		    </div>
		</div>
	</div>
    <div class="container" align = "center">
		<?php 
		    echo $posts -> render()

		?>
    </div>
</div>

<!--Modal Borrar -->
 <div class="modal fade" id="my_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Estas seguro de Borrar</h4>
      </div>
      {!! Form::open(array('url' => '/admin/adminBlog/')) !!}
	      <div class="modal-body">
	        <p>Una vez borrado perderás toda la información! </p>
	        <div>
	        	<i class="fa fa-frown-o fa-5x"></i>
	        </div>
	        <input type="hidden" name="borrarId" value=""/>
	      </div>
	      <div class="modal-footer">
	      	<input type="submit" value="Borrar" class="btn btn-danger">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>

@endsection
@section('scripts')
    <script>
       $('#my_modal').on('show.bs.modal', function(e) {
		    var borrarId = $(e.relatedTarget).data('book-id');
		    $(e.currentTarget).find('input[name="borrarId"]').val(borrarId);
		});
    </script>
@stop	