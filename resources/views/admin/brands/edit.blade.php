@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="/admin/dist/css/dropzone.min.css">
@endsection
@section('content')
    <div class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش ویژگی</h3>
            </div>
            <form action="{{route('brands.update',$brands->id)}}" method="post" role="form" class="pd-form">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <label>تصویر</label>

                    <img src="{{$brands->photo->path}}" alt="">
                </div>
                <div class="form-group">
                    <label>عنوان</label>
                    <input type="text" name="title" value="{{$brands->title}}" class="form-control" placeholder="عنوان ویژگی را ورد کنید...">
                    @if($errors->has('title'))<div class="alert alert-danger">{{$errors->first('title')}}</div> @endif
                </div>
                <div class="form-group">
                    <label>توضیحات</label>
                    <textarea name="description" class="form-control" placeholder="توضیحات برند را ورد کنید..." >{{$brands->description}}</textarea>
                    @if($errors->has('description'))
                        <div class="alert alert-danger">{{$errors->first('description')}}</div>
                    @endif
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