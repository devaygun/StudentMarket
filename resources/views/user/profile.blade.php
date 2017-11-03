@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">My Profile</div>

                    <div class="panel-body">
                        {{dump($user)}}

                        <form>
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" class="form-control" id="first_name" value="{{$user->first_name}}">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" value="{{$user->last_name}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
