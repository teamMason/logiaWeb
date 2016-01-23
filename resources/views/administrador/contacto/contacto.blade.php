@extends('administrador.app')
@section('content')
 
<div class="container-fluid">	
	<div class="row-fluid">
		<div class="panel panel-default">
		    <div class="panel-heading ">	    	    	
		    	<div ><label >Buzón de Contacto</label></div>		    	
		    </div>
		    <div class="panel-body">
					
					<div class="container" id="admin">
						<table class = "table table-striped table-hover " action="javascript:alert('Submitted')" >
							<thead>
								<th>Nombre</th>
								<th>Telefono</th>								
								<th >Acciones</th>					
							</thead>
							<tbody>
								@foreach($buzon as $p)
								<tr>
									<td>{{$p -> nombre}}</td>									
									<td>{{$p -> telefono}}</td>									
									<td>
										<div class="">
											@if($p->leido == 'sinLeer')
											<a href="/buzon/{{$p->id}}/" class="btn btn-info "><i class="fa fa-envelope-o"></i></a>
											@else
											<a data-toggle="modal" data-target="#myModalInfo_{{$p->id}}"class="btn btn-warning"><i class="fa fa-info"></i></a>
											@endif												
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
		    echo $buzon -> render()

		?>
    </div>   
</div>

<!-- Modal para info -->
@foreach($buzon as $p)
<div id="myModalInfo_{{$p->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buzón</h4>
      </div>
      <div class="modal-body">
        <ul style="list-style-type:none;">
        	<li><b>Nombre:</b> {{$p->nombre}}</li>
        	<li><b>Teléfono:</b> {{$p->telefono}}</li>
        	<li><b>E-mail:</b> {{$p->email}}</li>
        	<li><b>Mensaje:</b> {{$p->mensaje}}</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endforeach


<!--Modal Borrar -->
 <div class="modal fade" id="my_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Estas seguro de Borrar??</h4>
      </div>
      {!! Form::open(array('url' => 'admin/buzon/')) !!}
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