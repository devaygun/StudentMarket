@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->first_name}} {{$user->last_name}}</div>
                <div class="row">
                    <div class="col-sm-4">
                        @if ($user->profile_picture)
                            <img src="{{asset('storage/' . $user->profile_picture)}}" class="img-responsive" alt="">
                        @else
                            <img src="{{asset('images/default_profile.jpg')}}" class="img-responsive" alt="">
                        @endif
                    </div>
                    <div class="col-sm-8">
                        <table class="table table-striped">
                            <thead>
                            <th></th>
                            <tr><th>Email Address: {{$user->email}}</th></tr>
                            <tr><th>Rating:</th></tr>
                            <tr><th>Member since: {{$user->created_at->format('jS \\ F Y')}}</th></tr>
                            </thead>
                        </table>
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

            @if (\App\Review::all()->where('seller_id', $user->id))
                <h2>Reviews</h2>
                @foreach(\App\Review::all()->where('seller_id', $user->id) as $review)
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{\App\User::where('id', ($review->buyer_id))->first()->first_name}}</div>
                            <div class="panel-body">
                                {{$review->review}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
