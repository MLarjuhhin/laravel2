<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController;
use App\Http\Requests\BlogPostUpdateRequset;
use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogAdminPostController extends BaseController
{
    private $blogPostRepository;
    private $blogCategoryRepository;
    
    public function __construct(){
        parent::__construct();
        $this->blogPostRepository=app(BlogPostRepository::class);
        $this->blogCategoryRepository=app(BlogCategoryRepository::class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate=$this->blogPostRepository->getAllWithPaginate();
        return view('blog.admin.posts.index',compact('paginate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item=new BlogPost();
    
        $cateoryList=$this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.posts.edit',compact('item','cateoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostCreateRequset $request)
    {
        $data=$request->input();
        $item=(new BlogPost())->create($data);
    
        if($item){
            return redirect()
                ->route('blog.admin.posts.edit',$item->id)
                ->with(['success'=>'Запись успешно сохранено']);
        }else{
        return back()
            ->withErrors(['msg'=>"Ошибка"])
            ->withInput();
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
        dd(__METHOD__,$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
   //     dd(__METHOD__,$id);
    $item=$this->blogPostRepository->getEdit($id);
    if (empty($item)){
        abort(404);
    }
    
    $cateoryList=$this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.posts.edit',compact('item','cateoryList'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequset $request, $id)
    {
        $item=$this->blogPostRepository->getEdit($id);
        if (empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись id=[{$id}] не найденна"])
                ->withInput();
        }
        $data=$request->all();
       /*
        *
        * v Observer
        *AppSeverProvider так же добавить
        *
        if(empty($data['slug'])){
            $data['slug']=Str::slug($data['title']);
        }
        if(empty($item->published_at) && $data['is_published']) {
            $data['published_at'] = Carbon::now();
        }
            */
            $result=$item->update($data);
            
         
            if($result){
                return redirect()
                    ->route('blog.admin.posts.edit',$item->id)
                    ->with(['success'=>'Запись успешно обновленна']);
            }else{
                return back()
                    ->withErrors(['msg'=>"Ошибка"])
                    ->withInput();
            }
        
        //dd(__METHOD__,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__,$id);
    }
}
