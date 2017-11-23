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

                        @if ($authorised)
                            {{-- TODO: Limit changes based on whether the item has received any offers or not. --}}

                            <form method="POST" action="/items/update/{{$item->id}}">
                                {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{old('name', $item->name)}}" name="name" minlength="2" maxlength="255" required>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<label for="name">Name</label>--}}
                                    {{--<input type="text" class="form-control" id="name" value="Nameee" name="name" minlength="2" maxlength="255" required>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" value="{{old('description', $item->description)}}" name="description" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label for="select" >Select a category</label>
                                    <select class="form-control" id="select" name="category">
                                        @foreach (\App\Category::all() as $category)
                                            <option value="{{$category->slug}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="display: inline-block">
                                    <label class="radio-inline"><input id="updatePriceRadio" onchange="updateCheckedSellType()" value="sell" type="radio" name="sellType" checked>Sell</label>
                                </div>
                                <div class="form-group" style="display: inline-block">
                                    <label class="radio-inline"><input id="updateSwapRadio" onchange="updateCheckedSwapType()" value="swap" type="radio" name="sellType">Swap</label>
                                </div>
                                <div class="form-group" style="display: inline-block">
                                    <label class="radio-inline"><input id="updatePartExchangeRadio" onchange="updateCheckedPEType()" value="part-exchange" type="radio" name="sellType">Part-Exchange</label>
                                </div>

                                <div id="updatePriceForm" class="form-group">
                                    <label for="price">Price (£)</label>
                                    <input type="number" class="form-control" id="updatePrice" min="1" max="100000" value="{{$item->price}}" name="price" required>
                                </div>
                                <div id="updateSwapForm" class="form-group">
                                    <label for="swap">Swap for</label>
                                    <input type="text" class="form-control" id="updateSwap" min="1" max="255" value="{{$item->trade}}" name="swap" required>
                                </div>
                                <a href="/items" class="btn btn-default" role="button">Return</a>
                                <button type="submit" class="btn btn-success">Update</button>
                                <button data-toggle="modal" data-target="#removeModal" type="button" class="btn btn-danger" style="float:right">Remove item</button>
                            </form>
                            <form method="POST" action="/items/sold/{{$item->id}}">
                                {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                                <button type="submit" class="btn btn-primary">Mark as sold</button>
                            </form>

                                <br><br>User is authorised to edit this item as they are the owner.<br>

                            <!-- Script -->
                            <script>

                                window.onload = function() {
                                    if ("{{$item->type}}" == 'sell') {
                                        updateCheckedSellType();
                                    }
                                    else if ("{{$item->type}}" == 'swap') {
                                        updateCheckedSwapType();
                                        document.getElementById("updateSwapRadio").checked = true;
                                    }
                                    else {
                                        updateCheckedPEType();
                                        document.getElementById("updatePartExchangeRadio").checked = true;
                                    }
                                }

                                function updateCheckedSellType() {
                                    document.getElementById('updatePriceForm').style.display = "block";
                                    document.getElementById('updatePrice').required = true;
                                    document.getElementById('updatePrice').value = "{{$item->price}}";
                                    document.getElementById('updateSwap').value = "";
                                    document.getElementById('updateSwap').required = false;
                                    document.getElementById('updateSwapForm').style.display = "none";
                                }
                                function updateCheckedSwapType() {
                                    document.getElementById('updatePrice').value = "";
                                    document.getElementById('updatePrice').required = false;
                                    document.getElementById('updatePriceForm').style.display = "none";
                                    document.getElementById('updateSwap').value = "{{$item->trade}}";
                                    document.getElementById('updateSwap').required = true;
                                    document.getElementById('updateSwapForm').style.display = "block";
                                    console.log("swap");
                                }
                                function updateCheckedPEType() {
                                    document.getElementById('updatePriceForm').style.display = "block";
                                    document.getElementById('updatePrice').required = true;
                                    document.getElementById('updatePrice').value = "{{$item->price}}";
                                    document.getElementById('updateSwap').value = "{{$item->trade}}";
                                    document.getElementById('updateSwap').required = true;
                                    document.getElementById('updateSwapForm').style.display = "block";
                                }
                            </script>

                            <!-- Modals -->
                            <div id="removeModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Are you sure you want to remove this item?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <label>This item will permanently be removed from Student Market</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                                            <form method="POST" action="/item/{{$item->id}}/remove">
                                                {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                                                <button type="submit" class="btn btn-danger" style="float:right">Remove item</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
