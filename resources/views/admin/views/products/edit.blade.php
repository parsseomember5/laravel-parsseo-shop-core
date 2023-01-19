@extends('admin.layouts.panel')
@section('content')
    <div class="d-flex align-items-center justify-content-between py-3 mb-4">
        <h4 class="m-0 breadcrumb-wrapper">
            <span class="text-muted fw-light">محصولات /</span> ویرایش
        </h4>
        <div>
            <a href="{{route('products.show',$product)}}" class="btn btn-label-secondary" target="_blank"><span><i class="bx bx-show me-sm-2"></i> <span class="d-none d-sm-inline-block">مشاهده</span></span></a>
            <a href="{{route('products.create')}}" class="btn btn-primary"><span><i class="bx bx-plus me-sm-2"></i> <span class="d-none d-sm-inline-block">افزودن محصول جدید</span></span></a>
        </div>
    </div>

    @include('admin.includes.alerts',['class' => 'mb-3'])
    <form action="{{route('products.update',$product)}}" method="post" enctype="multipart/form-data" class="row">
        @csrf
        @method('PATCH')
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">

                        {{-- title --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="title">عنوان (ضروری)</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{old('title', $product->title)}}">
                        </div>

                        {{-- slug --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="slug">نامک</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug', $product->slug)}}">
                        </div>

                        {{-- Spotplayer Course Id --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="spotplayer_course_id">آی‌دی دوره در اسپات‌پلیر (اختیاری)</label>
                            <input type="text" class="form-control" id="spotplayer_course_id" name="spotplayer_course_id" value="{{old('spotplayer_course_id', $product->spotplayer_course_id)}}">
                        </div>

                        {{-- H1 --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="h1">عنوان H1</label>
                            <input type="text" class="form-control" id="h1" name="h1" value="{{old('h1', $product->h1)}}">
                        </div>

                        {{-- H2 --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="h2">عنوان H2</label>
                            <input type="text" class="form-control" id="h2" name="h2" value="{{old('h2', $product->h2)}}">
                        </div>

                        {{-- H3 --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="h3">عنوان H3</label>
                            <input type="text" class="form-control" id="h3" name="h3" value="{{old('h3', $product->h3)}}">
                        </div>

                        {{-- Teacher --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="admin_id">صاحب اثر (مدرس)</label>
                            <select class="form-select select2 select2-show-search" id="admin_id" name="admin_id" data-allow-clear="true" required>
                                <option value="">انتخاب نمائید</option>
                                @foreach(\App\Models\Admin::all() as $item)
                                    <option value="{{ $item->id }}" {{ $product->admin_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->email . ' - ' . $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Time --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="time">مدت زمان</label>
                            <input type="text" class="form-control" id="time" name="time" value="{{old('time', $product->time)}}">
                        </div>

                        {{-- Price --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="price">قیمت (تومان)</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{old('price', $product->price)}}">
                        </div>

                        {{-- offPrice --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="offPrice">قیمت تخفیف</label>
                            <input type="number" class="form-control" id="offPrice" name="offPrice" value="{{old('offPrice', $product->offPrice)}}">
                        </div>

                        {{-- Child --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="child">محصولات فرزند (در صورت تبدیل به پکیج جامع)</label>
                            <select class="form-select select2 select2-show-search" id="child" multiple name="child[]" data-allow-clear="true">
                                @foreach(\App\Models\Product::all() as $item)
                                    @if(!is_null($product->child))
                                        <option value="{{ $item->id }}" {{ in_array($item->id , $product->child) ? 'selected' : '' }}>
                                            {{ $item->fa_title }}
                                        </option>
                                    @else
                                        <option value="{{ $item->id }}">
                                            {{ $item->fa_title }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        {{-- Tags --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="tags">تگ ها</label>
                            <select class="form-select select2 select2-show-search" id="tags" multiple name="tags[]" data-allow-clear="true">
                                @foreach(\Spatie\Tags\Tag::all() as $item)
                                    <option value="{{ $item->id }}" {{ in_array($item->id,$product->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- offPrice --}}
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="video">آدرس ویدئو</label>
                            <input type="text" class="form-control" id="video" name="video" value="{{old('video', $product->video)}}">
                        </div>

                        {{-- excerpt --}}
                        <div class="mb-3 col-12">
                            <label class="form-label" for="excerpt">خلاصه</label>
                            <textarea class="form-control" id="excerpt" name="excerpt" rows="2">{{old('excerpt', $product->excerpt)}}</textarea>
                        </div>

                        {{-- Script --}}
                        <div class="mb-3 col-12">
                            <label class="form-label" for="script">جاواسکریپت اضافی</label>
                            <textarea class="form-control" id="script" name="script" rows="2">{{old('script', $product->script)}}</textarea>
                        </div>

                        {{-- image --}}
                        <div class="mb-3 col-lg-6">
                            <label for="image" class="form-label">تصویر اصلی محصول</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        @if($product->image)
                            <div class="col-lg-3 mb-3">
                                <input type="hidden" id="remove_image" name="remove_image">
                                <div class="pt-4">
                                    <a href="{{$product->getImage()}}" target="_blank">
                                        <img src="{{$product->getImage('thumb')}}" alt="image" class="w-px-40 h-auto rounded" id="post-image">
                                    </a>
                                    <span class="btn btn-sm btn-danger remove-image-file" data-url="{{$product->image['original']}}"
                                          input-id="remove_image" image-id="post-image"><i class="bx bx-trash"></i></span>
                                </div>
                            </div>
                        @endif

                        {{-- cover --}}
                        <div class="mb-3 col-lg-6">
                            <label for="cover" class="form-label">کاور ویدئو معرفی</label>
                            <input class="form-control" type="file" id="cover" name="cover" accept="image/*">
                        </div>
                        @if($product->cover)
                            <div class="col-lg-3 mb-3">
                                <input type="hidden" id="remove_image" name="remove_image">
                                <div class="pt-4">
                                    <a href="{{$product->getCover()}}" target="_blank">
                                        <img src="{{$product->getCover()}}" alt="image" class="w-px-40 h-auto rounded" id="post-image">
                                    </a>
                                    <span class="btn btn-sm btn-danger remove-image-file" data-url="{{$product->getCover()}}"
                                          input-id="remove_image" image-id="post-image"><i class="bx bx-trash"></i></span>
                                </div>
                            </div>
                        @endif

                        {{-- headlines_pdf --}}
                        <div class="mb-3 col-lg-6">
                            <label for="headlines_pdf" class="form-label">فایل سرفصل ها</label>
                            <input class="form-control" type="file" id="headlines_pdf" name="headlines_pdf" accept="">
                        </div>
                        @if($product->headlines_pdf)
                            <div class="col-lg-3 mb-3">
                                <input type="hidden" id="remove_image" name="remove_image">
                                <div class="pt-4">
                                    <a href="{{$product->getHeadlinesPDF()}}" target="_blank">
                                        <img src="{{$product->getHeadlinesPDF()}}" alt="image" class="w-px-40 h-auto rounded" id="post-image">
                                    </a>
                                    <span class="btn btn-sm btn-danger remove-image-file" data-url="{{$product->getHeadlinesPDF()}}"
                                          input-id="remove_image" image-id="post-image"><i class="bx bx-trash"></i></span>
                                </div>
                            </div>
                        @endif


                        {{-- body --}}
                        <div class="mb-3">
                            <input type="hidden" name="body" id="body" value="{{old('body', $product->body)}}">
                            <label for="body" class="form-label">محتوای محصول</label>
                            <div id="main-editor" data-input-id="body">{!! $product->body !!}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        {{-- Kind --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="kind">نوع محصول</label>
                            <select class="form-select" id="kind" name="kind" data-allow-clear="true">
                                @foreach(\App\Models\Product::KIND as $key => $item)
                                    <option value="{{ $key }}" {{ $key==$product->kind ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Type --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="type">نوع فروش</label>
                            <select class="form-select" id="type" name="type" data-allow-clear="true">
                                @foreach(\App\Models\Product::TYPE as $key => $item)
                                    <option value="{{ $key }}" {{ $key==$product->type ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        {{-- State --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="state">وضعیت برگزاری</label>
                            <select class="form-select" id="state" name="state" data-allow-clear="true">
                                @foreach(\App\Models\Product::STATE as $key => $item)
                                    <option value="{{ $key }}" {{ $key==$product->state ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Support --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="support">تعداد روز پشتبانی</label>
                            <input type="number" class="form-control" dir="ltr" id="support" name="support" value="{{old('support', $product->support)}}">
                        </div>
                    </div>


                    {{-- modal
                    <div class="mb-3">
                        <label class="form-label" for="modal_id">انتخاب مدال (اختیاری)</label>
                        <select class="select2 form-select" id="modal_id" name="modal_id" data-allow-clear="true">
                            @foreach(\App\Models\Modal::all() as $modal)
                                <option value="{{$modal->id}}" {{ $product->modal_id==$modal->id ? 'selected' : '' }}>{{$modal->title}}</option>
                            @endforeach
                        </select>
                    </div>--}}

                    {{-- Recommendeds --}}
                    <div class="mb-3">
                        <label class="form-label" for="recommendeds">محصولات پیشنهادی</label>
                        <select class="select2 form-select" id="recommendeds" multiple name="recommendeds[]" data-allow-clear="true">
                            @if(old('recommendeds'))
                                @foreach($otherProducts as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        {!! in_array($item->id, old('recommendeds')) ? 'selected' : '' !!}>
                                        {{ $item->fa_title }}
                                    </option>
                                @endforeach
                            @elseif($product->recommendeds()->count())
                                @foreach($otherProducts as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        {!! in_array($item->id, $product->recommendeds()->pluck('recommended_id')->toArray()) ? 'selected' : '' !!}>
                                        {{ $item->fa_title }}
                                    </option>
                                @endforeach
                            @else
                                @foreach($otherProducts as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->fa_title }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="row">
                        {{-- locale --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="locale">زبان مقاله</label>
                            <select class="form-select" id="locale" name="locale" data-allow-clear="true">
                                <option value="fa" {{ $product->locale == 'fa' ? 'selected' : '' }}>فارسی (FA)</option>
                                <option value="en" {{ $product->locale == 'en' ? 'selected' : '' }}>انگلیسی (EN)</option>
                            </select>
                        </div>
                        {{-- translation --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="translation_id">انتخاب ترجمه</label>
                            <select class="select2 form-select" id="translation_id" name="translation_id" data-allow-clear="true">
                                <option value="" selected>انتخاب نشده</option>
                                @foreach(\App\Models\Product::where('locale','!=',$product->locale)->latest()->get() as $translation)
                                    <option value="{{$translation->id}}" {{$product->translation_id == $translation->id ? 'selected' : ''}}>{{$translation->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- meta description --}}
                    <div class="mb-3">
                        <label class="form-label" for="meta_description">متای توضیحات</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{old('meta_description',$product->meta_description)}}</textarea>
                    </div>

                    {{-- canonical --}}
                    <div class="mb-3">
                        <label class="form-label" for="canonical">تگ canonical</label>
                        <input type="text" class="form-control" dir="ltr" id="canonical" name="canonical" value="{{old('canonical',$product->canonical)}}">
                    </div>

                    {{-- author --}}
                    <div class="mb-3">
                        <label class="form-label" for="author_id">نویسنده</label>
                        <select class="select2 form-select" id="author_id" name="author_id" data-allow-clear="true">
                            @foreach(\App\Models\Admin::all() as $admin)
                                <option value="{{$admin->id}}" {{ $product->author_id == $admin->id ? 'selected' : '' }}>{{$admin->name . ' (' .$admin->email. ')'}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row align-items-end">
                        {{-- order --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="order">اولویت نمایش</label>
                                <input type="number" class="form-control" dir="ltr" id="order" name="order" value="{{old('order',$product->order)}}">
                            </div>
                        </div>

                        {{-- sitemap_priority --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="sitemap_priority">اولویت در sitemap</label>
                                <input type="number" step="0.1" min="0.5" max="1" class="form-control" dir="ltr" id="sitemap_priority"
                                       name="sitemap_priority" value="{{old('sitemap_priority', $product->sitemap_priority)}}">
                            </div>
                        </div>

                        {{-- status --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="status">وضعیت</label>
                                <select class="select2 form-select" id="status" name="status">
                                    <option value="published" {{ $product->status == 'published' ? 'selected' : '' }}>منتشر شده</option>
                                    <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>پیش نویس</option>
                                    <option value="pending" {{ $product->status == 'pending' ? 'selected' : '' }}>در انتظار تایید</option>
                                </select>
                            </div>
                        </div>

                        {{-- Level --}}
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="level">سطح</label>
                            <select class="form-select" id="level" name="level" data-allow-clear="true" required>
                                <option value="">انتخاب نمائید</option>
                                @foreach(\App\Models\Product::getLevels() as $levelKey => $levelValue)
                                    <option value="{!!$levelKey!!}" {{ $product->level==$levelKey ? 'selected' : '' }}>{!!$levelValue!!}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- isSpecial --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="isSpecial" name="isSpecial" {{$product->isSpecial ? 'checked' :''}}>
                                    <label class="form-check-label" for="isSpecial">ویژه</label>
                                </div>
                            </div>
                        </div>

                        {{-- isNew --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="isNew" name="isNew" {{$product->isNew ? 'checked' :''}}>
                                    <label class="form-check-label" for="isNew">جدید</label>
                                </div>
                            </div>
                        </div>

                        {{-- is_coming_soon --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="is_coming_soon" name="is_coming_soon" {{$product->is_coming_soon ? 'checked' :''}}>
                                    <label class="form-check-label" for="is_coming_soon">به‌زودی</label>
                                </div>
                            </div>
                        </div>

                        {{-- isBest --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="isBest" name="isBest" {{$product->isBest ? 'checked' :''}}>
                                    <label class="form-check-label" for="isBest">نمایش در سایدبار</label>
                                </div>
                            </div>
                        </div>

                        {{-- is_coming_soon --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="isFooter" name="isFooter" {{$product->isFooter ? 'checked' :''}}>
                                    <label class="form-check-label" for="isFooter">پر فروش</label>
                                </div>
                            </div>
                        </div>

                        {{-- is_coming_soon --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="isCopyright" name="isCopyright" {{$product->isCopyright ? 'checked' :''}}>
                                    <label class="form-check-label" for="isCopyright">کپی رایت</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mt-4">
                        <button type="submit" class="btn btn-success submit-button">ذخیره تغییرات</button>


                        <button type="button" class="btn btn-label-danger" id="edit-page-delete"
                                data-alert-message="بعد از حذف به زباله‌دان منتقل میشود."
                                data-model-id="{{$product->id}}" data-model="products">
                            حذف این محصول
                        </button>
                    </div>
                </div>
            </div>

            <div class="card">
                <h5 class="card-header">سوالات متداول</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="faq_title" class="form-label">عنوان سوالات متداول</label>
                            <input class="form-control" type="text" id="faq_title" name="faq_title"
                                   value="{{old('faq_title',$product->faq_title)}}">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="faq_title" class="form-label">سوالات متداول</label>
                            <div id="faq-items">
                                @if($product->faq)
                                    @foreach($product->faq as $item)
                                        <?php $itemName = \Illuminate\Support\Str::random(6);?>
                                        <div class='row align-items-end' id='faq_row_{{$itemName}}'>
                                            <div class='mb-3 col-12'>
                                                <label for="item_faq_{{$itemName}}" class="form-label">عنوان</label>
                                                <input class="form-control text-start" type="text" id="item_faq_{{$itemName}}" name="item_faq_{{$itemName}}[]"
                                                       value="{{old('item_faq_' . $itemName,$item[0])}}">
                                            </div>

                                            <div class='mb-3 col-12'>
                                                <label for="item_faq_{{$itemName}}" class="form-label">متن</label>
                                                <textarea class="form-control text-start" type="text" id="item_faq_{{$itemName}}" name="item_faq_{{$itemName}}[]">{{old('item_faq_' . $itemName,$item[1])}}</textarea>
                                            </div>

                                            <div class='mb-3 col-lg-2'>
                                                <span class='btn btn-label-danger btn-remove-faq' data-delete='faq_row_{{$itemName}}'><i class='bx bx-trash'></i></span>
                                            </div>

                                            <div class='col-12'><hr></div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <span class="btn btn-primary add-more-faq"><i class="bx bx-plus"></i> افزودن آیتم</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('styles')
@endsection
@section('scripts')
    <script>
        let localeSelect = $('#locale');
        let translationSelect = $('#translation_id');

        localeSelect.change(function () {
            getTranslations($(this).val());
        });
        function getTranslations(locale){
            let data = new FormData();
            data.append('locale',locale);

            $.ajax({
                method: 'POST',
                url: '/admin/products/get-translations',
                data: data,
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': _token},
                error:function () {
                }
            }).done(function (data) {
                console.log(data);
                translationSelect.empty();
                translationSelect.append($('<option>', {
                    value: '',
                    text: 'انتخاب نشده'
                }));
                $(data).each(function (index,item) {
                    translationSelect.append($('<option>', {
                        value: item['id'],
                        text: item['title']
                    }));
                });

            }).always(function () {
            });
        }
    </script>
@endsection
