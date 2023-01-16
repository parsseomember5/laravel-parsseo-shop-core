@extends('front.layouts.master',['headerClass' => '', 'h1Title' => $category->title,
'description' => $category->meta_description, 'canonical' => $category->canonical , 'title' => $category->title])
@section('content')
    <!--====== Page Title Start ======-->
    <section class="page-title-area">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-8">
                    <h2 class="page-title">{{$category->title}}</h2>
                </div>
                <div class="col-auto">
                    <ul class="page-breadcrumb">
                        <li><a href="{{route('home')}}">{{config('app.app_name_fa')}}</a></li>
                        <li><a href="{{route('posts')}}">بلاگ</a></li>
                        <li><a href="{{route('post_category.show',$category)}}">{{$category->title}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--====== Page Title End ======-->

    <!--====== Event area Start ======-->
    <section class="event-area section-gap-extra-bottom">
        <div class="container">
            <div class="event-items">
                @foreach($posts as $article)
                    @include('front.items.article_horizontal_lg',$article)
                @endforeach
                <div class="col-12">
                    {{$posts->links('front.includes.paginator')}}
                </div>
            </div>
        </div>
    </section>
    <!--====== Event area End ======-->
@endsection
