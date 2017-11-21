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
                        <form method="POST" action="{{ route('update_profile') }}">
                            {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
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
                            <button data-toggle="modal" data-target="#uploadModal" type="button" class="btn btn-primary">Upload Profile Avatar</button>
                        </form>

                        <!-- Modals -->
                        <div id="uploadModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Upload Profile Avatar</h4>
                                    </div>
                                    <div class="modal-body">
                                        <img src="http://www.cdn.innesvienna.net//Content/user-default.png" alt="profile-avatar" width="200px" height="200px">
                                        <div>
                                            <button type="submit" class="btn btn-info">Browse...</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: left;"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                                        <button type="button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Save</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
