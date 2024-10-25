@extends('layouts.admin')
@section('content')
    <div class="col-12 p-3 row">
        @permission('users-read')
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2 px-2 my-2">
            <div class="col-12 px-0 py-1 d-flex main-box-wedit">
                <div style="width: 65px;" class="p-2">
                    <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center"
                         style="background: #0194fe;color: #fff;border-radius: 50%;width: 55px;height:55px">
                        <span class="fal fa-users font-5"></span>
                    </div>
                </div>
                <div style="width: calc(100% - 80px)" class="px-2 py-2">
                    <a class="font-1" href="{{route('admin.users.index')}}" style="color: #212529">
                        المستخدمين
                        <h6 class="font-3">{{\App\Models\User::count()}}</h6>
                    </a>
                </div>
            </div>
        </div>
        @endpermission
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2 px-2 my-2">
            <div class="col-12 px-0 py-1 d-flex main-box-wedit">
                <div style="width: 65px;" class="p-2">
                    <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center"
                         style="background: #0194fe;color: #fff; border-radius: 50%;width: 55px;height:55px">
                        <span class="fal fa-bells font-5"></span>
                    </div>
                </div>
                <div style="width: calc(100% - 80px)" class="px-2 py-2">
                    <a class="font-1" href="{{route('admin.notifications.index')}}" style="color: #212529">
                        الإشعارات
                        <h6 class="font-3">{{auth()->user()->unreadNotifications->count()}}</h6>
                    </a>
                </div>
            </div>
        </div>
        @permission('articles-read')
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2 px-2 my-2">
            <div class="col-12 px-0 py-1 d-flex main-box-wedit">
                <div style="width: 65px;" class="p-2">
                    <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center"
                         style="background: #0194fe;color: #fff; border-radius: 50%;width: 55px;height:55px">
                        <span class="fal fa-books font-5"></span>
                    </div>
                </div>
                <div style="width: calc(100% - 80px)" class="px-2 py-2">
                    <a class="font-1" href="{{route('admin.articles.index')}}" style="color: #212529;">
                        المقالات
                        <h6 class="font-3">{{\App\Models\Article::count()}}</h6>
                    </a>
                </div>
            </div>
        </div>
        @endpermission
        @permission('categories-read')
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2 px-2 my-2">
            <div class="col-12 px-0 py-1 d-flex main-box-wedit">
                <div style="width: 65px;" class="p-2">
                    <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center"
                         style="background: #0194fe;color: #fff; border-radius: 50%;width: 55px;height:55px">
                        <span class="fal fa-tag font-5"></span>
                    </div>
                </div>
                <div style="width: calc(100% - 80px)" class="px-2 py-2">
                    <a class="font-1" href="{{route('admin.categories.index')}}" style="color: #212529;">
                        الأقسام
                        <h6 class="font-3">{{\App\Models\Category::count()}}</h6>
                    </a>
                </div>
            </div>
        </div>
        @endpermission
        @permission('hub-files-read')
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2 px-2 my-2">
            <div class="col-12 px-0 py-1 d-flex main-box-wedit">
                <div style="width: 65px;" class="p-2">
                    <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center"
                         style="background: #0194fe;color: #fff; border-radius: 50%;width: 55px;height:55px">
                        <span class="fal fa-file font-5"></span>
                    </div>
                </div>
                <div style="width: calc(100% - 80px)" class="px-2 py-2">
                    <a class="font-1" href="{{route('admin.files.index')}}" style="color: #212529;">
                        الملفات
                        <h6 class="font-3">{{\App\Models\HubFile::count()}}</h6>
                    </a>
                </div>
            </div>
        </div>
        @endpermission
        @permission('menus-read')
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2 px-2 my-2">
            <div class="col-12 px-0 py-1 d-flex main-box-wedit">
                <div style="width: 65px;" class="p-2">
                    <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center"
                         style="background: #0194fe;color: #fff; border-radius: 50%;width: 55px;height:55px">
                        <span class="fal fa-list font-5"></span>
                    </div>
                </div>
                <div style="width: calc(100% - 80px)" class="px-2 py-2">
                    <a class="font-1" href="{{route('admin.menus.index')}}" style="color: #212529;">
                        القوائم
                        <h6 class="font-3">{{\App\Models\Menu::count()}}</h6>
                    </a>
                </div>
            </div>
        </div>
        @endpermission
        @permission('pages-read')
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2 px-2 my-2">
            <div class="col-12 px-0 py-1 d-flex main-box-wedit">
                <div style="width: 65px;" class="p-2">
                    <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center"
                         style="background: #0194fe;color: #fff; border-radius: 50%;width: 55px;height:55px">
                        <span class="fal fa-file-invoice font-5"></span>
                    </div>
                </div>
                <div style="width: calc(100% - 80px)" class="px-2 py-2">
                    <a class="font-1" href="{{route('admin.pages.index')}}" style="color: #212529;">
                        الصفحات
                        <h6 class="font-3">{{\App\Models\Page::count()}}</h6>
                    </a>
                </div>
            </div>
        </div>
        @endpermission
        @permission('contacts-read')
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2 px-2 my-2">
            <div class="col-12 px-0 py-1 d-flex main-box-wedit">
                <div style="width: 65px;" class="p-2">
                    <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center"
                         style="background: #0194fe;color: #fff; border-radius: 50%;width: 55px;height:55px">
                        <span class="fal fa-phone font-5"></span>
                    </div>
                </div>
                <div style="width: calc(100% - 80px)" class="px-2 py-2">
                    <a class="font-1" href="{{route('admin.contacts.index')}}" style="color: #212529;">
                        التواصل
                        <h6 class="font-3">{{\App\Models\Contact::count()}}</h6>
                    </a>
                </div>
            </div>
        </div>
        @endpermission
        @permission('announcements-read')
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2 px-2 my-2">
            <div class="col-12 px-0 py-1 d-flex main-box-wedit">
                <div style="width: 65px;" class="p-2">
                    <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center"
                         style="background: #0194fe;color: #fff; border-radius: 50%;width: 55px;height:55px">
                        <span class="fal fa-bullhorn font-5"></span>
                    </div>
                </div>
                <div style="width: calc(100% - 80px)" class="px-2 py-2">
                    <a class="font-1" href="{{route('admin.announcements.index')}}" style="color: #212529;">
                        الإعلانات
                        <h6 class="font-3">{{\App\Models\Announcement::count()}}</h6>
                    </a>
                </div>
            </div>
        </div>
        @endpermission

        <div class="col-12 px-2 py-2">
            <div style="height: 4px ;background: rgb(118 169 169);border-radius: 7px;transition: width .5s ease-in-out;width: 0%;" id="home-dashboard-divider"></div>
        </div>
        <div class="col-12 col-lg-4 p-2">

            <div class="col-12 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        إجرائات سريعة
                    </div>
                    <div class="col-12 " style="min-height: 1px;background: var(--border-color);"></div>
                </div>
                <div class="col-12 p-3 row d-flex">
                    <div class="col-4  d-flex justify-content-center align-items-center mb-3 py-2">
                        <a href="{{route('home')}}" target="_blank" style="color:inherit;">
                            <div class="col-12 p-0 text-center">
                                <img src="/images/icons/house.png" style="width:30px;height: 30px">
                                {{-- <span class="fal fa-home font-5" ></span> --}}
                                <div class="col-12 p-0 text-center">
                                    الموقع
                                </div>
                            </div>
                        </a>
                    </div>
                    @permission('settings-update')
                    <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                        <a href="{{route('admin.settings.index')}}" style="color:inherit;">
                            <div class="col-12 p-0 text-center">
                                <img src="/images/icons/settings.png" style="width:30px;height: 30px">
                                {{-- <span class="fal fa-wrench font-5" ></span> --}}
                                <div class="col-12 p-0 text-center">
                                    الإعدادات
                                </div>
                            </div>
                        </a>
                    </div>
                    @endpermission
                    <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                        <a href="{{route('admin.profile.index')}}" style="color:inherit;">
                            <div class="col-12 p-0 text-center">
                                <img src="/images/icons/man.png" style="width:30px;height: 30px">
                                {{-- <span class="fal fa-user font-5" ></span> --}}
                                <div class="col-12 p-0 text-center">
                                    ملفي
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                        <a href="{{route('admin.profile.index')}}" style="color:inherit;">
                            <div class="col-12 p-0 text-center">
                                <img src="/images/icons/edit.png" style="width:30px;height: 30px">
                                {{-- <span class="fal fa-user-edit font-5" ></span> --}}
                                <div class="col-12 p-0 text-center">
                                    تعديل ملفي
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                        <a href="{{route('admin.notifications.index')}}" style="color:inherit;">
                            <div class="col-12 p-0 text-center">

                                <img src="/images/icons/notification.png" style="width:30px;height: 30px">
                                {{-- <span class="fal fa-bells font-5" ></span> --}}
                                <div class="col-12 p-0 text-center">
                                    الإشعارات
                                </div>
                            </div>
                        </a>
                    </div>
                    @permission('announcements-read')
                    <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                        <a href="{{route('admin.announcements.index')}}" style="color:inherit;">
                            <div class="col-12 p-0 text-center">

                                <img src="/images/icons/annonce.png" style="width:30px;height: 30px">
                                {{-- <span class="fal fa-bullhorn font-5" ></span> --}}
                                <div class="col-12 p-0 text-center">
                                    الإعلانات
                                </div>
                            </div>
                        </a>
                    </div>
                    @endpermission
                    <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                        <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                           style="color:inherit;">
                            <div class="col-12 p-0 text-center">

                                <img src="/images/icons/logout.png" style="width:30px;height: 30px">
                                {{-- <span class="fal fa-sign-out-alt font-5" ></span> --}}
                                <div class="col-12 p-0 text-center">
                                    خروج
                                </div>
                            </div>
                        </a>
                    </div>


                </div>
            </div>
        </div>

        {{--<livewire:dashboard-statistics />--}}

    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('#home-dashboard-divider').css('width', '40%');
    </script>
@endpush
