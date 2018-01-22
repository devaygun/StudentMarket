@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Results <span class="badge badge-primary badge-pill">{{count($results)}}</span> </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Trade</th>
                            <th>Added on</th>
                        </tr>
                        </thead>
                        <tbody>
                            @include('components.item', ['items' => $results])
                        </tbody>
                    </table>
                    {{ $results->links() }}

                    <img src="/images/search-icon.png" alt="Algolia (search engine API)" style="height: 50px; width: 50px; float: right; z-index: -1;">
                </div>
            </div>
        </div>
    </div>
@endsection