@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Messages</h2>
            </div>
            {{--MESSAGE LIST--}}
            <div class="col-sm-3">
                <ul class="nav nav-pills nav-stacked">
                    @foreach ($userList as $mUser)
                        <li class="active">

                            @if ($mUser->sender_id != null)
                                <a href="/messages/{{$mUser->sender_id}}">
                                    <span>{{\App\User::where('id', ($mUser->sender_id))->first()->first_name}}</span>
                                    {{--<span style="float: right">Last message received: {{$mUser->created_at->format('d/m/y H:i')}}</span>--}}
                                </a>
                            @endif
                            @if ($mUser->receiver_id != null))
                            <a href="/messages/{{$mUser->receiver_id}}">
                                <span>{{\App\User::where('id', ($mUser->receiver_id))->first()->first_name}}</span>
                                {{--<span style="float: right">Last message received: {{$mUser->created_at->format('d/m/y H:i')}}</span>--}}
                            </a>
                            @endif

                        </li>
                    @endforeach
                </ul>
            </div>
            {{--MESSAGE VIEW--}}
            <div class="col-sm-9">
                <div class="well chat-container" id="chatContainer">
                    @foreach ($messages as $message)
                        <div class="chat-bubble panel panel-primary chat-bubble"
                            @if ($message->sender_id == Auth::id())) from="user" @endif
                            @if ($message->sender_id != Auth::id())) from="recipient" @endif
                        >
                            <div class="panel-heading">
                                <h3 class="panel-title"><a href="/view/{{$message->sender_id}}" title="View Profile">{{\App\User::where('id', ($message->sender_id))->first()->first_name}}</a></h3>
                            </div>
                            <div class="panel-body">
                                {{$message->message}}
                            </div>
                            <div class="timestamp">{{$message->created_at->format('d/m/y H:i')}}</div>
                        </div>
                    @endforeach
                </div>
                <form method="POST" action="/messages/{{$recipient}}" enctype="multipart/form-data">
                    {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                    <div class="form-group">
                        <label for="message" class="control-label"></label>
                        <textarea class="form-control" name="message" rows="2" id="message"></textarea>
                        <button type="submit" class="btn btn-success" id="sendButton">Send</button>
                    </div>

                </form>
            </div>
        </div>
    </div>





    {{--SCRIPTS--}}

    <script>

        $(document).ready(function(){
            var chatContainer = document.getElementById("chatContainer");
            chatContainer.scrollTop = chatContainer.scrollHeight;
        });
    </script>

    <!-- MODALS -->

    {{--STYLES--}}

    <style>

        .chat-container {
            max-height: 400px;
            height: 400px;
            overflow-y: scroll;
        }

        .chat-bubble {
            max-width: 45%;
            clear: both;
            min-width: 130px;
            position: relative;
        }

        .chat-bubble:hover .timestamp {
            transform: translateX(calc(100% + 10px));
        }

        .chat-bubble[from="user"]:hover .timestamp {
            transform: translateX(calc(-100% - 10px));
        }

        .chat-bubble .timestamp {
            padding: 5px 10px;
            position: absolute;
            top: 0;
            right: 0;
            z-index: 0;
            max-width: 100%;
            background: #1a1a1a1a;
            font-weight: 700;
            border-radius: 0 0 3px 3px;
            transform: translateX(0);
            -webkit-transition: all ease .3s;
            -moz-transition: all ease .3s;
            -ms-transition: all ease .3s;
            -o-transition: all ease .3s;
            transition: all ease .3s;
        }

        .chat-bubble[from="user"] .timestamp {
            right: auto;
            left: 0;
        }

        .chat-bubble .panel-heading {
            position: relative;
            z-index: 1;
        }

        [from="user"] {
            float: right;
        }

        [from="user"] .panel-heading {
            text-align: right;
        }

        [from="recipient"] {
            float: left;
        }

        [from="recipient"] .panel-heading {
            background: #75caeb;
        }

        #message {
            resize: none;
            height: 80px;
            line-height: 20px;
            width: calc(100% - 100px);
            display: inline-block;
        }

        #sendButton {
            height: 80px;
            width: 90px;
            display: inline-block;
            float: right;
        }


    </style>

@endsection
