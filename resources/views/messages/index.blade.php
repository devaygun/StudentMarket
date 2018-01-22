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
                    @foreach ($messages as $message)
                        <li class="active"><a href="#">{{\App\User::where('id', ($message->sender_id))->first()->first_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            {{--MESSAGE VIEW--}}
            <div class="col-sm-9">
                <div class="well">
                    messages...
                </div>
                <form method="POST" action="/messages/{$id}" enctype="multipart/form-data">
                    {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                    <div class="form-group">
                        <label for="message" class="control-label"></label>
                        <textarea class="form-control" name="message" rows="4" id="message"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>





    {{--SCRIPTS--}}

    <!-- MODALS -->


@endsection
