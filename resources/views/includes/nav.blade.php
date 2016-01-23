<!-- Navigation -->
    
        <div class="container ">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class =  "visible-lg-block">                     
                    <a class="navbar-brand page-scroll" s href="#page-top">Muy Respetable Gran Logia de Estado Baja California.</a>
                </div>
                <div class =  "visible-xs-block visible-md-block visible-sm-block">                   
                    <a class="navbar-brand page-scroll" href="#page-top">M.·.R.·.G.·.L.·. de Edo. B.C.</a>
                </div>               
            </div>

        
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Acerca de</a>
                    </li>                    
                    <li>
                        <a class="page-scroll" href="#services">Lema</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Dignatarios</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#blog">News</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contacto</a>
                    </li>
                    @if(Auth::guest())

                         <li>
                            <a class="page-scroll" href="{{route('login')}}">Login</a>
                        </li>

                    @else
                        <li class="dropdown hidden-xs">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ str_limit(Auth::user()->name,5,' ') }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu" >
                                <li ><a href="{{route('adminSite')}}" id = 'outText' style = 'color: black;'>Admin</a></li>
                                <li ><a href="{{route('logout')}}" id = 'outText' style = 'color: black;'>Logout</a></li>
                            </ul>
                        </li>
                        <li class="visible-xs">
                            <a href="{{route('adminSite')}}" >Administrar</a>
                            <a href="{{route('logout')}}" >Cerrar Sesión</a>

                        </li>

                    @endif

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
   