<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:articles-create', ['only' => ['create','store']]);
        $this->middleware('permission:articles-read',   ['only' => ['show', 'index']]);
        $this->middleware('permission:articles-update',   ['only' => ['edit','update']]);
        $this->middleware('permission:articles-delete',   ['only' => ['delete']]);
    }


    public function index(Request $request)
    {
        $articles = Article::with('category')->where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('title','LIKE','%'.$request->q.'%')->orWhere('description','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();
        return view('admin.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::pluck('tag_name', 'id');
        $categories = Category::latest()->pluck('title', 'id');
        $users = User::pluck('name', 'id');
        return view('admin.articles.create',compact('categories','tags', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->title);
        $request->merge([
            'slug'=>\MainHelper::slug($request->title)
        ]);
        $request->validate([
            //'slug'=>"required|max:190",
            'category_id'=>"required|exists:categories,id",
            'is_featured'=>"required|in:0,1",
            'is_urgent'=>"required|in:0,1",
            'is_trend'=>"required|in:0,1",
            'title'=>"required|max:190",
            'description'=>"nullable|max:100000",
            /*'meta_description'=>"nullable|max:10000",*/
        ]);
        $article = Article::create([
            'user_id'=>$request->user_id,
            'category_id'=>$request->category_id,
            "slug"=>$request->slug,
            "is_featured"=>$request->is_featured,
            "is_urgent"=>$request->is_urgent,
            "is_trend"=>$request->is_trend,
            "title"=>$request->title,
            "description"=>$request->description,
            "main_image" => (strpos($request->main_image, '\\') !== 0) ? '\\' . $request->main_image : $request->main_image,
            "main_image_title"=>$request->main_image_title,
            /*"meta_description"=>$request->meta_description,*/
        ]);
        if ($request->has('tags')){
            assignTagsToArticle($article, $request->tags);
        }
        /*if($request->hasFile('main_image')){
            $file = $this->store_file([
                'source'=>$request->main_image,
                'validation'=>"image",
                'path_to_save'=>'/uploads/articles/',
                'type'=>'ARTICLE',
                'user_id'=>\Auth::user()->id,
                'resize'=>[500,1000],
                'small_path'=>'small/',
                'visibility'=>'PUBLIC',
                'file_system_type'=>env('FILESYSTEM_DRIVER'),
                'watermark'=>true,
                'optimize'=>false
            ]);
            $article->update(['main_image'=>$file['filename']]);
        }*/
        toastr()->success(__('utils/toastr.article_store_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $article = $article->load('category', 'tags');
        $tags = Tag::pluck('tag_name', 'id');
        $categories = Category::latest()->pluck('title', 'id');
        $users = User::pluck('name', 'id');
        return view('admin.articles.edit',compact('article','categories','tags', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->merge([
            'slug'=>\MainHelper::slug($request->title)
        ]);
        $request->validate([
            //'slug'=>"required|max:190",
            'category_id'=>"required|exists:categories,id",
            'is_featured'=>"required|in:0,1",
            'is_trend'=>"required|in:0,1",
            'title'=>"required|max:190",
            'description'=>"nullable|max:100000",
            /*'meta_description'=>"nullable|max:10000",*/
        ]);
        $article->update([
            'user_id'=>$request->user_id,
            'category_id'=>$request->category_id,
            "slug"=>$request->slug,
            "is_featured"=>$request->is_featured,
            "is_urgent"=>$request->is_urgent,
            "is_trend"=>$request->is_trend,
            "title"=>$request->title,
            "main_image" => (strpos($request->main_image, '\\') !== 0) ? '\\' . $request->main_image : $request->main_image,
            "main_image_title"=>$request->main_image_title,
            "description"=>$request->description,
            /*"meta_description"=>$request->meta_description,*/
        ]);
        if ($request->has('tags')){
            assignTagsToArticle($article, $request->tags);
        }
        /*if($request->hasFile('main_image')){
            $file = $this->store_file([
                'source'=>$request->main_image,
                'validation'=>"image",
                'path_to_save'=>'/uploads/articles/',
                'type'=>'ARTICLE',
                'user_id'=>\Auth::user()->id,
                'resize'=>[500,1000],
                'small_path'=>'small/',
                'visibility'=>'PUBLIC',
                'file_system_type'=>env('FILESYSTEM_DRIVER'),
                'watermark'=>true,
                'optimize'=>false
            ]);
            $article->update(['main_image'=>$file['filename']]);
        }*/
        toastr()->success(__('utils/toastr.article_update_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        toastr()->success(__('utils/toastr.article_destroy_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.articles.index');
    }
}
