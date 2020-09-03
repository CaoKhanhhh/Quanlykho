@foreach($product as $key => $p)
    <tr>
        <td>{{$p->id}}</td>
        <td>{{$p->name}}</td>
        <td><img src="{{asset($p->image)}}" style="width: 50px; height: 50px"></td>
        <td>{{$p->number}}</td>
        <td>{{$p->price}}</td>
        @if($p->status ==1)
            <td>Còn hàng</td>
        @else
            <td>Hết hàng</td>
        @endif
    </tr>
@endforeach

