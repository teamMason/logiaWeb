<!DOCTYPE html>
<html lang="en">

<head>   

	@include('includes.head') 
    <link href="{{ URL::asset('assets/css/agency.css') }}" rel="stylesheet">

    <title>@yield('titlePage')</title>
</head>

<body class="index">

     @yield('content')
     <span class="btn btn-default navButtonLeft" onClick="history.back()"><i class="fa fa-chevron-left"></i></span>
     <span class="btn btn-default navButtonUp"><i class="fa fa-chevron-up"></i></span>

    
   
    <footer>
         @include('includes.footer')
    </footer>
   <script src="{{ URL::to('assets/js/jquery.js') }}"></script>    
    <!-- Bootstrap Core JavaScript -->  
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>  
    <!-- Plugin JavaScript -->

    
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{{ URL::to('assets/js/classie.js') }}"></script>
    <script src="{{ URL::to('assets/js/cbpAnimatedHeader.js') }}"></script>
    <script src="{{ URL::to('assets/js/agency.js') }}"></script>
    <script src="{{ URL::to('assets/js/buttonBack.js') }}"></script>
   
</body>
</html>
    