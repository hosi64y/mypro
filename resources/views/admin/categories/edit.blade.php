@extends('admin.layout.master')

@section('content')
    <div class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش فرم {{$category->name}}</h3>
            </div>
            <form action="{{route('categories.update',$category->id)}}" method="post" role="form" class="pd-form">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <label>نام</label>
                    <input type="text" name="name" class="form-control" placeholder="عنوان دسته بندی را ورد کنید..." value="{{$category->name}}">
                </div>
                <div class="form-group">
                    <label>دسته والد</label>
                    <select class="form-control select2 select2-hidden-accessible" name="category_parent" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option  value="">بدون والد</option>
                        @foreach($categories as $cat)
                            <option @if($cat->id === $category->parent_id) selected="selected" @endif value="{{$cat->id}}">{{$cat->name}}</option>
                            @if(count($cat->childrenRecorsive)>0)
                                @include('admin.partials.category',['categories'=>$cat->childrenRecorsive,'level'=>1,'category'=>$category])
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>عنوان سئو</label>
                    <input type="text" name="meta_title" class="form-control" placeholder="عنوان سئو را ورد کنید..." value="{{$category->meta_title}}">
                </div>
                <div class="form-group">
                    <label>توضیحات سئو</label>
                    <textarea name="meta_desc" class="form-control" placeholder="توضیحات سئو را ورد کنید...">{{$category->meta_desc}}</textarea>
                </div>
                <div class="form-group">
                    <label>کلمات کلیدی سئو</label>
                    <input type="text" name="meta_keywords" class="form-control" placeholder="کلمات کلیدی سئو را ورد کنید..." value="{{$category->meta_keywords}}">
                </div>

                <input type="submit" class="btn btn-block btn-success width-btn-small" value="ذخیره">
            </form>
        </div>
    </div>


@endsection