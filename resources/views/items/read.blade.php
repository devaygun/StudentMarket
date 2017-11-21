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
                                    <div class="panel-body">{{$item->price}}</div>
                                </div>
                            @elseif ($item->exchange_type == "swap")
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Swap for</h3>
                                    </div>
                                    <div class="panel-body">{{$item->trade}}</div>
                                </div>
                            @elseif ($item->exchange_type == "part-exchange")
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
                            <a href="/items" class="btn btn-info" role="button">Return</a>
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
                                    <label class="radio-inline"><input onchange="checkedSellType()" type="radio" name="sellType" checked>Sell</label>
                                </div>
                                <div class="form-group" style="display: inline-block">
                                    <label class="radio-inline"><input onchange="checkedSwapType()" type="radio" name="sellType">Swap</label>
                                </div>
                                <div class="form-group" style="display: inline-block">
                                    <label class="radio-inline"><input onchange="checkedPEType()" type="radio" name="sellType">Part-Exchange</label>
                                </div>

                                <div id="updatePriceForm" class="form-group">
                                    <label for="price">Price (£)</label>
                                    <input type="number" class="form-control" id="updatePrice" min="1" max="100000" value="{{$item->price}}" name="price" required>
                                </div>
                                <div id="updateSwapForm" class="form-group">
                                    <label for="swap">Swap for</label>
                                    <input type="text" class="form-control" id="updateSwap" min="1" max="255" value="{{$item->trade}}" name="swap" required>
                                </div>
                                <div id="updatePartExchangeForm" class="form-group">
                                    <label for="part-exchange">Part-Exchange for</label>
                                    <input type="text" class="form-control" id="updatePartExchange" min="1" max="255" value="{{$item->trade}}" name="part-exchange" required>
                                </div>

                                <button type="submit" class="btn btn-success">Update</button>
                                <button type="button" class="btn btn-primary">Mark as sold</button>
                                <button data-toggle="modal" data-target="#removeModal" type="button" class="btn btn-danger" style="float:right">Remove item</button>
                            </form>


                            <br><br>User is authorised to edit this item as they are the owner.<br>

                            <!-- Script -->
                            <script>

                                function checkedSellType() {
                                    document.getElementById('updatePriceForm').style.display = "block";
                                    document.getElementById('updatePrice').required = true;
                                    document.getElementById('updateSwap').value = "";
                                    document.getElementById('updateSwap').required = false;
                                    document.getElementById('updateSwapForm').style.display = "none";
                                    document.getElementById('updatePartExchange').value = "";
                                    document.getElementById('updatePartExchange').required = false;
                                    document.getElementById('updatePartExchangeForm').style.display = "none";
                                }
                                function checkedSwapType() {
                                    document.getElementById('updatePrice').value = "";
                                    document.getElementById('updatePrice').required = false;
                                    document.getElementById('updatePriceForm').style.display = "none";
                                    document.getElementById('updateSwap').value = "{{$item->trade}}";
                                    document.getElementById('updateSwap').required = true;
                                    document.getElementById('updateSwapForm').style.display = "block";
                                    document.getElementById('updatePartExchange').value = "";
                                    document.getElementById('updatePartExchange').required = false;
                                    document.getElementById('updatePartExchangeForm').style.display = "none";
                                }
                                function checkedPEType() {
                                    document.getElementById('updatePriceForm').style.display = "block";
                                    document.getElementById('updatePrice').required = true;
                                    document.getElementById('updateSwap').value = "";
                                    document.getElementById('updateSwap').required = false;
                                    document.getElementById('updateSwapForm').style.display = "none";
                                    document.getElementById('updatePartExchange').value = "{{$item->trade}}";
                                    document.getElementById('updatePartExchange').required = true;
                                    document.getElementById('updatePartExchangeForm').style.display = "block";
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
                                                {{--<button type="button" class="btn btn-info" data-dismiss="modal" style="float: left;"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>--}}
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
