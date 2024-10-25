<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:categories-read',   ['only' => ['show', 'index']]);
        $this->middleware('permission:categories-update',   ['only' => ['edit','update']]);
        $this->middleware('permission:categories-delete',   ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!auth()->user()->isAbleTo('categories-read'))abort(403);
        $categories =  Category::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('title','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();

        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->isAbleTo('categories-create'))abort(403);
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->isAbleTo('categories-create'))abort(403);
        $request->merge([
            'slug'=>\MainHelper::slug($request->slug)
        ]);

        $request->validate([
            'slug'=>"required|max:190|unique:categories,slug",
            'title'=>"required|max:190",
            'meta_description'=>"required|max:10000",
            'meta_keywords'=>"required|max:10000",
            'is_at_home'=>"required|in:0,1",
        ]);
        $category = Category::create([
            'user_id'=>auth()->user()->id,
            "slug"=>$request->slug,
            "title"=>$request->title,
            "meta_description"=>$request->meta_description,
            "is_at_home"=>$request->is_at_home,
            "meta_keywords"=>$request->meta_keywords,
        ]);
        toastr()->success(__('utils/toastr.category_store_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if(!auth()->user()->isAbleTo('categories-read'))abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if(!auth()->user()->isAbleTo('categories-update'))abort(403);
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if(!auth()->user()->isAbleTo('categories-update'))abort(403);
        $request->merge([
            'slug'=>\MainHelper::slug($request->slug)
        ]);

        $request->validate([
            'slug'=>"required|max:190|unique:categories,slug,".$category->id,
            'title'=>"required|max:190",
            'meta_description'=>"required|max:10000",
            'meta_keywords'=>"required|max:10000",
            'is_at_home'=>"required|in:0,1",
        ]);
        $category->update([
            "slug"=>$request->slug,
            "title"=>$request->title,
            "meta_description"=>$request->meta_description,
            "meta_keywords"=>$request->meta_keywords,
            "is_at_home"=>$request->is_at_home,
        ]);
        toastr()->success(__('utils/toastr.category_update_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(!auth()->user()->isAbleTo('categories-delete'))abort(403);
        $category->delete();
        toastr()->success(__('utils/toastr.category_destroy_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.categories.index');
    }
}
