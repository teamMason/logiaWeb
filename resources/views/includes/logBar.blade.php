
    <nav class="navbar navbar-inverse ">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="{{route('adminSite')}}">Muy Respetable Gran Logia de Edo. B.C. </a>
            </div>

        
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">                    
                    <li>
                        <a class="page-scroll" href="#portfolio">Contabilidad</a>
                    </li>                    
                    <li>
                        <a class="page-scroll" href="#services">Miembros</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Solicitudes</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#blog">Contacto</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{route('adminBlog')}}">Blog</a>
                    </li>
                    @if (Auth::guest())
                    <li>
                        <a class="page-scroll" href="">Login</a>
                    </li>
                    @else 
                    <li>{{Auth::user()->user}}</li>
                    <li><a href="{{route('logout')}}">Salir</a></li>
                    @endif
                </ul>
            </div>
                
            <!-- /.navbar-collapse -->
        </div>
        </nav>       
        <!-- /.container-fluid -->