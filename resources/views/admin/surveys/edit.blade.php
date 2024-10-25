@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
    <div class="col-12 col-lg-12 p-0 ">
        <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.surveys.update',$survey)}}">
            @csrf
            @method("PUT")
            <div class="col-12 col-lg-8 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fas fa-info-circle"></span> تعديل استطلاع
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                <div class="col-12 p-3 row">
                    <div class="col-12"></div>

                    <div class="col-12 col-lg-12 p-2">
                        <div class="col-12">
                            سؤال الاستطلاع
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="title" required maxlength="190" class="form-control" value="{{old('title',$survey??"")}}">
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <div class="col-12">
                            رئيسى
                        </div>
                        <div class="col-12 pt-3">
                            <select class="form-control" name="is_default">
                                <option @if(old('is_default',$survey??"")=="0" ) selected @endif value="0">لا</option>
                                <option @if(old('is_default',$survey??"")=="1" ) selected @endif value="1">نعم</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">حفظ</button>
            </div>
        </form>
    </div>
</div>
@endsection
