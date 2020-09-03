<table>
    <thead>
        <th>ID</th>
        <th>Sản phẩm</th>
        <th>Số lượng</th>
        <th>Giá bán</th>
        <th>Trạng thái</th>
    </thead>
    <tbody>
    @foreach($product_exports as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->name}}</td>
            <td>{{$p->number}}</td>
            <td>{{$p->price}}</td>
            <td>{{$p->status}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
