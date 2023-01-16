@extends('admin.layouts.panel')
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">مقالات /</span> لیست
    </h4>

    @include('admin.includes.alerts',['class' => 'mb-3'])

    <div class="card">
        <div class="card-header d-flex flex">
            <div class="d-flex align-items-center">
                <form action="{{route('posts.search')}}">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input type="text" class="form-control" placeholder="جستجو ..." aria-label="Search..." name="query" @if(isset($query)) value="{{$query}}" @endif>
                    </div>
                </form>
                @if(isset($query))
                    <a href="{{route('posts.index')}}" class="btn btn-sm btn-secondary ms-3"><i class="bx bx-x"></i></a>
                @endif
            </div>
            <div class="ms-auto text-end primary-font pt-3 pt-md-0">
                <a href="{{route('posts.trash')}}" class="btn btn-label-secondary"><span><i class="bx bx-trash me-sm-2"></i> <span class="d-none d-sm-inline-block">زباله‌دان</span></span></a>
                <a href="{{route('posts.create')}}" class="btn btn-primary"><span><i class="bx bx-plus me-sm-2"></i> <span class="d-none d-sm-inline-block">افزودن رکورد جدید</span></span></a>
            </div>
        </div>

        @if($posts->count() > 0)
            <table class="table table-striped table-hover" style="min-height: 200px">
                <thead>
                <tr>
                    <th>عملیات</th>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>نامک</th>
                    <th>اولویت نمایش</th>
                    <th>وضعیت</th>
                    <th>نویسنده</th>
                    <th>دسته بندی</th>
                    <th>زبان</th>
                    <th>تعداد بازدید</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($posts as $post)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('post.show',$post)}}"><i class="bx bx-show me-1"></i> مشاهده</a>
                                    <a class="dropdown-item" href="{{route('posts.edit',$post)}}"><i class="bx bx-edit-alt me-1"></i> ویرایش</a>
                                    <a class="dropdown-item delete-row" href="javascript:void(0);" data-alert-message="بعد از حذف به سطل زباله منتقل میشود."><i class="bx bx-trash me-1"></i>
                                        <form action="{{route('posts.destroy',$post)}}" method="post" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <span>حذف</span>
                                        </form>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{$post->getImage()}}" target="_blank">
                                <img src="{{$post->getImage('thumb')}}" alt="image" class="rounded" style="width: 80px;">
                            </a>
                        </td>
                        <td style="max-width: 180px;white-space: normal">{{$post->title}}</td>
                        <td style="max-width: 180px;white-space: normal">{{$post->slug}}</td>
                        <td>{{$post->order}}</td>
                        <td>
                            @switch($post->status)
                                @case('published')
                                    <span class="badge bg-label-success">منتشر شده</span>
                                    @break
                                @case('pending')
                                    <span class="badge bg-label-warning">در انتظار تایید</span>
                                    @break
                                @case('draft')
                                    <span class="badge bg-label-secondary">پیش نویس</span>
                                    @break
                            @endswitch
                        </td>
                        <td>{{$post->author->name}}</td>
                        <td style="max-width: 150px;white-space: normal">
                            @if($post->categories->count() > 0)
                                @foreach($post->categories as $cat)
                                    <a class="badge bg-label-primary" href="{{route('post_category.show',$cat)}}">{{$cat->title}}</a>
                                @endforeach
                            @endif
                        </td>
                        <td>{{$post->locale}}</td>
                        <td>{{views($post)->count()}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-secondary m-3">هیچ موردی پیدا نشد.</div>
        @endif
        {{$posts->links()}}
    </div>
@endsection

@section('styles')
@endsection
@section('scripts')
@endsection
