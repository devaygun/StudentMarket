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
                        <form method="POST" action="/items/{{$item->id}}/created">
                            {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" value="" name="name" minlength="2" maxlength="255" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" value="" name="description" minlength="2" maxlength="255" required>
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

                            <div id="createPriceForm" class="form-group">
                                <label for="price">Price (£)</label>
                                <input type="number" class="form-control" id="createPrice" min="1" max="100000" value="" name="price" required>
                            </div>
                            <div id="createSwapForm" class="form-group">
                                <label for="swap">Swap for</label>
                                <input type="text" class="form-control" id="createSwap" min="1" max="255" value="" name="swap" required>
                            </div>
                            <div id="createPartExchangeForm" class="form-group">
                                <label for="part-exchange">Part-Exchange for</label>
                                <input type="text" class="form-control" id="createPartExchange" min="1" max="255" value="" name="part-exchange" required>
                            </div>

                            <button type="submit" class="btn btn-success">create</button>
                            <button type="button" class="btn btn-primary">Mark as sold</button>
                            <button data-toggle="modal" data-target="#removeModal" type="button" class="btn btn-danger" style="float:right">Remove item</button>
                        </form>


                        <br><br>User is authorised to edit this item as they are the owner.<br>

                        <!-- Script -->
                        <script>

                            function checkedSellType() {
                                document.getElementById('createPriceForm').style.display = "block";
                                document.getElementById('createPrice').required = true;
                                document.getElementById('createSwap').value = "";
                                document.getElementById('createSwap').required = false;
                                document.getElementById('createSwapForm').style.display = "none";
                                document.getElementById('createPartExchange').value = "";
                                document.getElementById('createPartExchange').required = false;
                                document.getElementById('createPartExchangeForm').style.display = "none";
                            }
                            function checkedSwapType() {
                                document.getElementById('createPrice').value = "";
                                document.getElementById('createPrice').required = false;
                                document.getElementById('createPriceForm').style.display = "none";
                                document.getElementById('createSwap').value = "";
                                document.getElementById('createSwap').required = true;
                                document.getElementById('createSwapForm').style.display = "block";
                                document.getElementById('createPartExchange').value = "";
                                document.getElementById('createPartExchange').required = false;
                                document.getElementById('createPartExchangeForm').style.display = "none";
                            }
                            function checkedPEType() {
                                document.getElementById('createPriceForm').style.display = "block";
                                document.getElementById('createPrice').required = true;
                                document.getElementById('createSwap').value = "";
                                document.getElementById('createSwap').required = false;
                                document.getElementById('createSwapForm').style.display = "none";
                                document.getElementById('createPartExchange').value = "";
                                document.getElementById('createPartExchange').required = true;
                                document.getElementById('createPartExchangeForm').style.display = "block";
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
