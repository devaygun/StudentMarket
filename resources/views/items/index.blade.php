@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Items</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h4>Items found in {{$category}}.</h4>

                        @foreach ($items as $item)
                            {{dump($item)}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
