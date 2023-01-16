@extends('admin.layouts.panel')
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">نظرات مشتریان /</span> لیست
    </h4>

    @include('admin.includes.alerts',['class' => 'mb-3'])

    <div class="card">
        <div class="card-header d-flex flex">
            <div class="d-flex align-items-center">
                <form action="{{route('feedbacks.search')}}">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input type="text" class="form-control" placeholder="جستجو ..." aria-label="Search..." name="query" @if(isset($query)) value="{{$query}}" @endif>
                    </div>
                </form>
                @if(isset($query))
                    <a href="{{route('feedbacks.index')}}" class="btn btn-sm btn-secondary ms-3"><i class="bx bx-x"></i></a>
                @endif
            </div>
            <div class="ms-auto text-end primary-font pt-3 pt-md-0">
                <a href="{{route('feedbacks.create')}}" class="dt-button create-new btn btn-primary"><span><i class="bx bx-plus me-sm-2"></i> <span class="d-none d-sm-inline-block">افزودن رکورد جدید</span></span></a>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            @if($feedbacks->count() > 0)
                <table class="table table-striped table-hover" style="min-height: 200px">
                    <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>نام</th>
                        <th>عنوان</th>
                        <th>متن</th>
                        <th>تعداد ستاره</th>
                        <th>زبان</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($feedbacks as $feedback)
                        <tr>
                            <td>
                                <a href="{{$feedback->getImage()}}" target="_blank">
                                    <img src="{{$feedback->getImage()}}" alt="image" class="rounded" style="width: 80px;">
                                </a>
                            </td>
                            <td>{{$feedback->name}}</td>
                            <td>{{$feedback->title}}</td>
                            <td style="max-width: 200px;white-space: normal">{{$feedback->text}}</td>

                            <td>{{$feedback->stars}}</td>
                            <td>{{$feedback->locale}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('feedbacks.edit',$feedback)}}"><i class="bx bx-edit-alt me-1"></i> ویرایش</a>
                                        <a class="dropdown-item delete-row" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                            <form action="{{route('feedbacks.destroy',$feedback)}}" method="post" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <span>حذف</span>
                                            </form>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-secondary m-3">هیچ موردی پیدا نشد.</div>
            @endif
            {{$feedbacks->links()}}
        </div>
    </div>
@endsection

@section('styles')
@endsection
@section('scripts')
@endsection
