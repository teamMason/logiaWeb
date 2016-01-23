@if($errors->any())
	<div class="alert alert-danger" roles="alert">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <p>Corrige los siguientes errores!</p>
	  <ul>
	    @foreach($errors->all() as $error)
	      <li>{{$error}}</li>
	    @endforeach

	  </ul>
	</div>       
@endif 