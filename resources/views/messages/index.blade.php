@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Messages</h2>
        </div>
        {{--MESSAGE LIST--}}
        <div class="col-sm-12">
            <ul class="nav nav-pills nav-stacked">
                @foreach ($userList as $mUser)
                    <li class="active">
                        @if ($mUser->sender_id != null)
                        <a href="/messages/{{$mUser->sender_id}}">
                            <span>{{\App\User::where('id', ($mUser->sender_id))->first()->first_name}}</span>
                            {{--<span style="float: right">Last message received: {{$mUser->created_at->format('d/m/y H:i')}}</span>--}}
                        </a>
                        @endif
                        @if ($mUser->receiver_id != null)
                            <a href="/messages/{{$mUser->receiver_id}}">
                                <span>{{\App\User::where('id', ($mUser->receiver_id))->first()->first_name}}</span>
                                {{--<span style="float: right">Last message received: {{$mUser->created_at->format('d/m/y H:i')}}</span>--}}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
