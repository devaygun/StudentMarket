<table class="table table-striped v-align">
    <thead>
    <tr>
        <th></th>
        <th>Item</th>
        <th>Description</th>
        <th>Price</th>
        <th>Trade</th>
        <th>Added on</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($items as $item)
        @if ($item->sold == false)
            <tr>
                <td><a href="/items/{{$item->category->slug}}/{{$item->id}}" class="btn btn-primary btn-sm" role="button">View</a></td>
                <td>{{$item->name}}</td>
                <td>{{$item->description}}</td>
                <td>
                    @if ($item->type == "swap") -/-
                    @else £{{$item->price}} @endif
                </td>
                <td>
                    @if ($item->type == "part-exchange") + @endif
                    {{$item->trade}}
                    @if ($item->type == "sell") -/- @endif
                </td>
                <td>{{$item->created_at->format('d/m/y \\a\\t H:i')}}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
<div style="text-align: center;">{{ $items->appends(['value' => \Illuminate\Support\Facades\Input::get('value')])->links() }}</div> {{-- Adds in paginator with appended search query if available --}}


