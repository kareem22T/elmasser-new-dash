@php
    $prices = App\Models\Price::get();
    $survey = App\Models\Survey::where('is_default', 1)->first();
@endphp
<div class="Poll-card">
    @if($survey)
        <div class="BlackHeaderBlock">
            <h2>استطلاع راى</h2>
            <span style="background: #c22127"></span>
            <i class="fa-solid fa-align-left"></i>
        </div>
        <div class="ask">
            <h2>{{$survey->title}}</h2>
        </div>
        <form action="" method="get" class="poll-form">
            <div class="answer">
                <div class="form-check-poll">
                    <input class="" type="radio" name="poll" id="radioYES" value="نعم">
                    <label class="" for="radioYES">نعم</label>
                </div>
                <div class="form-check-poll">
                    <input class="" type="radio" name="poll" id="radioNO" value="لا">
                    <label class="" for="radioNO">
                        لا
                    </label>
                </div>
            </div>
            <div class="buttonsPoll">
                <button type="submit" class="poll-button">
                    <i class="fa-solid fa-square-poll-vertical"></i>
                    <span>تصويت</span>
                </button>
                <button class="vote-button">
                    <i class="fa-solid fa-align-left"></i>
                    <span>النتائج</span>
                </button>
            </div>
        </form>
        <div class="poll-vote-all  not-active">
            <div class="poll-vote">
                <h5>نعم</h5>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="90" style="width: 90%" aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
            </div>
            <div class="poll-vote">
                <h5>لا</h5>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="25" style="width: 25%" aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    @endif

    @if ($prices->count())
        <div class="BlackHeaderBlock">
            <h2> اسعار اليوم</h2>
            <span style="background: #c22127"></span>
            <i class="fa-solid fa-money-bill-trend-up"></i>
        </div>
        @foreach ($prices as $price)
            <div class="moneyDay">
                <span>
                    {{ $price->title }}
                </span>
                <i class="fa-solid {{ $price->icon }}"></i>
                <span>
                    {{ $price->description }}
                </span>
            </div>
        @endforeach
    @endif

    <img class="poster" src="{{ asset('/assets/front/images/slider-img.jpg') }}" alt="">
</div>
