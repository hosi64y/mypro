<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::paginate(10);
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::with('childrenRecorsive')->where('parent_id',null)->get();
        $brands=Brand::all();
        return view('admin.products.create',compact(['categories','brands']));
    }

    public function generateSku()
    {
        $rand=mt_rand(1000,99999);
        if ($this->checkSku($rand))
            $this->generateSku();
        return $rand;
    }

    public function checkSku($sku)
    {
        return Product::where('sku',$sku)->exists();
    }

    public function makeSlug($string)
    {
        $string=strtolower($string);
        $string=str_replace(['?','؟'],'',$string);
        return preg_replace('/\s+/u','-',trim($string));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->all();
        $model=new Product();
        $model->title=$request->title;
        $model->sku=$this->generateSku();
        $model->slug=$this->makeSlug($request->slug);
        $model->status=$request->status;
        $model->price=$request->price;
        $model->discount=$request->discount_price;
        $model->description=$request->description;
        $model->brand_id=$request->brand;
        $model->user_id=1;
        $model->meta_title=$request->meta_title;
        $model->meta_desc=$request->meta_desc;
        $model->meta_keywords=$request->meta_keywords;

        $model->save();

        $attribuute=explode(',',$request->input('attributes')[0]);
        $photos=explode(',',$request->input('photo_id')[0]);

        $model->categories()->sync($request->categories);
        $model->AttributeValue()->sync($attribuute);
        $model->photos()->sync($photos);

        session()->flash('success','محصول با موفقیت ثبت گردید.');
        return redirect('/administrator/products');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $brands=Brand::all();
        $product=Product::with('categories','brand','AttributeValue','photos')->whereId($id)->first();
        return view('admin.products.edit',compact(['brands','product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model=Product::findOrFail($id);
        $model->title=$request->title;
        $model->sku=$this->generateSku();
        $model->slug=$this->makeSlug($request->slug);
        $model->status=$request->status;
        $model->price=$request->price;
        $model->discount=$request->discount_price;
        $model->description=$request->description;
        $model->brand_id=$request->brand;
        $model->user_id=1;
        $model->meta_title=$request->meta_title;
        $model->meta_desc=$request->meta_desc;
        $model->meta_keywords=$request->meta_keywords;

        $model->save();

        $attribuute=explode(',',$request->input('attributes')[0]);
        $photos=explode(',',$request->input('photo_id')[0]);

        $model->categories()->sync($request->categories);
        $model->AttributeValue()->sync($attribuute);
        $model->photos()->sync($photos);

        session()->flash('success','محصول با موفقیت ویرایش گردید.');
        return redirect('/administrator/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $product->delete();

        session()->flash('success','محصول با موفقیت حذف گردید.');
        return redirect('/administrator/products');
    }
}
