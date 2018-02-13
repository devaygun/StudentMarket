@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="inline-block">{{$category or 'Recently Added'}}</div>
                        {{--LEGEND--}}
                        <div class="legend">
                            <i class="fa fa-gbp fa-pad" aria-hidden="true"></i><span> Sell</span>
                            <i class="fa fa-exchange fa-pad" aria-hidden="true"></i><span> Swap</span>
                            <i class="fa fa-gbp  fa-pad" aria-hidden="true"></i><span> + </span>
                            <i class="fa fa-exchange" aria-hidden="true"></i><span> Part-Exchange</span>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('components.item', ['items' => $items])
{{--                        @include('components.itemTest', ['items' => $items])--}}
                    </div>
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

    </style>

@endsection