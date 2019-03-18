@extends('admin.layout.master')

@section('content')
        <div class="content">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش ویژگی</h3>
                </div>
                <form action="{{route('attributes.update',$attributeGroup->id)}}" method="post" role="form" class="pd-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                        <label>نام</label>
                        <input type="text" name="name" value="{{$attributeGroup->name}}" class="form-control" placeholder="عنوان ویژگی را ورد کنید...">
                    </div>
                    <div class="form-group">
                        <label>نوع</label>
                        <select class="form-control select2 select2-hidden-accessible" name="type" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option @if($attributeGroup->type=="select") selected='selected' @endif value="select">لیست تکی</option>
                            <option @if($attributeGroup->type=="multiple") selected='selected' @endif value="multiple">لیست چندتایی</option>
                        </select>
                    </div>

                    <input type="submit" class="btn btn-block btn-success width-btn-small" value="ذخیره">
                </form>
            </div>
        </div>


@endsection