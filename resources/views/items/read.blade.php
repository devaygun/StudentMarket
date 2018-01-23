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
                            <button type="button" class="btn btn-primary">Message Seller</button>
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
                                @foreach ($item->images as $image)
                                    <div class="col-sm-3" >
                                        <img src="{{asset("storage/$image->path")}}" alt="" class="image_preview panel" data-toggle_tooltip="tooltip" title="Click to view larger">
                                    </div>
                                @endforeach
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

@endsection
