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
                        <h3 class="panel-title">{{$item->name}}</h3>
                    </div>

                    <div class="panel-body">

                        @if (!$authorised)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Description</h3>
                                </div>
                                <div class="panel-body">{{old('description', $item->description)}}</div>
                            </div>

                            @if ($item->exchange_type == "sell")
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Price (£)</h3>
                                    </div>
                                    <div class="panel-body">{{$item->requested_price}}</div>
                                </div>
                            @elseif ($item->exchange_type == "swap")
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Swap for</h3>
                                    </div>
                                    <div class="panel-body">{{$item->requested_item}}</div>
                                </div>
                            @elseif ($item->exchange_type == "part-exchange")
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Price (£)</h3>
                                    </div>
                                    <div class="panel-body">{{$item->requested_price}}</div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Swap for</h3>
                                    </div>
                                    <div class="panel-body">{{$item->requested_item}}</div>
                                </div>
                            @endif
                            <a href="/{{$item->category->slug}}/items" class="btn btn-info" role="button">Return</a>
                            <button type="submit" class="btn btn-primary">Make Offer</button>

                        @else
                            {{-- TODO: Limit changes based on whether the item has received any offers or not. --}}

                            <form method="POST" action="/items/{{$category}}/{{$item->id}}">
                                {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{old('name', $item->name)}}" name="name" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" value="{{old('description', $item->description)}}" name="description" minlength="2" maxlength="255" required>
                                </div>

                                <div class="form-group" style="display: inline-block">
                                    <label class="radio-inline"><input onchange="checkedSellType()" type="radio" name="sellType">Sell</label>
                                </div>
                                <div class="form-group" style="display: inline-block">
                                    <label class="radio-inline"><input onchange="checkedSwapType()" type="radio" name="sellType">Swap</label>
                                </div>
                                <div class="form-group" style="display: inline-block">
                                    <label class="radio-inline"><input onchange="checkedPEType()" type="radio" name="sellType">Part-Exchange</label>
                                </div>

                                <div id="sell-input-form" class="form-group">
                                    <label for="price">Price (£)</label>
                                    <input type="number" class="form-control" id="price" min="1" max="100000" value="{{$item->requested_price}}" name="price" required>
                                </div>
                                <div id="swap-input-form" class="form-group">
                                    <label for="swap">Swap for</label>
                                    <input type="text" class="form-control" id="swap" min="1" max="255" value="{{$item->requested_item}}" name="swap" required>
                                </div>
                                <div id="pe-input-form" class="form-group">
                                    <label for="part-exchange">Part-Exchange for</label>
                                    <input type="text" class="form-control" id="part-exchange" min="1" max="255" value="{{$item->requested_item}}" name="part-exchange" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-info">Mark as sold</button>
                                <button type="button" class="btn btn-danger" href="" style="float:right">Remove item</button>

                            </form>

                            <br><br>User is authorised to edit this item as they are the owner.<br>

                            <script>
                                var sell_input = document.getElementById("price");
                                var swap_input = document.getElementById("swap");
                                var part_exchange_input = document.getElementById("part-exchange");
                                var sell_input_form = document.getElementById("price-input-form");
                                var swap_input_form = document.getElementById("swap-input-form");
                                var part_exchange_input_form = document.getElementById("pe-input-form");

                                    window.onload = function() {
                                        checkedSellType();
                                    }

                                function checkedSellType() {
                                        sell_input_form.style.display = "block";
                                        sell_input.required = true;
                                        swap_input.value = "";
                                        swap_input.required = false;
                                        swap_input_form.style.display = "none";
                                        part_exchange_input.value = "";
                                        part_exchange_input.required = false;
                                        part_exchange_input_form.style.display = "none";
                                }

                                function checkedSwapType() {
                                        sell_input.value = "";
                                        sell_input.required = false;
                                        sell_input_form.style.display = "none";
                                        swap_input.value = "Anything...";
                                        swap_input.required = true;
                                        swap_input_form.style.display = "block";
                                        part_exchange_input.value = "";
                                        part_exchange_input.required = false;
                                        part_exchange_input_form.style.display = "none";
                                }

                                function checkedPEType() {
                                        sell_input_form.style.display = "block";
                                        sell_input.required = true;
                                        swap_input.value = "";
                                        swap_input.required = false;
                                        swap_input_form.style.display = "none";
                                        part_exchange_input.value = "Anything...";
                                        part_exchange_input.required = true;
                                        part_exchange_input_form.style.display = "block";
                                }
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
