@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Results</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-sm-3">
                        <div class="alert alert-info">Item 1</div>
                    </div>
                    <div class="col-sm-3">
                        <div class="alert alert-info">Item 2</div>
                    </div>
                    <div class="col-sm-3">
                        <div class="alert alert-info">Item 3</div>
                    </div>
                    <div class="col-sm-3">
                        <div class="alert alert-info">Item 4</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
