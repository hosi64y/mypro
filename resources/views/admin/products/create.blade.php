@extends('admin.layout.master')

@section('styles')
    <link rel="stylesheet" href="/admin/dist/css/dropzone.min.css">
@endsection
@section('content')
        <div class="content">
            @if(Session::has('success_brand'))
                <div class="alert alert-success">
                    <div>
                        {{session('success_brand')}}
                    </div>
                </div>
            @endif
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد برند</h3>
                </div>
                <form action="{{route('products.store')}}" method="post" role="form" class="pd-form">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>عنوان</label>
                        <input type="text" name="title" class="form-control" placeholder="عنوان محصول را وارد کنید..." value="{{ old('title') }}" >
                        @if($errors->has('title'))<div class="alert alert-danger">{{$errors->first('title')}}</div> @endif
                    </div>
                    <div class="form-group">
                        <label>نام مستعار محصول</label>
                        <input type="text" name="slug" class="form-control" placeholder="نام مستعار محصول را وارد کنید..." value="{{ old('title') }}" >
                        @if($errors->has('title'))<div class="alert alert-danger">{{$errors->first('title')}}</div> @endif
                    </div>
                    <div class="form-group">
                        <label>وضعیت نشر</label><br>
                        <label for="status1">منتشر شده</label><input id="status1" type="radio" name="status" value="1">
                        <label for="status0">منتشر نشده<input id="status0" type="radio" name="status" value="0">
                        @if($errors->has('title'))<div class="alert alert-danger">{{$errors->first('title')}}</div> @endif
                    </div>
                    <div class="form-group">
                        <label>قیمت</label>
                        <input type="text" name="price" class="form-control" placeholder="قیمت محصول را وارد کنید..." value="{{ old('title') }}" >
                        @if($errors->has('title'))<div class="alert alert-danger">{{$errors->first('title')}}</div> @endif
                    </div>
                    <div class="form-group">
                        <label>قیمت ویژه</label>
                        <input type="text" name="discount-price" class="form-control" placeholder="قیمت محصول را وارد کنید..." value="{{ old('title') }}" >
                        @if($errors->has('title'))<div class="alert alert-danger">{{$errors->first('title')}}</div> @endif
                    </div>
                    <div class="form-group">
                        <label>توضیحات</label>
                        <textarea name="description" class="form-control" placeholder="توضیحات برند را ورد کنید..." >{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                            <div class="alert alert-danger">{{$errors->first('description')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>دسته بندی</label>
                        <select class="form-control select2 select2-hidden-accessible" name="category_parent" style="width: 100%;" tabindex="-1" aria-hidden="true" multiple>
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @if(count($cat->childrenRecorsive)>0)
                                    @include('admin.partials.category',['categories'=>$cat->childrenRecorsive,'level'=>1])
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand">برند</label>
                        <select class="form-control select2 select2-hidden-accessible" name="brand" id="brand">
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">

                        <label>تصویر</label>
                        <input type="hidden" name="photo_id" id="photo-brand" value="{{old('photo_id')}}">
                        <div class="dropzone" id="drop">

                        </div>
                        @if($errors->has('photo_id'))
                            <div class="alert alert-danger">{{$errors->first('photo_id')}}</div>
                        @endif
                        @if(old('photo_id'))
                            <div class="alert alert-warning rtl">تصویر ارسالی قبل شما وارد گردیده است. در صورتی که میخواهید تصویر دیگری ارسال کنید آن را بارگذاری کنید.</div>
                        @endif

                    </div>
                    <div class="form-group">
                        <label>عنوان سئو</label>
                        <input type="text" name="meta_title" class="form-control" placeholder="عنوان سئو را ورد کنید...">
                    </div>
                    <div class="form-group">
                        <label>توضیحات سئو</label>
                        <textarea name="meta_desc" class="form-control" placeholder="توضیحات سئو را ورد کنید..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>کلمات کلیدی سئو</label>
                        <input type="text" name="meta_keywords" class="form-control" placeholder="کلمات کلیدی سئو را ورد کنید...">
                    </div>

                    <input type="submit" class="btn btn-block btn-success width-btn-small" value="ذخیره">
                </form>
            </div>
        </div>


@endsection

@section('scripts')
    <script src="/admin/dist/js/dropzone.min.js"></script>
    <script>
        var myDropzone = new Dropzone("div#drop", {
            url: "{{route('photo_upload')}}",
            addRemoveLinks:true,
            maxFiles:1,
            sending:function (file,xhr,formData) {
                formData.append("_token","{{csrf_token()}}");
            },
            success:function (file,response) {
              document.getElementById('photo-brand').value=response.photo_id;

            }
        });
    </script>
@endsection
