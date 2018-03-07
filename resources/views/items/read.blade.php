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

                        @if (!$authorised)
                            <form class="saveForm" method="POST" action="/items/save/{{$item->id}}" enctype="multipart/form-data">
                                {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                                @if ($saved)
                                    <button title="Remove from saved" class="remove" name="saveItem btn btn-primary" type="submit" value="remove">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    </button>
                                @else
                                    <button title="Save item" class="save" name="saveItem btn btn-primary" type="submit" value="save">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    </button>
                                @endif
                            </form>
                        @endif

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
                        <div class="col-xs-12 col-sm-8" style="margin-top: 8px;">
                            <span class="well well-sm distance" style="display: none;"></span>
                            <span class="well well-sm duration" style="display: none;"></span>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <a href="/items" class="btn btn-default pull-right" role="button" style="margin-left: 5px;">Return</a>

                            @if (!$authorised)
                                <button type="button" class="btn btn-primary pull-right">Make Offer</button>
                            @endif

                            @if ($authorised)
                                <a href="/items/update/{{$item->id}}" class="btn btn-primary pull-right">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Comment Section--}}
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 style="display:inline-block" class="panel-title">Comments</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover v-align">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($item->comments as $comment)
                        <td width="5%">
                            <div class="image-frame">
                                <div class="item-thumb" style="background-image: url({{\App\User::find($comment->user_id)->getProfilePicture()}})">
                                    <a href="/view/{{$comment->user_id}}">
                                        <img src="{{\App\User::find($comment->user_id)->getProfilePicture()}}" alt="User Image Preview" class="i-panel" data-toggle_tooltip="tooltip"
                                             title="Click to view user's profile" height="75px" width="75px">
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td width="7%"><a href="/view/{{$comment->user_id}}" class="text-primary">{{\App\User::find($comment->user_id)->first_name}}:</a></td>
                        <td id ="user_comment" width="64%">{{$comment->comment}}</td>
                        <td width="9%">{{$comment->updated_at->format('d/m/Y')}}</td>
                        @if($comment->user_id == \Illuminate\Support\Facades\Auth::id())
                            <form class="form" action="/comments/{{$comment->id}}/delete" method="POST" name="form">
                                {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                                <input type="hidden" id = "id" name="id" value="{{$comment->id}}">
                                <td width="15%"><button type="submit" class="btn btn-primary">Delete</button></form>
                            <button type="button" class="btn btn-primary" onclick=document.getElementById("comment").append("@_{{\App\User::find($comment->user_id)->first_name}}")>Reply</button></td>
                        @else
                            <td><button type="button" class="btn btn-primary" onclick=document.getElementById("comment").append("@_{{\App\User::find($comment->user_id)->first_name}}")>Reply</button></td>
                        @endif
                        <tr></tr>
                        {{-- <td><img src="{{\App\Item::find($comment->user_id)->getProfilePicture()}}" alt="User Image Preview" class="panel" data-toggle_tooltip="tooltip" title="Click to view user's profile" height="100px" width="100px"></td>--}}
                    @endforeach
                    </tbody>
                </table>
                <div class="col-sm-1 image-frame">
                    <div class="avatar-thumb" style="background-image: url({{Auth::User()->getProfilePicture()}})">
                    <img src="{{$image = Auth::User()->getProfilePicture()}}" alt="Profile Image Preview" class="comment-post">
                    </div>
                </div>
                <form class="form" action="/comments/{{$item->id}}" method="POST" name="form">
                    <input type="hidden" name="item_id" value="{{$item->id}}">
                    <input type="hidden" name="reply_id" value="0">
                    {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                    <div class="col-sm-11 form-row">
                        <textarea class="form-control" placeholder="Write your comment here..." required rows="3" id="comment" name="comment"></textarea>
                        <button type="submit" class="btn btn-primary">Add comment</button>
                    </div>
                </form>
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

    <script>
        $(document).ready(function() {
            var latitude = null;
            var longitude = null;

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        latitude = position.coords.latitude;
                        longitude = position.coords.longitude;


                        $.ajax({
                            type: 'POST',
                            url: '/items/getDistance',
                            data: {
                                _token: '{{ csrf_token() }}',
                                item_longitude: '{{$item->longitude}}',
                                item_latitude: '{{$item->latitude}}',
                                user_longitude: longitude,
                                user_latitude: latitude
                            },
                            success: function (data) {
                                console.log(data);
                                var json = JSON.parse(data);
                                var distance = json['rows'][0]['elements'][0]['distance']['text'];
                                var duration = json['rows'][0]['elements'][0]['duration']['text'];

                                $(".distance").show().html('<i class="fa fa-map-marker fa-lg"></i> Distance: ' + distance + ' away');
                                $(".duration").show().html('<i class="fa fa-car fa-lg"></i> Duration: ' + duration);
                            },
                            error: function (data) {
                                console.log(data.responseText);
                            }
                        });
                    },
                    function(error) {
                        console.log("Error with location");
                        console.log(error.toString());
                    }
                );
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        });
    </script>

    {{--STYLE--}}

    <style>

        .seller-name,
        .seller-pp {
            padding-bottom: 10px;
        }
        
        .saveForm {
            position: relative;
        }
        table td{
            word-break: break-all;
        }
        .saveForm button {
            outline: 0;
            background: none;
            border: none;
            position: absolute;
            top: 0;
            right: 0;
            line-height: 30px;
            -webkit-transition: color ease 0.2s;
            -moz-transition:  color ease 0.2s;
            -ms-transition:  color ease 0.2s;
            -o-transition:  color ease 0.2s;
            transition:  color ease 0.2s;
        }

        .saveForm button.save:hover {
            color: red;
        }

        .saveForm button.remove {
            color: red;
        }

        .saveForm button.remove:hover {
            color: #000;
        }

        .item-heading .item-title,
        .item-heading .item-cost {
            display: inline-block;
            line-height:30px;
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

        .avatar-thumb {
            position: relative;
            width: 100%;
            background-position: center;
            -webkit-background-size: cover;
            background-size: cover;
            background-color: #ccc;
            border-radius: 6px;
        }

        .avatar-thumb img.comment-post{
            height: 0;
            width: 100%;
            padding-bottom: 100%;
            opacity: 0;
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

        .item-thumb img.i-panel{
            height: 0;
            width: 100%;
            padding-bottom: 100%;
            opacity: 0;
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
