<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategoty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Repositories\BlogCategoryRepository;

class CategoryConroller extends BaseController
{
    private $blogCategoryRepository;
    
    public function __construct(){
        parent::__construct();
        $this->blogCategoryRepository=app(BlogCategoryRepository::class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    //    $paginator = BlogCategoty::paginate(15);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    //    dd(__METHOD__);
    
        $item=new BlogCategoty();
        
        $cateoryList =$this->blogCategoryRepository->getForComboBox();

        return view("blog.admin.categories.edit",compact('item','cateoryList'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        
     //  dd(__METHOD__);
        $data=$request->input();
//        if(empty($data['slug'])){
//            $data['slug']=Str::slug($data['title']);
//        }

       $item=(new BlogCategoty())->create($data);
        
        if($item){
            return redirect()
                ->route("blog.admin.categories.edit",[$item->id])
                ->with(['success'=>"Успешно созранено"]);
        }else{
            return back()
                ->withErrors(['msg'=>'Ошибка'])
                ->withInput();
        }
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id,BlogCategoryRepository $categoryRepository)
    {
        
        //  dd(__METHOD__);
//        $item        = BlogCategoty::findOrFail($id);
//        $cateoryList = BlogCategoty::all();
        
        $item=$categoryRepository->getEdit($id);
        $cateoryList = $categoryRepository->getForComboBox();
    
        if(empty($item) || empty($cateoryList)){
            abort(404);
        }
        
        return view('blog.admin.categories.edit', compact('item', 'cateoryList'));
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        
        //  dd(__METHOD__,$request->all(),$id);
    
        
        
    //    $item = BlogCategoty::find($id);
        $item = $this->blogCategoryRepository->getEdit($id);
        
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запис с номером [{$id}] не найдена+("])
                ->withInput();
        }
        $data   = $request->all();
        $result = $item->fill($data)
            ->save();
        
        
        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => "Успешно сохранено"]);
        }else {
            return back()
                ->withErrors(['msg' => "Ошибка"])
                ->withInput();
        }
    }
    
    
}
