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