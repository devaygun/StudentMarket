@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
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

                <div class="panel panel-default">
                    <div class="panel-heading">My Profile</div>

                    <div class="panel-body">
                        <form method="POST" action="{{ route('update_profile') }}" enctype="multipart/form-data">
                            {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="profile_picture">Profile Picture</label>
                                    <input type="file" accept="image/*" class="form-control" id="profile_picture" value="{{old('profile_picture', $user->profile_picture)}}" name="profile_picture">
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Names</label>
                                    <input type="text" class="form-control" id="first_name" value="{{old('first_name', $user->first_name)}}" name="first_name" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" value="{{old('last_name', $user->last_name)}}" name="last_name" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{old('email', $user->email)}}" name="email" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" value="{{old('date_of_birth', $user->date_of_birth)}}" name="date_of_birth" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="New password..." minlength="6" maxlength="255">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Password Confirmation</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password..." minlength="6" maxlength="255">
                                </div>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                            <div class="col-sm-6">
                                <div class="panel">
                                    <div class="panel-heading">Current Profile Picture</div>
                                    <div class="panel-body">
                                        <img src="{{asset('storage/' . $user->profile_picture)}}" alt="" style="display: block; max-width:100%; max-height:50%; width: auto; height: auto;">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
