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
                <form action="{{route('brands.store')}}" method="post" role="form" class="pd-form">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>عنوان</label>
                        <input type="text" name="title" class="form-control" placeholder="عنوان برند را ورد کنید..." value="{{ old('title') }}" >
                        @if($errors->has('title'))<div class="alert alert-danger">{{$errors->first('title')}}</div> @endif
                    </div>

                    <div class="form-group">
                        <label>عنوان</label>
                        <textarea name="description" class="form-control" placeholder="توضیحات برند را ورد کنید..." >{{ old('description') }}</textarea>
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
            init: function () {
                this.on("removedfile", function (file) {
                    $.post({
                        url: "{{route('photo_delete')}}",
                        data: {id: $('[name="photo_id"]').val(), _token: "{{csrf_token()}}"},
                        dataType: 'json',
                        success: function (data) {
                            document.getElementById('photo-brand').value="";
                        }
                    });
                });
            },
            success:function (file,response) {
              document.getElementById('photo-brand').value=response.photo_id;

            }
        });
    </script>
@endsection
