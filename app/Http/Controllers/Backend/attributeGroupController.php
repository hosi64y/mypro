<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class attributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributesGroup=AttributeGroup::paginate(10);

        return view('admin.attributes.index',['attributesGroup'=>$attributesGroup]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributeGroup=new AttributeGroup();

        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributeGroup=new AttributeGroup();
        $attributeGroup->name=$request->name;
        $attributeGroup->type=$request->type;
        $attributeGroup->save();

        Session::flash('attribute_succcess','ویژگی جدید با موفقیت ایجاد شد.');
        return redirect('administrator/attributes');
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
        $attributeGroup=AttributeGroup::findOrFail($id);

        return view('admin.attributes.edit',['attributeGroup'=>$attributeGroup]);
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
        $attributeGroup=AttributeGroup::findOrFail($id);
        $attributeGroup->name=$request->name;
        $attributeGroup->type=$request->type;
        $attributeGroup->save();

        Session::flash('attribute_edit','ویژگی با موفقیت ویرایش شد.');

        return redirect('administrator/attributes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeGroup=AttributeGroup::findOrFail($id);
        $attributeGroup->delete();

        Session::flash('attribute_delete','ویژگی با موفقیت حذف شد.');

        return redirect('administrator/attributes');

    }
}
