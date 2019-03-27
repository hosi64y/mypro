<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::with('childrenRecorsive')
            ->where('parent_id',null)
            ->get();
        return view('admin\categories\index',compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::with('childrenRecorsive')->where('parent_id',null)->get();

        return view('admin.categories.create',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category=new Category();
        $category->name=$request->name;
        $category->parent_id=$request->category_parent;
        $category->meta_title=$request->meta_title;
        $category->meta_desc=$request->meta_desc;
        $category->meta_keywords=$request->meta_keywords;
        $category->save();
        return redirect('administrator/categories');
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
        $category=Category::findOrFail($id);
        $categories=Category::with('childrenRecorsive')->where('parent_id',null)->get();
        return view('admin.categories.edit',['category'=>$category,'categories'=>$categories]);
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
        $category=Category::findOrFail($id);
        $category->name=$request->name;
        $category->parent_id=$request->category_parent;
        $category->meta_title=$request->meta_title;
        $category->meta_desc=$request->meta_desc;
        $category->meta_keywords=$request->meta_keywords;
        $category->save();
        return redirect('administrator/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $category=Category::findOrFail($id);
        $category=Category::with('childrenRecorsive')->where('id',$id)->first();
        if (count($category->childrenRecorsive)>0){
            Session::flash('error_category','این دسته شامل زیر دسته می باشد.به همین علت امکان حذف وجود ندارد.');
            return redirect('administrator/categories');
        }
        $category->delete();
        return redirect('administrator/categories');
    }

    public function indexSetting($id)
    {
        $category=Category::findOrFail($id);
        $atrributeGroup=AttributeGroup::all();
        return view('admin.categories.index-setting',compact(['atrributeGroup','category']));
    }

    public function saveSetting(Request $request,$id)
    {
        $category=Category::findOrFail($id);
        $category->attributeGroups()->sync($request->attributeGroups);
        $category->save();

        return redirect('/administrator/categories/');
    }

    public function apiIndex()
    {
      $categories=Category::with('childrenRecorsive')->where('parent_id',null)->get();

      $response=['categories'=>$categories];

      return response()->json($response);
    }
}
