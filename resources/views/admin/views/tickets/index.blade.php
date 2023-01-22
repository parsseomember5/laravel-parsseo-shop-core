@extends('admin.layouts.panel')
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">تیکت ها /</span> لیست
    </h4>

    @include('admin.includes.alerts',['class' => 'mb-3'])

    <div class="card">
        <div class="card-header d-flex flex">
            <div class="d-flex align-items-center">
                <form action="{{route('tickets.search')}}">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input type="text" class="form-control" placeholder="جستجو ..." aria-label="Search..." name="query" @if(isset($query)) value="{{$query}}" @endif>
                    </div>
                </form>
                @if(isset($query))
                    <a href="{{route('tickets.index')}}" class="btn btn-sm btn-secondary ms-3"><i class="bx bx-x"></i></a>
                @endif
            </div>
            <div class="ms-auto text-end primary-font pt-3 pt-md-0">
                <a href="{{route('tickets.trash')}}" class="btn btn-label-secondary"><span><i class="bx bx-trash me-sm-2"></i> <span class="d-none d-sm-inline-block">زباله‌دان</span></span></a>
            </div>
        </div>

        @if($tickets->count() > 0)
            <table class="table table-striped table-hover" style="min-height: 200px">
                <thead>
                <tr>
                    <th>عملیات</th>
                    <th>شماره پیگیری</th>
                    <th>عنوان</th>
                    <th>اهمیت</th>
                    <th>وضعیت</th>
                    <th>پاسخ</th>
                    <th>تاریخ</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($tickets as $ticket)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('tickets.edit',$ticket)}}"><i class="bx bx-edit-alt me-1"></i> ویرایش</a>
                                    <a class="dropdown-item delete-row" href="javascript:void(0);" data-alert-message="بعد از حذف به سطل زباله منتقل میشود."><i class="bx bx-trash me-1"></i>
                                        <form action="{{route('tickets.destroy',$ticket)}}" method="post" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <span>حذف</span>
                                        </form>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>{{$ticket->tracking}}</td>
                        <td style="max-width: 180px;white-space: normal">{{$ticket->title}}</td>
                        <td>
                            @if($ticket->priority == 0)
                                <span class="badge bg-label-warning">کم</span>
                            @elseif($ticket->priority == 1)
                                <span class="badge bg-label-dark">عادی</span>
                            @elseif($ticket->priority == 2)
                                <span class="badge bg-label-danger">بحرانی</span>
                            @endif
                        </td>
                        <td>{{ \App\Models\Ticket::STATUS[$ticket->status] }}</td>

                        <td>{{$ticket->replies_count}}</td>
                        <td>{{verta($ticket->created_at)->format('Y/m/d - (H:i)')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-secondary m-3">هیچ موردی پیدا نشد.</div>
        @endif
        {{$tickets->links()}}
    </div>
@endsection
