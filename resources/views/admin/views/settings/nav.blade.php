<?php $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();?>

<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link {{$currentRoute == "settings.general" ? 'active' :''}}" href="{{route('settings.general')}}"><i class="bx bx-cog me-1"></i>
            عمومی</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$currentRoute == "settings.gateways" ? 'active' :''}}" href="{{route('settings.gateways')}}"><i class="bx bx-cog me-1"></i>
            درگاه پرداخت</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$currentRoute == "settings.sms" ? 'active' :''}}" href="{{route('settings.sms')}}"><i class="bx bx-cog me-1"></i>
            سامانه پیامکی</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$currentRoute == "settings.about" ? 'active' :''}}" href="{{route('settings.about')}}"><i class="bx bx-text me-1"></i> درباره ما</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$currentRoute == "settings.articles" ? 'active' :''}}" href="{{route('settings.articles')}}"><i class="bx bx-pencil me-1"></i> مقالات</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$currentRoute == "settings.feedbacks" ? 'active' :''}}" href="{{route('settings.feedbacks')}}"><i class="bx bx-chat me-1"></i> نظرات مشتریان</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$currentRoute == "settings.counters" ? 'active' :''}}" href="{{route('settings.counters')}}"><i class="bx bx-repeat me-1"></i> شمارشگر ها</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$currentRoute == "settings.contact_us" ? 'active' :''}}" href="{{route('settings.contact_us')}}"><i class="bx bx-phone-call me-1"></i> لندینگ تماس باما</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{$currentRoute == "settings.about_us" ? 'active' :''}}" href="{{route('settings.about_us')}}"><i class="bx bx-info-circle me-1"></i> لندینگ درباره ما</a>
    </li>
</ul>
