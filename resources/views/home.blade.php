<!DOCTYPE html>
<html lang="en">

<head>

    @include('includes.head')

</head>

<body id="page-top" class="index">
    
    
    <nav class="navbar navbar-default navbar-fixed-top">
        @include('includes.nav')
    </nav>


    <header id = "headerInit">
        @include('includes.header')
    </header>


    @include('includes.succes')
    
    <section id="portfolio" class="bg-light-gray">
        @include('sections.quienesSomos')
    </section>

    <section id="services"> 

        @include('sections.estandarte')
    </section>

      

    <section id="team" class="bg-light-gray">
        @include('sections.team')
    </section>
   
    @include('sections.modals')
   
     <section id = "blog" class="img-responsive img-centered" >
         @include('sections.news')
         <br><br>
    </section>
    <!-- Clients Aside -->
    <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="http://es.shrinershospitalsforchildren.org/" target="_blank">
                        <img src="assets/img/logos/shriners.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#" target="_blank">
                        <img src="assets/img/logos/designmodo.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="http://civilitycenter.org/" target="_blank">
                        <img src="assets/img/logos/civilitycenter.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="http://mrglbcs.org/" target="_blank">
                        <img src="assets/img/logos/mrglbcs.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
            </div>
        </div>
    </aside>


    <section id="contact">
         @include('sections.contacto')
    </section>
    <footer>
         @include('includes.footer')
    </footer>

     <!--Scripts -->
     <script src="assets/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->

    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
    <!-- Plugin JavaScript -->

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{{ URL::to('assets/js/classie.js') }}"></script>
    <script src="{{ URL::to('assets/js/cbpAnimatedHeader.js') }}"></script>
    <script src="{{ URL::to('assets/js/agency.js') }}"></script>

    <script>
         $(document).ready(function() {
              setTimeout(function() {
                  $(".alert-success").fadeOut(2000);
              },3000);
          });

        $("#team").on( "click", function() {
                $('#show').slideDown(); //oculto mediante id
                $('#teamDiv').slideUp();
                
        });
       
    </script>
   

</body>

</html>
