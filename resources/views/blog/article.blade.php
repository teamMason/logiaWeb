@extends('../templates/layout')
@section('content')
    <head>
        @include('includes.head')
    </head>


    <!--<img src="{{$posts->photo}}" title = "{{$posts -> title}}">-->

    <div class="row-fluid" style="background-image: url('{{$posts->photo}}'); min-height: 50vh; background-size: cover; background-position: center; background-attachment: fixed ">
        <div id="artitle">
            {{$posts-> title}}
        </div>
    </div>

    <div class="row-fluid" id="articleSection">
        <br><br>
        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8" align="left">
                <span><i class="fa fa-user"></i> {{$posts->autor}} </span><span> | <i
                            class="fa fa-calendar"></i> {{substr($posts->created_at, 0, 10 )}} </span><br>

                <p class="text-right" >
                    {!! $posts->content !!}
                </p>
                <br>
                <div align="center">
                    <?php
                    $tags = explode(',', $posts->tags)
                    ?>
                    <i class="fa fa-tags "></i>
                    @foreach($tags as $t)
                        <a href="../tag/{{$t}}"><label class="label label-primary">{{$t}}</label></a>
                    @endforeach

                </div>
                <br>


                <div class="fb-comments" data-href="http://granlogiadeedobc.com/news/{{$posts->slug}}" data-width="100%"
                     data-numposts="10"></div>
            </div>
        </div>
    </div>

    <!--Comentarios Facebook -->

    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>





@stop