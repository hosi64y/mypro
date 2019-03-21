<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::paginate(10);
        return view('admin.brands.index',compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'title'=>'required|unique:brands',
            'description'=>'required',
            'photo_id'=>'required'
        ],[
            'title.unique'=>'نام برند نباید تکراری باشد.',
            'title.required'=>'ورود نام برند الزامی می باشد.',
            'description.required'=>'ورود توضیحات الزامی می باشد.',
            'photo_id.required'=>'ورود تصویر برند الزامی می باشد.',
        ]);
        if ($validate->fails()){
            return redirect(route('brands.create'))->withErrors($validate)->withInput();
        }else{
            $brand=new Brand();
            $brand->title=$request->title;
            $brand->description=$request->description;
            $brand->photo_id=$request->photo_id;
            $brand->save();
            Session::flash('success_brand','برند '.$request->title.' با موفقیت ثبت گردید.');
            return redirect(route('brands.create'));
        }
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
        $brands=Brand::findOrFail($id);

        return view('admin.brands.edit',['brands'=>$brands]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
