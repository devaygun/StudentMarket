@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{--SELLER INFORMATION--}}
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 style="display:inline-block" class="panel-title">Seller Profile</h3>
                    </div>
                    <div class="panel-body">
                        <h3 class="panel-title seller-name">Name: {{$item->user->first_name}}</h3>
                        <img class="seller-pp"  src="{{$item->user->getProfilePicture()}}" alt="" style="display: block; max-width:100%; max-height:50%; width: auto; height: auto;">
                        <a href="/view/{{$item->user_id}}" class="btn btn-primary">View Profile</a>
                        @if (!$authorised)
                            <button id="msgModalBtn" data-toggle="modal" data-target="#messageModal" type="button" class="btn btn-primary">Message Seller</button>
                        @endif
                    </div>
                </div>
            </div>
            {{--ITEM INFORMATION--}}
            <div class="col-sm-8">

                {{--TITLE--}}
                <div class="panel panel-primary">
                    <div class="panel-heading item-heading">
                        <div>
                            <h3 class="panel-title item-title">{{$item->name}}</h3>
                            @if ($item->sold == true) <label class="label label-default">Note: This item has been sold</label> @endif
                        </div>
                        <div class="item-cost-row">
                            <h2 class="panel-title item-cost">
                                @if ($item->type == "sell")
                                    £{{$item->price}}
                                @elseif ($item->type == "swap")
                                    {{$item->trade}}
                                @elseif ($item->type == "part-exchange")
                                    £{{$item->price}} + {{$item->trade}}
                                @endif
                            </h2>

                            <div class="panel-title item-sell-type">
                                @if ($item->type == "sell")
                                    <span>Sell </span><i class="fa fa-gbp fa-pad" aria-hidden="true"></i>
                                @elseif ($item->type == "swap")
                                    <span>Swap </span><i class="fa fa-exchange fa-pad" aria-hidden="true"></i>
                                @elseif ($item->type == "part-exchange")
                                    <span>Part-Exchange </span><i class="fa fa-gbp  fa-pad" aria-hidden="true"></i><span> + </span>
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                @endif
                            </div>
                        </div>

                    </div>


                    {{--IMAGES--}}
                    <div class="panel-body">
                        @if ($item->images->isNotEmpty())
                            <div class="row">
                                @foreach ($item->images as $image)
                                    <div class="col-sm-4 col-md-3 image-frame">
                                        <div class="item-thumb" style="background-image: url({{asset("storage/$image->path")}})">
                                            <img src="{{asset("storage/$image->path")}}" alt="" class="image_preview panel" data-toggle_tooltip="tooltip" title="Click to view larger">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <span class="label label-default">No Images Available</span>
                        @endif

                        {{--DESCRIPTION--}}
                        <div class="row description">
                            <div class="col-sm-12">
                                <div class="hr"></div>
                                <h4>Description</h4>
                                <h4 class="added-on">Added on {{$item->created_at->format('d/m/y')}}</h4>
                                <div>{{old('description', $item->description)}}</div>
                            </div>
                        </div>

                        {{--BUTTONS--}}

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

    {{--Comment Section--}}
    <div class="col-lg-12">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 style="display:inline-block" class="panel-title">Comments</h3>
                @if ($item->sold == true) <label class="label label-default">Note: This item has been sold</label> @endif
            </div>
                </div>
        </div>


    <!-- Modals -->
    @include('modals.create_message')

    <!-- Modal -->
    <div id="largerImageModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="large_image"></div>
                </div>
            </div>
        </div>
    </div>

    {{--STYLE--}}

    <style>

        .seller-name,
        .seller-pp {
            padding-bottom: 10px;
        }

        .item-heading .item-title,
        .item-heading .item-cost {
            display: inline-block;
            line-height:20px;
            font-size: 22px;
        }

        .item-heading .item-cost-row {
            text-align: right;
        }

        .item-heading .item-sell-type{
            float: left;
            line-height: 30px;
        }

        .description {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .description h4 {
            display: inline-block;
        }

        .description .added-on {
            float: right;
        }

        .description .hr:before {
            content: "";
            width: 100%;
            height: 1px;
            background: #ccc;
            display: block;
            margin: 20px 0
        }

        .item-thumb {
            position: relative;
            width: 100%;
            background-position: center;
            -webkit-background-size: cover;
            background-size: cover;
            background-color: #ccc;
            border-radius: 6px;
        }

        .item-thumb img.image_preview {
            height: 0;
            width: 100%;
            padding-bottom: 100%;
            opacity: 0;
        }

        /*DO NOT REMOVE*/
        .large_image {
            max-width: 88vh;
            max-height: 88vh;
            margin: 0 auto;
        }

        @media screen and (min-device-width: 768px) and (max-device-width: 991px) {

            #msgModalBtn {
                margin-top: 15px;
            }
        }
    </style>
@endsection
