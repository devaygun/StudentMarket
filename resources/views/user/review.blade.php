@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->first_name}} {{$user->last_name}}</div>
                <div class="row">
                    <div class="col-sm-4">
                        @if ($user->profile_picture)
                            <img src="{{asset('storage/' . $user->profile_picture)}}" class="img-responsive" alt="">
                        @else
                            <img src="{{asset('images/default_profile.jpg')}}" class="img-responsive" alt="">
                        @endif
                    </div>
                    <div class="col-sm-8">
                        <table class="table table-striped">
                            <thead>
                            <th></th>
                            <tr><th>Email Address: {{$user->email}}</th></tr>
                            <tr>
                                <th id="calcRating">Rating:
                                    <span class="fa fa-star rating1"></span>
                                    <span class="fa fa-star rating2"></span>
                                    <span class="fa fa-star rating3"></span>
                                    <span class="fa fa-star rating4"></span>
                                    <span class="fa fa-star rating5"></span>
                                </th>
                            </tr>
                            <tr><th>Member since: {{$user->created_at->format('jS \\ F Y')}}</th></tr>
                            </thead>
                        </table>
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

            {{--REVIEW SECTION--}}

            @if (\App\Review::all()->where('seller_id', $user->id))
                <div class="col-md-12" style="padding-bottom: 20px">
                    <h2>Reviews</h2>

                    {{--If profile does NOT belong to user, show Create Review button--}}
                    @if ($canReview)
                        <a href="" class="btn btn-default" data-toggle="modal" data-target="#reviewModal"><i class="fa fa-plus" aria-hidden="true"></i> Write Review</a>

                        {{--IF NO REVIEWS & USER IS NOT SELLER--}}
                        @if (!\App\Review::all()->where('seller_id', $user->id)->count())
                            <label style="padding-left: 30px">Be the first to review this seller!</label>
                        @endif

                    @endif

                    {{--IF NO REVIEWS--}}
                    @if (!\App\Review::all()->where('seller_id', $user->id)->count())
                        <h4>No Reviews for this seller</h4>
                    @endif

                </div>


                {{--DISPLAY REVIEWS--}}
                @foreach(\App\Review::all()->where('seller_id', $user->id) as $review)
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

            @endif
        </div>
    </div>

    <!-- Modals -->
    @include('modals.create_review')

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
            var ratings4 = document.getElementsByClassName("user-rating-4");
            for (var i=0; i<ratings4.length; i++) {
                ratings4[i].innerHTML =
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star checked\"></span>" +
                    "<span class=\"fa fa-star\"></span>";
            }
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

        }
    </script>

    <style>
        .fa.fa-star.checked {
            color: orange;
        }
    </style>


@endsection
