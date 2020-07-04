{{$id}}
<br>
{{$type}}

@if($id == 1)
    1 numaralı ürün gösterilmektedir.
@endif

<ul>
    @foreach($categories as $category)
        <li>{{$category}}</li>
    @endforeach
</ul>

{{-- Deneme  Comment --}}

