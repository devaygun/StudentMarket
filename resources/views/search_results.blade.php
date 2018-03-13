@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Results <span class="badge badge-primary badge-pill">{{count($results)}}</span>

                    <img src="/images/search-by-algolia.png" alt="Algolia (search engine API)" style="height: 18px; width: 130px; float: right; z-index: -1;">
                    @if( empty($saved))
                        <div class="legend" style="margin-right: 20px;">
                            <i class="fa fa-gbp fa-pad" aria-hidden="true"></i><span> Sell</span>
                            <i class="fa fa-exchange fa-pad" aria-hidden="true"></i><span> Swap</span>
                            <i class="fa fa-gbp  fa-pad" aria-hidden="true"></i><span> + </span>
                            <i class="fa fa-exchange" aria-hidden="true"></i><span> Part-Exchange</span>
                        </div>
                    @endif
                </div>
                <div class="panel-body">
                    @include('components.item', ['items' => $results])
                </div>
            </div>
        </div>
    </div>

    {{--STYLE--}}
    <style>

        .legend {
            float: right;
            padding-top: 0 !important;
        }

        @media screen and (max-width: 767px) {
            .legend {
                float: none;
                font-size: 12px;
            }
        }

    </style>
@endsection