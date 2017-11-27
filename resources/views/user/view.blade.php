@extends('layouts.app')

@section('content')
    <div class="container">

            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$user->first_name}} {{$user->last_name}}</div>
                    <div class="row">
                        <div class="col-sm-4"><img src="{{asset('storage/' . $user->profile_picture)}}" alt="" style="display: block; max-width:100%; max-height:100%; width: auto; height: auto;"></div>
                        <div class="col-sm-8"><table class="table table-striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <td>Email Address: {{$user->email}}</td>
                                    <td>Rating:</td>
                                    <td>Member since: {{$user->created_at->format('jS \\ F Y')}}</td>
                                </tr>
                                </thead>
                        </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection