@extends('admin.layout.master')

@section('content')
    @if(Session::has('attribute_succcess'))
        <div class="alert alert-success rtl">
            <div>
                {{session('attribute_succcess')}}
            </div>
        </div>
    @endif
    @if(Session::has('attribute_edit'))
        <div class="alert alert-success rtl">
            <div>
                {{session('attribute_edit')}}
            </div>
        </div>
    @endif
    @if(Session::has('attribute_delete'))
        <div class="alert alert-danger rtl">
            <div>
                {{session('attribute_delete')}}
            </div>
        </div>
    @endif
    <div class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">ویژگی ها</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
                <a class="btn btn-app mgr-7" href="{{route('attributes_value.create')}}">
                    <i class="fa fa-plus"></i> ایجاد
                </a>
            <table class="table table-condensed">
                <tbody>
                <tr>
                    <th class="text-center"  style="width: 10px">شناسه</th>
                    <th class="text-center" >عنوان</th>
                    <th class="text-center" >ویژگی</th>
                    <th class="text-center" >عملیات</th>
                </tr>
                @foreach($attributesValue as  $attributes)
                    <tr>
                        <td class="text-center" >{{$attributes->id}}</td>
                        <td class="text-center" >{{$attributes->title}}</td>
                        <td class="text-center" >{{$attributes->attributeGroup->name}}</td>
                        <td class="text-center" >
                            <a href="{{route('attributes_value.edit',$attributes->id)}}" class="btn btn-primary">ویرایش</a>
                            <form class="display-inline-block" method="post" action="{{route('attributes_value.destroy',$attributes->id)}}">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    </div>
@endsection