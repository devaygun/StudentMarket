@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <i class="fa fa-times" aria-hidden="true"></i> {{ $error }}<br>
        @endforeach
    </div>
@endif

@if (\Illuminate\Support\Facades\Session::has('success'))
  <div class="alert alert-success">
      <i class="fa fa-check" aria-hidden="true"></i> {{ session('success') }}
  </div>
@endif

@if (\Illuminate\Support\Facades\Session::has('failure'))
    <div class="alert alert-danger">
        <i class="fa fa-times" aria-hidden="true"></i> {{ session('failure') }}
    </div>
@endif