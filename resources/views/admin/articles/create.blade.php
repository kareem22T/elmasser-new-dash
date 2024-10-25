@extends('layouts.admin')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">
            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                  action="{{ route('admin.articles.store') }}">
                @csrf
                <div class="col-12 col-lg-8 p-0 main-box">
                    <div class="col-12 px-0">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> إضافة جديد
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
                                       value="{{ old('title') }}">
                            </div>
                        </div>
                        {{--<div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الرابط
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="slug" required maxlength="190" class="form-control" value="{{ old('slug') }}">
                            </div>
                        </div>--}}

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                القسم
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control select2-select" name="category_id" required size="1"
                                        style="height:30px;opacity: 0;">
                                    @foreach ($categories as $id => $title)
                                        <option value="{{ $id }}"
                                                @if (old('category_id') == $id) selected @endif>{{ $title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                المحرر
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control select2-select" name="user_id" required size="1"
                                        style="height:30px;opacity: 0;">
                                    @foreach ($users as $id => $name)
                                        <option value="{{ $id }}"
                                                @if (Auth::user()->id == $id) selected @endif>{{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-12 p-2">
                            <div class="col-12">
                                الوسوم
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control select2-select-tags" name="tags[]" multiple size="1"
                                        style="height:30px;opacity: 0;">
                                    @foreach ($tags as $id => $tag_name)
                                        <option value="{{ $id }}">{{ $tag_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-6 p-2">
                            <div class="col-12">
                                الصورة الرئيسية
                            </div>
                            <div class="col-12 pt-3">
                                <input readonly type="text" class="form-control" required id="main_image" name="main_image">
                            </div>
                            <a href="" class="popup_selector" data-inputid="main_image">اختيار صورة</a>
                        </div>

                        <div class="col-6  p-2">
                            <div class="col-12">
                                عنوان الصورة
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="main_image_title" maxlength="190" class="form-control" value="{{ old('main_image_title') }}">
                            </div>
                        </div>

                        <div class="col-12  p-2">
                            <div class="col-12">
                                الوصف
                            </div>
                            <div class="col-12 pt-3">
                                <textarea name="description" class="ckeditor">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        {{--<div class="col-12 p-2">
                            <div class="col-12">
                                ميتا الوصف
                            </div>
                            <div class="col-12 pt-3">
                                <textarea name="meta_description" class="form-control"
                                          style="min-height:150px">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>--}}

                        <div class="col-6 p-2">
                            <div class="col-12">
                                عاجل
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="is_urgent">
                                    <option @if (old('is_urgent') == '0') selected @endif value="0">لا</option>
                                    <option @if (old('is_urgent') == '1') selected @endif value="1">نعم</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <div class="col-12">
                                مميز
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="is_featured">
                                    <option @if (old('is_featured') == '0') selected @endif value="0">لا</option>
                                    <option @if (old('is_featured') == '1') selected @endif value="1">نعم</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <div class="col-12">
                                تريند اليوم
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="is_trend">
                                    <option @if (old('is_trend') == '0') selected @endif value="0">لا</option>
                                    <option @if (old('is_trend') == '1') selected @endif value="1">نعم</option>
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
