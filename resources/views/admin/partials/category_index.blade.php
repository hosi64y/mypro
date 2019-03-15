@foreach($categories as $sub_cat)
    <tr>
        <td class="text-center" >{{$sub_cat->id}}</td>
        <td class="text-center" >{{str_repeat('-----',$level)}}{{$sub_cat->name}}</td>
        <td class="text-center" >
            <a href="{{route('categories.edit',$sub_cat->id)}}" class="btn btn-primary">ویرایش</a>
            <a href="{{route('categories.destroy',$sub_cat->id)}}" class="btn btn-danger">حذف</a>
        </td>
    </tr>
    @if(count($sub_cat->childrenRecorsive)>0)
        @include('admin.partials.category_index',['categories'=>$sub_cat->childrenRecorsive,'level'=>$level+1])
    @endif
@endforeach