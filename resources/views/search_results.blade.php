@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Results <span class="badge badge-primary badge-pill">{{$results->total()}}</span>

                    <img src="/images/search-by-algolia.png" alt="Algolia (search engine API)" style="height: 18px; width: 130px; float: right; z-index: -1;">
                    {{--LEGEND--}}
                    <div class="legend">
                        <form method="POST" action="/search/filter" enctype="multipart/form-data">
                            {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                            <button name="sellTypeFilter" value="all" type="submit" class="btn btn-sm">
                                <span>All</span>
                            </button>
                            <button name="sellTypeFilter" value="sell" type="submit" class="btn btn-sm">
                                <i class="fa fa-gbp fa-pad" aria-hidden="true"></i><span> Sell</span>
                            </button>
                            <button name="sellTypeFilter" value="swap" type="submit" class="btn btn-sm">
                                <i class="fa fa-exchange fa-pad" aria-hidden="true"></i><span> Swap</span>
                            </button>
                            <button name="sellTypeFilter" value="part-exchange" type="submit" class="btn btn-sm">
                                <i class="fa fa-gbp  fa-pad" aria-hidden="true"></i><span> + </span>
                                <i class="fa fa-exchange" aria-hidden="true"></i><span> Part-Exchange</span>
                            </button>
                        </form>

                    </div>
                </div>
                <div class="panel-body">
                    @include('components.item', ['items' => $results])
                </div>
            </div>
        </div>
    </div>
@endsection