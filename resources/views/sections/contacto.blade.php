    <!-- Contact Section -->
    
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contacto</h2>
                    <h3 class="section-subheading text-muted">Estamos para aclarar tus dudas.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    {!! Form::open(array('route' => array('SendBuzon'))) !!}
                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nombre " name="nombre" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Correo Electrónico " name="email" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Número de Teléfono " name="telefono" required >
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Mensaje *" name="mensaje" required></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <input type="hidden" value="sinLeer" name="leido">
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">                                
                                <button type="submit" id ="contact"class="btn btn-xl" data-toggle="modal" data-target="#myModal">Enviar Mensaje</button>
                            </div>
                        </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>

      

   
