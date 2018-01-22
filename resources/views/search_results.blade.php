@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Results <span class="badge badge-primary badge-pill">{{$results->total()}}</span>

                    <img src="/images/search-by-algolia.png" alt="Algolia (search engine API)" style="height: 18px; width: 130px; float: right; z-index: -1;">
                </div>
                <div class="panel-body">

                    @include('components.item', ['items' => $results])
                </div>
            </div>
        </div>
    </div>
@endsection