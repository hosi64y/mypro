@if(isset($category))
    @foreach($categories as $child)
        <option @if($child->id === $category->parent_id) selected="selected" @endif value="{{$child->id}}">
            {{str_repeat('-----',$level)}} {{$child->name}}
        </option>
        @if(count($child->childrenRecorsive)>0)
                @include('admin.partials.category',['categories'=>$child->childrenRecorsive,'level'=>$level+1,'category'=>$category])
        @endif
    @endforeach
@else
    @foreach($categories as $child)
        <option value="{{$child->id}}">{{str_repeat('-----',$level)}} {{$child->name}}</option>
        @if(count($child->childrenRecorsive)>0)
                @include('admin.partials.category',['categories'=>$child->childrenRecorsive,'level'=>$level+1])
        @endif
    @endforeach
@endif