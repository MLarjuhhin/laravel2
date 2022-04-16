<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $paginator=BlogCategory::paginate(15);
       return view('blog.admin.categories.index',compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryList=BlogCategory::all();
        #   $item=BlogCategory::find($id);
        #   $item=BlogCategory::findOrFail($id);// retrun 404 if not exist
        #   $item=BlogCategory::where('id',$id)->first();

        $item=BlogCategory::findOrFail($id);

        return view('blog.admin.categories.edit',compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
   //     dd(__METHOD__,$request->all(),$id);

       $item=BlogCategory::find($id);

       if(empty($item)){
           return back()
               ->withErrors(['msg'=>"запись id=[{$id}] не найдена"])
               ->withInput();
       }

       $data=$request->all();

       $resulut=$item
           ->fill($data)
           ->save();

       if($resulut){
           return redirect()
               ->route('blog.admin.categoies.edit',$item->id)
               ->with(['msg'=>'Успешно сохраненно']);
       }else{
           return back()
               ->withErrors(['msg'=>'Ошибка сохранения'])
               ->withInput();
       }

    }


}
