@extends('admin.layouts.panel')
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">دسته بندی مقالات /</span> دسته جدید
    </h4>

    @include('admin.includes.alerts',['class' => 'mb-3'])
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('product-categories.store')}}" method="post" enctype="multipart/form-data" class="row">
                @csrf
                <div class="mb-3 col-lg-4">
                    <label class="form-label" for="title">عنوان (ضروری)</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                </div>

                <div class="mb-3 col-lg-4">
                    <label class="form-label" for="slug">نامک</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}">
                </div>

                <div class="mb-3 col-lg-4">
                    <label for="image" class="form-label">تصویر دسته</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>

                {{-- description --}}
                <div class="mb-3">
                    <input type="hidden" name="description" id="description" value="{{old('description')}}">
                    <label for="body" class="form-label">توضیحات</label>
                    <div id="main-editor" data-input-id="description">{!! old('description') !!}</div>
                </div>

                {{-- meta description --}}
                <div class="mb-3">
                    <label class="form-label" for="meta_description">متای توضیحات</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{old('meta_description')}}</textarea>
                </div>

                {{-- canonical --}}
                <div class="mb-3">
                    <label class="form-label" for="canonical">تگ canonical</label>
                    <input type="text" class="form-control" dir="ltr" id="canonical" name="canonical" value="{{old('canonical')}}">
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="featured" name="featured" {{old('featured') == 'on' ? 'checked' :''}}>
                        <label class="form-check-label" for="featured">دسته ویژه</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary">ارسال</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('styles')
@endsection
@section('scripts')
@endsection
