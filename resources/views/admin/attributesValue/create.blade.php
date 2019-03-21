@extends('admin.layout.master')

@section('content')
        <div class="content">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد مقدار ویژگی</h3>
                </div>
                <form action="{{route('attributes_value.store')}}" method="post" role="form" class="pd-form">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>نام</label>
                        <input type="text" name="title" class="form-control" placeholder="عنوان ویژگی را ورد کنید...">
                    </div>
                    <div class="form-group">
                        <label>ویژگی</label>
                        <select class="form-control select2 select2-hidden-accessible" name="attributeGroup_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option  value="">یک ویژگی را انتخاب کنید...</option>
                            @foreach($attribtesGroup as $attribte)
                                <option   value="{{$attribte->id}}">{{$attribte->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" class="btn btn-block btn-success width-btn-small" value="ذخیره">
                </form>
            </div>
        </div>


@endsection