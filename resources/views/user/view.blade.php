@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>{{$viewUser->first_name}} {{$viewUser->last_name}}</span>
                    @if (!$canReview)
                        <a href="/profile" class="btn btn-primary btn-xs" style="float: right;"><i class="fa fa-pencil"></i></a>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        @if ($viewUser->profile_picture)
                            <img src="{{asset('storage/' . $viewUser->profile_picture)}}" class="img-responsive" alt="">
                        @else
                            <img src="{{asset('images/default_profile.jpg')}}" class="img-responsive" alt="">
                        @endif
                    </div>
                    <div class="col-sm-8">
                        <table class="table table-striped">
                            <thead>
                            <tr><th>Email Address: {{$viewUser->email}}</th></tr>
                            <tr>
                                <th id="avgRating" value="{{$avgRating}}">Rating:
                                    <span class="fa fa-star" id="avgRating1"></span>
                                    <span class="fa fa-star" id="avgRating2"></span>
                                    <span class="fa fa-star" id="avgRating3"></span>
                                    <span class="fa fa-star" id="avgRating4"></span>
                                    <span class="fa fa-star" id="avgRating5" style="padding-right: 30px"></span>
                                    <span style="font-weight: 400">Average rating of {{$avgRating}} from {{$userReviews->count()}} users</span>
                                </th>
                            </tr>
                            <tr>
                                <th>Member since: {{$viewUser->created_at->format('jS \\ F Y')}}</th>
                            </tr>
                            <tr>
                                <th>Advertised Items:
                                    @if ($viewUser->items->isEmpty())
                                        No items listed
                                    @else
                                            {{$viewUser->items->count()}}
                                    @endif
                                </th>
                            </tr>
                            </thead>
                        </table>
                        {{--IF PROFILE DOES NOT BELONG TO AUTHORISED USER--}}
                        @if ($canReview)
                            <button data-toggle="modal" data-target="#messageModal" type="button" class="btn btn-primary">Message Seller</button>
                        @endif
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{--TABS--}}

            <ul class="nav nav-tabs">
                <li class="active"><a href="#reviewTab" data-toggle="tab" aria-expanded="false">Reviews</a></li>
                <li class=""><a href="#itemTab" data-toggle="tab" aria-expanded="true">Items</a></li>
                <li class=""><a href="#soldItemTab" data-toggle="tab" aria-expanded="true">Sold Items</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">


                {{--REVIEW SECTION--}}
                <div class="tab-pane fade active in" id="reviewTab">
                    <div class="col-md-12" style="padding-bottom: 20px">
                        <h2>Reviews</h2>
                        {{--If profile does NOT belong to user, show Create Review button--}}
                        @if ($canReview)
                            <a href="" class="btn btn-default" data-toggle="modal" data-target="#reviewModal"><i class="fa fa-plus" aria-hidden="true"></i> Write Review</a>
                            {{--IF NO REVIEWS & USER IS NOT SELLER--}}
                            @if (!$userReviews->count())
                                <label style="padding-left: 30px">Be the first to review this seller!</label>
                            @endif
                        @endif
                        {{--IF NO REVIEWS--}}
                        @if (!$userReviews->count())
                            <h4>No Reviews for this seller</h4>
                        @endif
                    </div>

                    {{--DISPLAY REVIEWS--}}
                    @foreach($userReviews as $review)
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{\App\User::where('id', ($review->buyer_id))->first()->first_name}}
                                    <span class="user-rating-{{$review->rating}}" style="float: right"></span>
                                </div>
                                <div class="panel-body">
                                    {{$review->review}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{--ITEM SECTION--}}
                <div class="tab-pane fade" id="itemTab">
                    <div class="col-md-12" style="padding-bottom: 20px">
                        <h2>Items</h2>
                        <table class="table table-striped">
                            @if ($viewUser->items->isEmpty())
                                <td>No items from this Seller</td>
                            @endif
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($viewUser->items as $item)
                                @if ($item->sold == false)
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="item-inner">

                                            {{--LINK AROUND ITEM--}}
                                            <a href="/items/{{$item->category->slug}}/{{$item->id}}" title="View details">

                                                {{--IMAGE--}}
                                                @if($item->images->isNotEmpty())
                                                    <div class="item-image" style="background-image: url({{asset("storage/{$item->images->first()->path} ")}});"></div>
                                                    {{--<img src="{{asset("storage/{$item->images->first()->path} ")}}" alt="Item Image Preview" class="panel" data-toggle_tooltip="tooltip" title="View item for more details" height="100px" width="100px">--}}
                                                @else
                                                    <div class="item-image" style="background-image: url({{asset('images/default-placeholder.png')}});"></div>
                                                @endif

                                                {{--DETAILS--}}
                                                <div class="item-details">
                                                    <div class="item-name">{{$item->name}}</div>
                                                    <div class="item-type">
                                                        @if ($item->type == "swap")  <span>Swapping for: </span><span class="cost">{{$item->trade}}</span>
                                                        @elseif ($item->type == "sell") <span>Selling for: </span><span class="cost">£{{$item->price}}</span>
                                                        @elseif ($item->type == "part-exchange") <span>Part-exchange for: </span><span class="cost">£{{$item->price}} + {{$item->trade}}</span> @endif
                                                    </div>
                                                    <div class="item-icon">
                                                        @if ($item->type == "swap") <i class="fa fa-exchange" aria-hidden="true"></i>
                                                        @elseif ($item->type == "sell") <i class="fa fa-gbp" aria-hidden="true"></i>
                                                        @elseif ($item->type == "part-exchange") <i class="fa fa-gbp" aria-hidden="true"></i> + <i class="fa fa-exchange" aria-hidden="true"></i> @endif
                                                    </div>
                                                    <div class="item-description">{{$item->description}}</div>
                                                    <div class="item-date">Added on {{$item->created_at->format('d/m/y \\a\\t H:i')}}</div>
                                                    <button class="btn btn-primary item-button">View Details</button>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{--SOLD ITEMS SECTION--}}
                <div class="tab-pane fade" id="soldItemTab">
                    <div class="col-md-12" style="padding-bottom: 20px">
                        <h2>Sold Items</h2>
                            @foreach ($viewUser->items as $item)
                                @if ($item->sold == true)
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="item-inner">

                                            {{--LINK AROUND ITEM--}}
                                            <a href="/items/{{$item->category->slug}}/{{$item->id}}" title="View details">

                                                {{--IMAGE--}}
                                                @if($item->images->isNotEmpty())
                                                    <div class="item-image" style="background-image: url({{asset("storage/{$item->images->first()->path} ")}});"></div>
                                                    {{--<img src="{{asset("storage/{$item->images->first()->path} ")}}" alt="Item Image Preview" class="panel" data-toggle_tooltip="tooltip" title="View item for more details" height="100px" width="100px">--}}
                                                @else
                                                    <div class="item-image" style="background-image: url({{asset('images/default-placeholder.png')}});"></div>
                                                @endif

                                                {{--DETAILS--}}
                                                <div class="item-details">
                                                    <div class="item-name">{{$item->name}}</div>
                                                    <div class="item-type">
                                                        @if ($item->type == "swap")  <span>Swapping for: </span><span class="cost">{{$item->trade}}</span>
                                                        @elseif ($item->type == "sell") <span>Selling for: </span><span class="cost">£{{$item->price}}</span>
                                                        @elseif ($item->type == "part-exchange") <span>Part-exchange for: </span><span class="cost">£{{$item->price}} + {{$item->trade}}</span> @endif
                                                    </div>
                                                    <div class="item-icon">
                                                        @if ($item->type == "swap") <i class="fa fa-exchange" aria-hidden="true"></i>
                                                        @elseif ($item->type == "sell") <i class="fa fa-gbp" aria-hidden="true"></i>
                                                        @elseif ($item->type == "part-exchange") <i class="fa fa-gbp" aria-hidden="true"></i> + <i class="fa fa-exchange" aria-hidden="true"></i> @endif
                                                    </div>
                                                    <div class="item-description">{{$item->description}}</div>
                                                    <div class="item-date">Added on {{$item->created_at->format('d/m/y \\a\\t H:i')}}</div>
                                                    <button class="btn btn-primary item-button">View Details</button>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modals -->
    @include('modals.create_review')
    @include('modals.create_message')

    {{--Scripts--}}
    <script>

        $( document ).ready(function() {
            loadRating();
            calcUserRating();
        });

        // INSERT STAR RATING INTO BUYER'S REVIEWS
        function loadRating() {
//            ONE STAR RATING
            var ratings1 = document.getElementsByClassName("user-rating-1");
            for (var i=0; i<ratings1.length; i++) {
                ratings1[i].innerHTML =
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star\"></span>" +
                    "<span class=\"fa fa-star\"></span>" +
                    "<span class=\"fa fa-star\"></span>" +
                    "<span class=\"fa fa-star\"></span>";
            }
//            TWO STAR RATING
            var ratings2 = document.getElementsByClassName("user-rating-2");
            for (var i=0; i<ratings2.length; i++) {
                ratings2[i].innerHTML =
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star\"></span>" +
                    "<span class=\"fa fa-star\"></span>" +
                    "<span class=\"fa fa-star\"></span>";
            }
//            THREE STAR RATING
            var ratings3 = document.getElementsByClassName("user-rating-3");
            for (var i=0; i<ratings3.length; i++) {
                ratings3[i].innerHTML =
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star\"></span>" +
                    "<span class=\"fa fa-star\"></span>";
            }
//            FOUR STAR RATING
            var ratings4 = document.getElementsByClassName("user-rating-4");
            for (var i=0; i<ratings4.length; i++) {
                ratings4[i].innerHTML =
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star\"></span>";
            }
//            FIVE STAR RATING
            var ratings5 = document.getElementsByClassName("user-rating-5");
            for (var i=0; i<ratings5.length; i++) {
                ratings5[i].innerHTML =
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>";
            }
        }

        function calcUserRating() {
            if ($("#avgRating").attr("value") >= 1) $("#avgRating1").addClass("checked");
            if ($("#avgRating").attr("value") >= 2) $("#avgRating2").addClass("checked");
            if ($("#avgRating").attr("value") >= 3) $("#avgRating3").addClass("checked");
            if ($("#avgRating").attr("value") >= 4) $("#avgRating4").addClass("checked");
            if ($("#avgRating").attr("value") >= 1.5 && $("#avgRating").attr("value") < 2) {
                $("#avgRating1").addClass("checked fa-star-half-o");
            }
            if ($("#avgRating").attr("value") >= 2.5 && $("#avgRating").attr("value") < 3) {
                $("#avgRating2").addClass("checked fa-star-half-o");
            }
            if ($("#avgRating").attr("value") >= 3.5 && $("#avgRating").attr("value") < 4) {
                $("#avgRating3").addClass("checked fa-star-half-o");
            }
            if ($("#avgRating").attr("value") >= 4.5 && $("#avgRating").attr("value") < 5) {
                $("#avgRating4").addClass("checked fa-star-half-o");
            }
        }
    </script>

    {{--STYLES--}}
    <style>

        .fa.fa-star.checked {
            color: orange;
        }

        .nav-tabs > li > a:focus {
            outline: 0;
        }

        /*ITEMS*/

        .item {
            margin-bottom: 30px;
        }

        .item-inner {
            position: relative;
            overflow: hidden;
        }

        .item-image {
            width: 100%;
            padding-bottom: 100%;
            background-position: center;
            -webkit-background-size: cover;
            background-size: cover;
            background-color: #ccc;
        }

        .item-details {
            position: absolute;
            top: calc(100% - 64px);
            right: 0;
            left: 0;
            height: 100%;
            background: #333333b3;
            color: #fff;
            padding: 10px 70px 10px 10px;
            -webkit-transition: all ease 0.3s;
            -moz-transition: all ease 0.3s;
            -ms-transition: all ease 0.3s;
            -o-transition: all ease 0.3s;
            transition: all ease 0.3s;
        }

        .item-description {
            padding-top: 20px;
            line-height: 22px;
            height: 45%;
            -webkit-mask-image: linear-gradient(to bottom, white 55%, transparent);
            mask-image: linear-gradient(to bottom, white 55%, transparent);
        }

        .item-name {
            line-height: 22px;
            height: 22px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .item-date {
            position: absolute;
            bottom: 60px;
            left: 15px;
        }

        .item-type {
            line-height: 22px;
            height: 22px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .cost,
        .item-name {
            font-size: 16px;
            font-weight: 700;
        }

        .item-button {
            position: absolute;
            left: 10px;
            bottom: 15px;
        }

        .item-icon {
            font-size: 18px;
            position: absolute;
            top: 10px;
            right: 15px;
        }

        /*HOVERS*/
        .item-inner:hover .item-details {
            top: 0;
        }

    </style>


@endsection
