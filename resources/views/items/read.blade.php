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
                            {{-- TODO: Limit changes based on whether the item has received any offers or not. --}}

                            <form method="POST" action="/{{$category}}/item/{{$item->id}}">
                                {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{old('name', $item->name)}}" name="name" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" value="{{old('description', $item->description)}}" name="description" minlength="2" maxlength="255" required>
                                </div>

                                <div class="form-group">
                                    <label class="radio-inline"><input type="radio" name="sell">Sell</label>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price (£)</label>
                                    <input type="number" class="form-control" id="price" min="1" max="100000" value="{{$item->requested_price}}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>

                            <br><br>User is authorised to edit this item as they are the owner.<br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
