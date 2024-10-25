  @if ($settings->facebook_link != null)
      <a href="{{ $settings->facebook_link }}" target="_blank"> <img
              src="{{ asset('/assets/front/images/icons/facebook.png') }}" alt=""></a>
  @endif
  @if ($settings->instagram_link != null)
      <a href="{{ $settings->instagram_link }}" target="_blank"><img
              src="{{ asset('/assets/front/images/icons/insta.png') }}" alt=""></a>
  @endif
  @if ($settings->twitter_link != null)
      <a href="{{ $settings->twitter_link }}" target="_blank"> <img
              src="{{ asset('/assets/front/images/icons/twitter.png') }}" alt=""></a>
  @endif
  @if ($settings->youtube_link != null)
      <a href="{{ $settings->youtube_link }}" target="_blank"> <img
              src="{{ asset('/assets/front/images/icons/youtube.png') }}" alt=""></a>
  @endif
