   @if(\Session::has('alert'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>{{Session::get('alert')}}</strong>
    </div>
  @elseif((\Session::has('alert-danger')))
       <div class="alert alert-danger">
           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
           <strong>{{Session::get('alert-danger')}}</strong>
       </div>

  @endif
