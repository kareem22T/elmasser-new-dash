<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{

    public function __construct()
    {
       /*  $this->middleware('permission:categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:categories-read',   ['only' => ['show', 'index']]);
        $this->middleware('permission:categories-update',   ['only' => ['edit','update']]);
        $this->middleware('permission:categories-delete',   ['only' => ['delete']]); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!auth()->user()->isAbleTo('categories-read'))abort(403);
        $prices = Price::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('title','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();

        return view('admin.prices.index',compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //if(!auth()->user()->isAbleTo('categories-create'))abort(403);
        return view('admin.prices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if(!auth()->user()->isAbleTo('categories-create'))abort(403);
        $request->validate([
            'title'=>"required|max:190",
            'description'=>"required|max:190",
            'icon'=>"required|max:190",
        ]);
        $price = Price::create([
            'user_id'=>auth()->user()->id,
            "title"=>$request->title,
            "description"=>$request->description,
            "icon"=>$request->icon,
        ]);
        toastr()->success(__('utils/toastr.category_store_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.prices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //if(!auth()->user()->isAbleTo('categories-read'))abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {   
        //if(!auth()->user()->isAbleTo('categories-update'))abort(403);
        return view('admin.prices.edit',compact('price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        //if(!auth()->user()->isAbleTo('categories-update'))abort(403);
        $request->validate([
            'title'=>"required|max:190",
            'description'=>"required|max:190",
            'icon'=>"required|max:190",
        ]);
        $price->update([
            "title"=>$request->title,
            "description"=>$request->description,
            "icon"=>$request->icon,
        ]);
        toastr()->success(__('utils/toastr.category_update_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.prices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        //if(!auth()->user()->isAbleTo('categories-delete'))abort(403);
        $price->delete();
        toastr()->success(__('utils/toastr.category_destroy_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.prices.index');
    }
}
