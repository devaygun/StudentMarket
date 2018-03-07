@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @include('components.status')
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$item->name}}</h3>
                    </div>
                    <div class="panel-body">
                        @if ($authorised)
                            @if ($item->images->isNotEmpty())
                                <div class="row">
                                    @foreach ($item->images as $image)
                                        <div class="col-sm-3 image_{{$image->id}}">
                                            <img src="{{asset("storage/$image->path")}}" alt="" class="image_preview" style="margin: 0 0 10px 0;" data-toggle_tooltip="tooltip" title="Click to view larger">
                                            <button class="btn btn-danger btn-sm remove_image_btn center-block" id="{{$image->id}}"><i class="fa fa-times" aria-hidden="true"></i> Remove</button>

                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                            @endif
                            {{-- TODO: Limit changes based on whether the item has received any offers or not. --}}
                            {{--UPDATE ITEM FORM--}}
                            <form method="POST" action="/items/update/{{$item->id}}" enctype="multipart/form-data" id="update_form">
                                {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                                <div class="form-group">
                                    <label for="images">Select Images</label>
                                    <p>Press <kbd>Ctrl</kbd> or <kbd>command ⌘</kbd> to select multiple images.</p>
                                    <input type="file" accept="image/*" class="form-control" id="images" value="{{old('images')}}" name="images[]" multiple>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{old('name', $item->name)}}" name="name" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" value="{{old('description', $item->description)}}" name="description" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label for="select" >Select a category</label>
                                    <select class="form-control" id="select" name="category_id">
                                        @foreach (\App\Category::all() as $category)
                                            <option id="select{{$category->id}}" value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="display: inline-block">
                                    <label class="radio-inline"><input id="updatePriceRadio" onchange="updateCheckedSellType()" value="sell" type="radio" name="type" checked>Sell</label>
                                </div>
                                <div class="form-group" style="display: inline-block">
                                    <label class="radio-inline"><input id="updateSwapRadio" onchange="updateCheckedSwapType()" value="swap" type="radio" name="type">Swap</label>
                                </div>
                                <div class="form-group" style="display: inline-block">
                                    <label class="radio-inline"><input id="updatePartExchangeRadio" onchange="updateCheckedPEType()" value="part-exchange" type="radio" name="type">Part-Exchange</label>
                                </div>

                                <div id="updatePriceForm" class="form-group">
                                    <label for="price">Price (£)</label>
                                    <input type="number" class="form-control" id="updatePrice" min="1" max="100000" value="{{$item->price}}" name="price" required>
                                </div>
                                <div id="updateSwapForm" class="form-group">
                                    <label for="trade">Swap for</label>
                                    <input type="text" class="form-control" id="updateSwap" min="1" max="255" value="{{$item->trade}}" name="trade" required>
                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags (Separate with spaces e.g Red Car New)</label>
                                    <input type="text" class="form-control" id="tags"
                                           value="@foreach($tags as $tag){{$tag}} @endforeach"
                                           name="tags" maxlength="255">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input id="checkboxSold" type="checkbox" value="true" name="sold"> Mark as sold
                                    </label>
                                </div>
                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
                                <a href="/items/{{$item->category->slug}}/{{$item->id}}" class="btn btn-default" role="button">Return</a>
                                <a id="submit_form" href="javascript:void(0);">
                                    <button type="submit" class="btn btn-success" id="update_button">Update</button>
                                </a>
                                <input type="submit" value="Submit" style="display: none;">

                                <span id="updating"></span>
                                <button data-toggle="modal" data-target="#removeModal" type="button" class="btn btn-danger" style="float:right">Remove item</button>
                            </form>

                            <br><br>User is authorised to edit this item as they are the owner.<br>
                            <!-- Script -->
                            <script>
                                var form = document.querySelector('#update_form');

                                var submit_form_btn = document.querySelector('#submit_form');

                                submit_form_btn.addEventListener('click', function () {
                                    if (form.checkValidity()) {
                                        $("body").css("cursor", "progress");
                                        $("#updating").html('<i class="fa fa-spinner fa-pulse fa-lg" style="margin-left: 10px;"></i>');

                                        if (navigator.geolocation) {
                                            setTimeout(function() {
                                                $("#update_form").submit();
                                            }, 5000);

                                            navigator.geolocation.getCurrentPosition (
                                                function (position) {
                                                    latitude = position.coords.latitude;
                                                    longitude = position.coords.longitude;
                                                    console.log(latitude);
                                                    console.log(longitude);

                                                    $('#latitude').val(latitude);
                                                    $('#longitude').val(longitude);

                                                    $("#update_form").submit();
                                                    $("body").css("cursor", "default");
                                                });
                                        }
                                    }
                                    else {
                                        form.querySelector('input[type="submit"]').click();
                                    }
                                }, false);

                                $(document).on('click', '.remove_image_btn', function(){
                                    var id = $(this).attr('id');
                                    console.log("clicked");

                                    $.ajax({
                                        type:'POST',
                                        url:'/images/remove',
                                        data: {_token: '{{ csrf_token() }}', id: id},
                                        success: function(data) {
                                            $(".image_" + id).remove();
                                        },
                                        error: function(data) {
                                            console.log(data.responseJSON);
                                        }
                                    });
                                });

                                $( document ).ready(function() {
                                    checkType();
                                    checkSold();
                                    checkCategory();
                                });

//                                CHANGE THE DEFAULT CATEGORY SELECT VALUE TO MATCH THE ITEM
                                function checkCategory() {
                                    var cat = "select{{$item->category_id}}";
                                    document.getElementById(cat).selected = "selected";
                                    console.log("cat = " + cat);
                                }

//                                CHANGE THE SOLD TOGGLE TO MATCH IF THE ITEM HAS BEEN SOLD
                                function checkSold() {
                                    if ({{$item->sold}}) document.getElementById("checkboxSold").checked=true;
                                }

//                                CHECK THE TYPE OF TRADE OF THE ITEM - HIDE IRRELEVANT INPUTS
                                function checkType() {
                                    if ("{{$item->type}}" == 'sell') {
                                        updateCheckedSellType();
                                    } else if ("{{$item->type}}" == 'swap') {
                                        updateCheckedSwapType();
                                        document.getElementById("updateSwapRadio").checked = true;
                                    } else {
                                        updateCheckedPEType();
                                        document.getElementById("updatePartExchangeRadio").checked = true;
                                    }
                                }

//                                HIDE IRRELEVANT INPUTS
                                function updateCheckedSellType() {
                                    document.getElementById('updatePriceForm').style.display = "block";
                                    document.getElementById('updatePrice').required = true;
                                    document.getElementById('updatePrice').value = "{{$item->price}}";
                                    document.getElementById('updateSwap').value = "";
                                    document.getElementById('updateSwap').required = false;
                                    document.getElementById('updateSwapForm').style.display = "none";
                                }
//                                HIDE IRRELEVANT INPUTS
                                function updateCheckedSwapType() {
                                    document.getElementById('updatePrice').value = "";
                                    document.getElementById('updatePrice').required = false;
                                    document.getElementById('updatePriceForm').style.display = "none";
                                    document.getElementById('updateSwap').value = "{{$item->trade}}";
                                    document.getElementById('updateSwap').required = true;
                                    document.getElementById('updateSwapForm').style.display = "block";
                                    console.log("swap");
                                }
//                                HIDE IRRELEVANT INPUTS
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
                            @include('modals.delete_item')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
