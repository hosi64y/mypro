<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use App\AttributeValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class attributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributesValue=AttributeValue::with('attributeGroup')->get();
        return view('admin.attributesValue.index',['attributesValue'=>$attributesValue]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attribtesGroup=AttributeGroup::all();

        return view('admin.attributesValue.create',compact(['attribtesGroup']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributeValue=new AttributeValue();
        $attributeValue->title=$request->title;
        $attributeValue->attributeGroup_id=$request->attributeGroup_id;
        $attributeValue->save();

        Session::flash('attribute_succcess','ویژگی جدید با موفقیت ایجاد شد.');
        return redirect('administrator/attributes_value');
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
        $attributeValue=AttributeValue::findOrFail($id);
        $attribtesGroup=AttributeGroup::all();
        return view('admin.attributesValue.edit',['attributeValue'=>$attributeValue,'attribtesGroup'=>$attribtesGroup]);
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
        $attributeValue=AttributeValue::findOrFail($id);
        $attributeValue->title=$request->title;
        $attributeValue->attributeGroup_id=$request->attributeGroup_id;
        $attributeValue->save();

        Session::flash('attribute_edit','مقدار ویژگی با موفقیت ویرایش شد.');

        return redirect('administrator/attributes_value');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeValue=AttributeValue::findOrFail($id);
        $attributeValue->delete();

        Session::flash('attribute_delete','مقدار ویژگی با موفقیت حذف شد.');

        return redirect('administrator/attributes_value');
    }
}
