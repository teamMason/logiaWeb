@extends('administrador.app')
@section('content')

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="container-fluid">
                        <strong>Editor de Libros</strong>
                        <div class="pull-right ">

                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="panel-body">
                        {!! Form::open(['url'=> 'admin/biblioteca/upload', 'method' => 'POST', 'files'=>true, 'id' => 'my-dropzone' , 'class' => 'dropzone']) !!}
                        <div class="dz-message" style="height:200px;">
                            <strong>Arrastra tus archivos aquí!</strong><br>
                            <span class="note">Para subir los archivos debes dar click al botón.</span>
                        </div>
                        <div class="dropzone-previews"></div>
                        <button type="submit" class="btn btn-success" id="submit-all">Enviar Archivos</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>


@section('scripts')

    <script src="{{ URL::to('assets/js/dropzone.js') }}"></script>
    <script>
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 10,
            maxFiles: 10,

            init: function() {
                var submitBtn = document.querySelector("#submit-all");
                myDropzone = this;

                submitBtn.addEventListener("click", function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on("addedfile", function(file) {
                    //alert("Se agregó un archivo");
                });

                this.on("complete", function(file) {
                    myDropzone.removeFile(file);
                });

            }
        };
    </script>
@endsection

@stop