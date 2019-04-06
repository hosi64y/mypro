@extends('admin.layout.master')

@section('styles')
    <link rel="stylesheet" href="/admin/dist/css/dropzone.min.css">
    <script src="/admin/plugins/ckeditor/ckeditor.js"></script>

@endsection
@section('content')
    <div id="app">

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
                    <h3 class="box-title">ویرایش محصول</h3>
                </div>
                <form action="{{route('products.update',$product->id)}}" method="post" role="form" class="pd-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                        <label>عنوان</label>
                        <input type="text" name="title" class="form-control" placeholder="عنوان محصول را وارد کنید..." value="{{ $product->title }}" >
                        @if($errors->has('title'))<div class="alert alert-danger">{{$errors->first('title')}}</div> @endif
                    </div>
                    <div class="form-group">
                        <label>نام مستعار محصول</label>
                        <input type="text" name="slug" class="form-control" placeholder="نام مستعار محصول را وارد کنید..." value="{{ $product->slug }}" >
                        @if($errors->has('title'))<div class="alert alert-danger">{{$errors->first('title')}}</div> @endif
                    </div>
                    <div class="form-group">
                        <label>وضعیت نشر</label><br>
                        <label for="status1">منتشر شده</label><input id="status1" type="radio" @if($product->status==1)checked @endif name="status" value="1">
                        <label for="status0">منتشر نشده<input id="status0" type="radio" name="status" @if($product->status==0)checked @endif value="0">
                    </div>
                    <div class="form-group">
                        <label>قیمت</label>
                        <input type="text" name="price" class="form-control" placeholder="قیمت محصول را وارد کنید..." value="{{ $product->price }}" >
                        @if($errors->has('title'))<div class="alert alert-danger">{{$errors->first('title')}}</div> @endif
                    </div>
                    <div class="form-group">
                        <label>قیمت ویژه</label>
                        <input type="text" name="discount_price" class="form-control" placeholder="قیمت محصول را وارد کنید..." value="{{ $product->discount }}" >
                        @if($errors->has('title'))<div class="alert alert-danger">{{$errors->first('title')}}</div> @endif
                    </div>
                    <div class="form-group">
                        <label>توضیحات</label>
                        <textarea id="description" name="description" class="form-control" placeholder="توضیحات برند را ورد کنید..." >{{ $product->description }}</textarea>
                        @if($errors->has('description'))
                            <div class="alert alert-danger">{{$errors->first('description')}}</div>
                        @endif
                    </div>

                    <attribute-component :brands="{{$brands}}" :product="{{$product}}"></attribute-component>

                    <div class="form-group">

                        <label>گالری تصاویر</label>
                        <input type="hidden" name="photo_id[]" id="product-photo" value="{{old('photo_id')}}">
                        <div class="dropzone" id="drop">

                        </div>
                        <div class="col-sm-12">
                            @foreach($product->photos as $photo)
                                    <div class="col-sm-3"  id="photoUploaded_{{$photo->id}}">
                                        <img class="img-responsive" src="{{$photo->path}}" alt="">
                                        <input type="button" onclick="removePic({{$photo->id}})" class="btn btn-danger" value="حذف">
                                    </div>
                            @endforeach
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
                        <input type="text" name="meta_title" class="form-control" placeholder="عنوان سئو را ورد کنید..." value="{{$product->meta_title}}">
                    </div>
                    <div class="form-group">
                        <label>توضیحات سئو</label>
                        <textarea name="meta_desc" class="form-control" placeholder="توضیحات سئو را ورد کنید...">{{$product->meta_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>کلمات کلیدی سئو</label>
                        <input type="text" name="meta_keywords" class="form-control" placeholder="کلمات کلیدی سئو را ورد کنید..." value="{{$product->meta_keywords}}">
                    </div>

                    <input onclick="photoGallery()" type="submit" class="btn btn-block btn-success width-btn-small" value="ذخیره">
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="/admin/dist/js/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover=false;
        var photoProduct=[];
        var photo=[].concat({{$product->photos->pluck('id')}})
        console.log(photo);
        var myDropzone = new Dropzone("div#drop", {
            url: "{{route('photo_upload')}}",
            addRemoveLinks:true,
//            maxFiles:1,
            sending:function (file,xhr,formData) {
                formData.append("_token","{{csrf_token()}}");
            },
            success:function (file,response) {
                photoProduct.push(response.photo_id);
            }
        });

        CKEDITOR.replace( 'description' ,function () {
            language:'fa';
        });
        function photoGallery() {
            document.getElementById('product-photo').value=photoProduct.concat(photo);

        }
        removePic=function (id) {
            var index=photo.indexOf(id);
            photo.splice(index,1);
            document.getElementById('photoUploaded_'+id).remove();
        }
    </script>
@endsection
