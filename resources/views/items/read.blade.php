@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$item->name}}</div>

                    <div class="panel-body">
                        {{$item}}

                        // if $item->user_id == Auth::id() then enable edit button
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
