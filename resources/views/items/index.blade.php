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
                                @foreach ($items as $item)
                                    <tr>
                                        <td><a href="/items/{{$item->category->slug}}/{{$item->id}}" class="btn btn-info btn-sm" role="button">View</a></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td> @if ($item->type == "swap") -/- @else £{{$item->price}} @endif </td>
                                        <td>{{$item->trade}} @if ($item->type == "sell") -/- @endif </td>
                                        <td>{{$item->created_at->format('d/m/y \\a\\t H:i')}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
