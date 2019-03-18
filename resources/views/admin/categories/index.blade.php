@extends('admin.layout.master')

@section('content')
    @if(Session::has('error_category'))
        <div class="alert alert-danger rtl">
            <div>
                {{session('error_category')}}
            </div>
        </div>
    @endif
    <div class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">دسته بندی ها</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
                <a class="btn btn-app mgr-7" href="{{route('categories.create')}}">
                    <i class="fa fa-plus"></i> ایجاد
                </a>
            <table class="table table-condensed">
                <tbody>
                <tr>
                    <th class="text-center"  style="width: 10px">شناسه</th>
                    <th class="text-center" >عنوان</th>
                    <th class="text-center" >عملیات</th>
                </tr>
                @foreach($categories as  $cat)
                    <tr>
                        <td class="text-center" >{{$cat->id}}</td>
                        <td class="text-center" >{{$cat->name}}</td>
                        <td class="text-center" >
                            <a href="{{route('categories.edit',$cat->id)}}" class="btn btn-primary">ویرایش</a>
                            <form class="display-inline-block" method="post" action="{{route('categories.destroy',$cat->id)}}">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                    @if(count($cat->childrenRecorsive)>0)
                        @include('admin.partials.category_index',['categories'=>$cat->childrenRecorsive,'level'=>1])
                    @endif
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    </div>
@endsection