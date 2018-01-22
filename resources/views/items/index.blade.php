@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$category or 'Recently added items'}}</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

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
                                @include('components.item', ['items' => $items])
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
