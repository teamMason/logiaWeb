@extends('administrador.app')
@section('content')
<div class="container-fluid">
    <div class="row-fluid">
        <div class="panel panel-default">
            <div class="panel-heading ">                          
                <div ><label >Crear nuevo Artículo</label></div>               
            </div>
            <div class="panel-body">                    
                    <div class="container" id="admin">
                            <link href="{{ URL::asset('assets/css/trumbowyg.min.css') }}" rel="stylesheet">
                            <div class="row-flui">                              
                                <div class="container">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        {!! Form::open(array('url' => '/admin/admin/post/nuevo')) !!}
                                            <fielset>
                                                <input type="text" name = 'title' placeholder = "Titulo del Post" class = "form-control" required><br>
                                                <input type="text" name = 'tags' placeholder = "Tags (Etiquetas Separadas por Comas)" class = "form-control" required><br>
                                                
                                                <textarea name = 'content' id="editor" cols = '30'  rows = '15'  class = "form-control" placeholder = "Contenido del Post..." required> 
                                                    
                                                </textarea><br>  
                                                <input type="text" name = 'photo' placeholder = "Imagen del Post" class = "form-control" required><br>                    
                                                <input type="text" name = 'autor' placeholder = "Autor del Post" class = "form-control" required><br>
                                               
                                                <select name="estatus" class = "form-control" required>
                                                   <option value="">Seleccionar</option> 
                                                   <option value="publicar">Publicar</option> 
                                                   <option value="nopublicar">No publicar</option> 
                                                   
                                                </select><br><br>
                                                <p>
                                                    <input type="submit" value="Crear" class="btn btn-block btn-success btn-lg">
                                                </p>
                                                    
                                            </fielset>
                                        {!!Form::close()!!}

                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>                  
                    </div>                
            </div>
        </div>
    </div>
</div>  
@endsection
@section('scripts')
     <script src="{{ URL::to('assets/js/trumbowyg.min.js') }}"></script>
    <script>
        $('#editor').trumbowyg();
    </script>
@stop	




