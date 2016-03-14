<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    @include('includes.head')
</head>
<body>


@yield('content')
<footer>
    @include('includes.footer')
</footer>

</body>
<!--Scripts -->
<script src="assets/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Plugin JavaScript -->

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="{{ URL::to('assets/js/classie.js') }}"></script>
<script src="{{ URL::to('assets/js/cbpAnimatedHeader.js') }}"></script>
<script src="{{ URL::to('assets/js/agency.js') }}"></script>

</html>