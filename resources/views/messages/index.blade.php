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
                    @foreach ($messages as $message)
                        <li class="active">
                            <a href="messages/{{$message->sender_id}}">
                                <span>{{\App\User::where('id', ($message->sender_id))->first()->first_name}}</span>
                                <span style="float: right">Last message recieved: {{$message->created_at->format('d/m/y H:i')}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>





    {{--SCRIPTS--}}

    <!-- MODALS -->


@endsection
