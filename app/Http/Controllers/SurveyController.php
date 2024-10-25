<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:surveys-create', ['only' => ['create','store']]);
        $this->middleware('permission:surveys-read',   ['only' => ['show', 'index']]);
        $this->middleware('permission:surveys-update',   ['only' => ['edit','update']]);
        $this->middleware('permission:surveys-delete',   ['only' => ['delete']]);
    }

    public function index(Request $request)
    {
        $surveys = Survey::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('title','LIKE','%'.$request->q.'%');
        })->orderByDesc('id')->paginate(100);
        return view('admin.surveys.index',compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.surveys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $survey = Survey::create([
           'user_id'     => auth()->user()->id,
           'title'       => $request->title,
           'is_default'  => $request->is_default,
        ]);
        if ($survey->is_default == 1){
            Survey::whereNotIn('id', [$survey->id])->update(['is_default' => 0]);
        }
        toastr()->success(__('utils/toastr.process_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.surveys.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        return view('admin.surveys.edit',compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        $survey->update([
           'title'      => $request->title,
           'is_default' => $request->is_default,
        ]);
        if ($survey->is_default == 1){
            Survey::whereNotIn('id', [$survey->id])->update(['is_default' => 0]);
        }
        toastr()->success(__('utils/toastr.process_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.surveys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        if(!auth()->user()->isAbleTo('surveys-delete'))abort(403);
        $survey->delete();
        toastr()->success(__('utils/toastr.process_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.surveys.index');
    }

}
