@extends('admin.layout.master')

@section('content')
    <div class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">تعیین ویژگی دسته بندی ها</h3>
            </div>
            <form action="{{route('categories.save_setting',$category->id)}}" method="post" role="form" class="pd-form">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>ویژگی ها</label>
                    <select class="form-control select2 select2-hidden-accessible" multiple name="attributeGroups[]" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        @foreach($atrributeGroup as $atrribute)
                            <option value="{{$atrribute->id}}" @if(in_array($atrribute->id,$category->attributeGroups->pluck('id')->toArray())) selected @endif>{{$atrribute->name}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="submit" class="btn btn-block btn-success width-btn-small" value="ذخیره">
            </form>
        </div>
    </div>


@endsection