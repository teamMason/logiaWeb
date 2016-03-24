@extends('administrador.app')
@section('content')

    <div class="container-fluid">
        <div class="row-fluid">
            @include('includes.errors')
            @include('includes.succes')
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="container-fluid">
                        <strong>Libros Sin publicar</strong>
                        <button class="btn btn-success pull-right" data-toggle="modal" title="Ver información"
                                data-target="#uploadArchivos"> Subir Libros
                        </button>
                    </div>
                </div>
                <div class="panel-body librosSinPublicar">
                    <div class="row">
                        <div class="container ">
                            @foreach($libros as $l)
                                @if($l->editado == 'false')
                                    <div class="col-xs-12 col-sm-4 ">
                                        <div class="panel panel-info libros">
                                            <div class="panel-heading">
                                                <strong>{{ str_limit($l->autor,20,' ') }}</strong>
                                            <span class="pull-right">
                                                <a href="" data-toggle="modal" title="Editar información"
                                                   data-target="#infoEdit-{{$l->id}}"><i class="fa fa-edit"></i></a>
                                                <a href="#my_modal" data-toggle="modal" data-book-id="{{$l -> id}}"><i
                                                            class="fa fa-trash"></i></a>
                                            </span>
                                            </div>

                                            <div class="panel-body">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <strong>{{$l->titulo}}</strong>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong><em>{{$l->grado}}</em></strong>
                                                    </li>
                                                </ul>
                                                <div class="pull-right">
                                                    <a href="../../../uploads/{{$l->titulo}}" target="_blank"
                                                       title="{{$l->titulo}}">Ver <i class="fa fa-eye"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--Libros Publicados -->
    <div class="container-fluid">
        <div class="row-fluid">
            @include('includes.errors')
            @include('includes.succes')
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="container-fluid">
                        <strong>Libros publicados</strong>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="container ">
                            @foreach($libros as $l)
                                @if($l->editado ==  'true')
                                    <div class="col-xs-12 col-sm-4 ">
                                        <div class="panel panel-info libros">
                                            <div class="panel-heading">
                                                <strong>{{ str_limit($l->autor,20,' ') }}</strong>
                                                <span class="pull-right">
                                                    <a href="" data-toggle="modal" title="Editar información"
                                                       data-target="#infoEdit-{{$l->id}}"><i class="fa fa-edit"></i></a>
                                                    <a href="#my_modal" data-toggle="modal" data-book-id="{{$l -> id}}"><i
                                                                class="fa fa-trash"></i></a>
                                                </span>
                                            </div>

                                            <div class="panel-body">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <em>{{ str_limit($l->titulo,35,' ') }}</em>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong><em>{{$l->grado}}</em></strong>
                                                    </li>
                                                </ul>
                                                <div class="pull-right">
                                                    <a href="../../../uploads/{{$l->slug}}" target="_blank"
                                                       title="{{$l->titulo}}">Ver <i class="fa fa-eye"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--Modal Subir Archivos -->
    <div id="uploadArchivos" class="modal fade " role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Subir Archivos</h4>
                </div>

                <div class="modal-body">
                    <div class="alert-info text-center">
                        <p>
                            Puedes subir Varios archivos a la vez, una vez subidos, puedes editar su autor, título y
                            grado para controlar quien tiene acceso a ellos.
                            Solo puedes subir archivos <strong>PDF</strong> de un <strong>MAX</strong> de
                            <strong>10M</strong> por subida.

                        </p>
                    </div>
                    <div class="panel panel-default">

                        {!! Form::open(['url'=> 'admin/biblioteca/upload', 'method' => 'POST', 'files'=>true, 'id' => 'uploadPDF' ]) !!}

                        {!!Form::file('file[]', ['class' => 'form-control', 'required' => 'required', 'multiple']) !!}
                    </div>
                    <button type="submit" class="btn btn-success">Enviar Archivos</button>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>

    <!--Modal Borrar -->
    <div class="modal fade" id="my_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Estas seguro de Borrar</h4>
                </div>
                {!! Form::open(array('url' => '/admin/biblioteca/')) !!}
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
    <!--Modal paea editar-->
    @foreach($libros as $l)
        <div id="infoEdit-{{$l->id}}" class="modal fade " role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Información de: </h4>
                    </div>

                    <div class="modal-body">
                        {!! Form::model(Request::all(),array('action' => array('adminController@editBook',$l->id)),['method' => 'post'])!!}
                        <fielset>
                            <strong><span>Autor:</span></strong>
                            <input type="text" name='autor' value="{{$l->autor}}" class="form-control"><br>
                            <strong><span>Título:</span></strong>
                            <input type="text" name='titulo' value="{{$l->titulo}}" class="form-control " required><br>
                            <strong><span>Grado:</span></strong>
                            <input type="number" min="1" max="3" name='grado' value="{{$l->grado}}" class="form-control"
                                   required><br>

                        </fielset>
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success "> Guardar</button>
                        <button type="button" class="btn btn-default " data-dismiss="modal"> Cerrar</button>

                    </div>
                    {!!Form::close()!!}


                </div>
            </div>
        </div>
    @endforeach


@section('scripts')
    <script>
        $('#my_modal').on('show.bs.modal', function (e) {
            var borrarId = $(e.relatedTarget).data('book-id');
            $(e.currentTarget).find('input[name="borrarId"]').val(borrarId);
        });
    </script>
@endsection




@stop