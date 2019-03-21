@extends('admin.layout.master')

@section('content')
        <div class="content">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد ویژگی</h3>
                </div>
                <form action="{{route('attributes_group.store')}}" method="post" role="form" class="pd-form">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>نام</label>
                        <input type="text" name="name" class="form-control" placeholder="عنوان ویژگی را ورد کنید...">
                    </div>
                    <div class="form-group">
                        <label>نوع</label>
                        <select class="form-control select2 select2-hidden-accessible" name="type" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option  value="select">لیست تکی</option>
                            <option  value="multiple">لیست چندتایی</option>
                        </select>
                    </div>

                    <input type="submit" class="btn btn-block btn-success width-btn-small" value="ذخیره">
                </form>
            </div>
        </div>


@endsection