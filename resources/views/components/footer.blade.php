@php
    $categories = App\Models\Category::latest()->take(9)->get();
    $months = array(
    "يناير", "فبراير", "مارس", "إبريل", "مايو", "يونيو",
    "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
    );

    $days = array(
    "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت"
    );
@endphp


<footer style="margin-top: 32PX">
    <div class="container">
        <div class="logo_wrapper">
            <a href="/">
                <img src="{{ asset('/assets2/imgs/home-maser-logo.jpg')}}?v={{time()}}" style="width: 130px" alt="logo" class="logo">
            </a>
            <div class="text">
                رئيس مجلس الادارة: نجلاء كمال
                <br>
                رئيس التحرير: محمد أبوزيد
            </div>
        </div>
        <div class="links">
            @foreach ($categories as $item)
                <a href="{{ redirectCategoryRoute($item) }}"><i class="fa-solid fa-caret-left"></i> {{$item->title}}</a>
            @endforeach
        </div>
    </div>
</footer>
