@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{--SELLER INFORMATION--}}
            <div class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 style="display:inline-block" class="panel-title">Seller Profile</h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Name: {{$item->user->first_name}}</h3>
                            </div>
                            <div class="panel-body">
                                <img  src="{{$item->user->getProfilePicture()}}" alt="" style="display: block; max-width:100%; max-height:50%; width: auto; height: auto;">
                            </div>
                        </div>
                        <a href="/view/{{$item->user_id}}" class="btn btn-primary">View Profile</a>
                        @if (!$authorised)
                            <button data-toggle="modal" data-target="#messageModal" type="button" class="btn btn-primary">Message Seller</button>
                        @endif
                    </div>
                </div>
            </div>
            {{--ITEM INFORMATION--}}
            <div class="col-lg-8">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 style="display:inline-block" class="panel-title">{{$item->name}}</h3>
                        @if ($item->sold == true) <label class="label label-default">Note: This item has been sold</label> @endif
                    </div>
                        @if ($item->images->isNotEmpty())
                            <div class="row">
                                <div class="col-sm-12">
                                    @foreach ($item->images as $image)
                                        <div class="col-sm-4 col-md-3 image-frame">
                                            <div class="item-thumb" style="background-image: url({{asset("storage/$image->path")}})">
                                                <img src="{{asset("storage/$image->path")}}" alt="" class="image_preview panel" data-toggle_tooltip="tooltip" title="Click to view larger">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    <div class="panel-body">
                        <h3>Description</h3>
                        {{old('description', $item->description)}}

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

    {{--Comment Section--}}
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 style="display:inline-block" class="panel-title">Comments</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped v-align">
                    <thead>
                    <tr>
                        <th></th>
                        <th>User</th>
                        <th>Comment</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($item->comments as $comment)
                    <td><img src="{{User::find($comment->user_id)->getProfilePicture()}}" alt="User Image Preview" class="panel" data-toggle_tooltip="tooltip" title="Click to view user's profile" height="100px" width="100px"></td>
                        @endforeach
                    </tbody>
                </table>
                <div class="comment-form">
                    <div class="col-sm-4 user-avatar" style="background-image: url{{Auth::User()->getProfilePicture()}}">
                        <img src="{{Auth::User()->getProfilePicture()}}" alt="Profile Image Preview" class="panel" height="100px" width="100px">
                    </div>
                    <form class="form" name="form">
                    <div class="form-row">
                        <div class="col-sm-8">
                <textarea class="form-control" placeholder="Add comment..." required rows="5" id="comment"></textarea>
                        </div>
                    </div>
                    </form>
                </div>
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

        .large_image {
            max-width: 88vh;
            max-height: 88vh;
            margin: 0 auto;
        }
    </style>
@endsection
