@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <i class="fa fa-times" aria-hidden="true"></i> {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                @if (\Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success">
                        <i class="fa fa-check" aria-hidden="true"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 style="display:inline-block" class="panel-title">{{$item->name}}</h3>
                        @if ($item->sold == true) <label class="label label-default">Note: This item has been sold</label> @endif
                    </div>

                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Description</h3>
                            </div>
                            <div class="panel-body">{{old('description', $item->description)}}</div>
                        </div>

                        @if ($item->type == "sell")
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Price (£)</h3>
                                </div>
                                <div class="panel-body">{{$item->price}}</div>
                            </div>
                        @elseif ($item->type == "swap")
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Swap for</h3>
                                </div>
                                <div class="panel-body">{{$item->trade}}</div>
                            </div>
                        @elseif ($item->type == "part-exchange")
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Price (£)</h3>
                                </div>
                                <div class="panel-body">{{$item->price}}</div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Swap for</h3>
                                </div>
                                <div class="panel-body">{{$item->trade}}</div>
                            </div>
                        @endif
                        <a href="/items" class="btn btn-default" role="button">Return</a>

                        @if (!$authorised)
                            <button type="button" class="btn btn-primary">Make Offer</button>
                        @endif

                        @if ($authorised)
                            <a href="/items/update/{{$item->id}}" class="btn btn-primary">Edit</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
