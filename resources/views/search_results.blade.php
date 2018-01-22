@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Results <span class="badge badge-primary badge-pill">{{$results->total()}}</span> </div>
                <div class="panel-body">
                    @include('components.item', ['items' => $results])

                    <img src="/images/search-icon.png" alt="Algolia (search engine API)" style="height: 50px; width: 50px; float: right; z-index: -1;">
                </div>
            </div>
        </div>
    </div>
@endsection