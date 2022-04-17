<?php

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Requests\BlogCategoryCreateRequset;
use App\Http\Requests\BlogCategoryUpdateRequset;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;


class CategoryController extends BaseController
{

    private $BlogCategoryRepository;

    public function __construct()
    {

        parent::__construct();

        $this->BlogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$paginator=BlogCategory::paginate(15);
        $paginator = $this->BlogCategoryRepository->getAllWithPaginate(5);
        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //dd(__METHOD__);

        $item = new BlogCategory();
        //$categoryList = BlogCategory::all();

        $categoryList = $this->BlogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.store', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(BlogCategoryCreateRequset $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = Str::of($data['title'])->slug();
        }

//      $item=new BlogCategory($data);
//      $item->save();

        $item = (new BlogCategory())->create($data);

        if ($item) {
            return redirect()->route('blog.admin.categoies.edit', [$item->id])
                ->with(['msg' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
//        $categoryList=BlogCategory::all();
        #   $item=BlogCategory::find($id);
        #   $item=BlogCategory::findOrFail($id);// retrun 404 if not exist
        #   $item=BlogCategory::where('id',$id)->first();

//        $item=BlogCategory::findOrFail($id);

        $item = $this->BlogCategoryRepository->getEdit($id);
        $categoryList = $this->BlogCategoryRepository->getForComboBox();

        if (empty($item)) {
            abort(404);
        }

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(BlogCategoryUpdateRequset $request, $id)
    {
        //     dd(__METHOD__,$request->all(),$id);

//        $rules=[
//          'title'       =>  'required|min:5|max:30',
//          'slug'        =>  'max:20',
//          'description'  =>  'string|max:500|min:3',
//          'parent_id'   =>  'required|integer|exists:blog_categories,id'
//        ];

        // $validateDate=$this->validate($request,$rules);//возвращает только данные которые прогли проверку, те без ошибки
        //   $validateDate=$request->validate($rules); // return with error

//        $validatedData = \Validator::make($request->all(),$rules);
//       $validatedData[]=$validator->passes();   //и выполнит проверку и вернет тру или фолс, без редиректа
//       $validatedData[]=$validator->validate(); //редирект в случае ошибки
//       $validatedData[]=$validator->valid();    //вернет валидные данные
//       $validatedData[]=$validator->failed();   //вернет только не верные данные
//       $validatedData[]=$validator->errors();   //вернет текст ошибки
//       $validatedData[]=$validator->fails();    //обратная от passes


        //    dd($validatedData);

        $item = $this->BlogCategoryRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        $resulut = $item
            ->fill($data)
            ->save();

        if ($resulut) {
            return redirect()
                ->route('blog.admin.categoies.edit', $item->id)
                ->with(['msg' => 'Успешно сохраненно']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

    }


}
