@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        {{--CHANGE PANEL HEADING ON SAVED ITEMS OR INDEX PAGE--}}
                        @if( ! empty($saved))
                            <div><span class="panelSaved">Saved Items</span> <span class="panelSavedCount">{{count($items)}}</span></div>
                        @else
                            <div class="inline-block">{{$category or 'Available Items'}}</div>
                        @endif
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{--DISPLAY ON SAVED ITEMS PAGE ONLY--}}
                        @if( ! empty($saved) && count($items) == 0)
                            <h5>Click the <i class="fa fa-heart" style="color: red" aria-hidden="true"></i> icon on an item page to store the item here</h5>
                        @endif

                            @include('components.filters')

                        @include('components.item', ['items' => $items])
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

        .panelSaved {
            display: inline-block;
            vertical-align: middle;
        }

        .panelSavedCount {
            height: 20px;
            width: 20px;
            background: #158cba;
            font-size: 9px;
            line-height: 20px;
            color: #fff;
            display: inline-block;
            text-align: center;
            border-radius: 100%;
            margin-left: 5px;
            vertical-align: middle;
        }

        @media screen and (max-width: 767px) {
            .legend {
                float: none;
                font-size: 13px;
            }
        }

    </style>

@endsection