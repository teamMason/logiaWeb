


@extends('administrador.app')
@section('content')
<div class="container-fluid">
    <div class="row-fluid">
        <div class="panel panel-default">
            <div class="panel-heading ">                          
                <div ><label >Editar Artículo</label></div>               
            </div>
            <div class="panel-body">  
            <link href="{{ URL::asset('assets/css/trumbowyg.min.css') }}" rel="stylesheet">
                <div class="row-flui">                    
                    <div class="container">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            {!! Form::open(array('url' => '/admin/admin/post/'.$posts->id.'/refresh')) !!}
                                <fielset>
                                    <input type="text" name = 'title' value = "{{$posts->title}}" class = "form-control" required><br>
                                    <input type="text" name = 'tags' value = "{{$posts->tags}}" class = "form-control" required><br>
                                    
                                    <textarea name = 'content' id="editor" cols = '30'  rows = '15'  class = "form-control" required>
                                        {{$posts->content}}
                                    </textarea><br>  
                                    <input type="text" name = 'photo' value = "{{$posts->photo}}" class = "form-control" required><br>                    
                                    <input type="text" name = 'autor' value = "{{$posts->autor}}" class = "form-control" required><br>
                                   
                                    <select name="estatus" class = "form-control" required>
                                       <option value="{{$posts->estatus}}">{{$posts->estatus}}</option> 
                                       <option value="publicar">Publicar</option> 
                                       <option value="nopublicar">No publicar</option> 
                                       
                                    </select><br><br>
                                    <p>
                                        <input type="submit" value="Actualizar" class="btn btn-block btn-success btn-lx">
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
@endsection
@section('scripts')
     <script src="{{ URL::to('assets/js/trumbowyg.min.js') }}"></script>
    <script>
        $('#editor').trumbowyg();
    </script>
@stop   


