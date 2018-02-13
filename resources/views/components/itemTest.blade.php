
<div class="item-listing">
    @foreach ($items as $item)
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
                            {{--{{$item->created_at->format('d/m/y \\a\\t H:i')}}--}}
                            <button class="btn btn-primary item-button">View Details</button>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    @endforeach
</div>
<div style="text-align: center;">{{ $items->appends(['value' => \Illuminate\Support\Facades\Input::get('value')])->links() }}</div> {{-- Adds in paginator with appended search query if available --}}

{{--STYLES--}}
<style>

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
        max-height: 50%;
    }

    .item-name {
        line-height: 22px;
        height: 22px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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