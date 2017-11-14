@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$item->name}}</div>

                    <div class="panel-body">
                        <a href="/{{$item->category->slug}}/items" class="btn btn-info btn-sm" role="button">Return</a>
                        {{$item}}


                        @if ($authorised)
                            <br><br>User is authorised to edit this item as they are the owner.<br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
