@extends('administrador.app')
@section('content')

    <div class="container-fluid">
        <div class="row-fluid">
            @include('includes.errors')
            @include('includes.succes')
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="container-fluid">
                        <strong>Editor de Libros</strong>
                        <button class="btn btn-success pull-right" data-toggle="modal" title="Ver información" data-target="#uploadArchivos"> Subir Libros</button>
                        <div class="pull-right ">

                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="container">
                            @foreach($libros as $l)
                            <div class="col-xs-12 col-sm-4 ">
                                <div class="thumbnail text-center">
                                    <i class="fa fa-book fa-5x"></i>
                                    <div class="caption">
                                        <h3>{{ str_limit($l->titulo,10,' ') }}</h3>
                                        <p>Grado 3</p>
                                        <a href="#" class="btn btn-warning" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="#" class="btn btn-danger" role="button"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
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

            <div class="modal-body" >
                <div class="alert-info text-center">
                    <p>
                        Puedes subir Varios archivos a la vez, una vez subidos, puedes editar su título y grado para controlar quien tiene acceso a ellos.
                        Solo puedes subir archivos <strong>PDF</strong> de un <strong>MAX</strong> de <strong>10M</strong>

                    </p>
                </div>
                <div class="panel panel-default">

                    {!! Form::open(['url'=> 'admin/biblioteca/upload', 'method' => 'POST', 'files'=>true, 'id' => 'uploadPDF' ]) !!}

                        {!!Form::file('file[]', ['class' => 'form-control', 'required' => 'required', 'multiple']) !!}
                </div>
                <button type="submit"  class="btn btn-success" >Enviar Archivos</button>
                {!! Form::close() !!}


            </div>
        </div>
     </div>
</div>

@section('scripts')


@endsection




@stop