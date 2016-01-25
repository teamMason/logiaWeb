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
                        {!! Form::open(['route'=> 'uploadBook', 'method' => 'POST', 'files'=>'true', 'id' => 'my-dropzone' , 'class' => 'dropzone']) !!}
                        <div class="dz-message" style="height:200px;">
                            <strong>Arrastra tus archivos aquí!</strong>
                        </div>
                        <div class="dropzone-previews"></div>
                        <button type="submit" class="btn btn-success" id="submit">Subir</button>
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>

    </div>


@section('scripts')
    {!! Html::script('assets/js/dropzone.js') !!}}
    <script>
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 10,
            maxFiles: 2,

            init: function() {
                var submitBtn = document.querySelector("#submit");
                myDropzone = this;

                submitBtn.addEventListener("click", function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on("addedfile", function(file) {
                    alert("Se agregó un archivo");
                });

                this.on("complete", function(file) {
                    myDropzone.removeFile(file);
                });

                this.on("success",
                        myDropzone.processQueue.bind(myDropzone)
                );
            }
        };
    </script>
@endsection

@stop