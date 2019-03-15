@foreach($categories as $child)
    <option value="{{$child->id}}">{{str_repeat('-----',$level)}} {{$child->name}}</option>
    @if(count($child->childrenRecorsive)>0)
            @include('admin.partials.category',['categories'=>$child->childrenRecorsive,'level'=>$level+1])
    @endif
@endforeach