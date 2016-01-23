   @if(\Session::has('alert'))
    <div class="alert alert-success">
      <strong>{{Session::get('alert')}}</strong>
    </div>
  @endif   