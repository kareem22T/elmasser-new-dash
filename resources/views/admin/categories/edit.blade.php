@extends('layouts.admin')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">


            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.categories.update', $category) }}">
                @csrf
                @method('PUT')

                <div class="col-12 col-lg-8 p-0 main-box">
                    <div class="col-12 px-0">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> تعديل
                        </div>
                        <div class="col-12 divider" style="min-height: 2px;"></div>
                    </div>
                    <div class="col-12 p-3 row">

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                العنوان
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="title" required maxlength="190" class="form-control"
                                    value="{{ $category->title }}">
                            </div>
                        </div>


                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الرابط
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="slug" required maxlength="190" class="form-control"
                                    value="{{ $category->slug }}">
                            </div>
                        </div>

                        <div class="col-12 col-lg-12 p-2">
                            <div class="col-12">
                                ميتا الوصف
                            </div>
                            <div class="col-12 pt-3">
                                <textarea name="meta_description" required maxlength="10000" class="form-control" style="min-height:150px">{{ $category->meta_description }}</textarea>
                            </div>
                        </div>

						<div class="col-12 col-lg-12 p-2">
                            <div class="col-12">
                                الكلمات المفتاحية
                            </div>
                            <div class="col-12 pt-3">
                                <textarea name="meta_keywords" required maxlength="10000" class="form-control" style="min-height:150px">{{ $category->meta_keywords }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-2">
                        <div class="col-12">
                            اضافة اللي الصفحة الرئيسية
                        </div>
                        <div class="col-12 pt-3">
                            <select class="form-control" name="is_at_home">
                                <option @if (old('is_at_home') == '0') selected @endif value="0">لا</option>
                                <option @if (old('is_at_home') == '1') selected @endif value="1">نعم</option>
                            </select>
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
