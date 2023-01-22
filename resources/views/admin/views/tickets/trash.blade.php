@extends('admin.layouts.panel')
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">تیکت ها  /</span> زباله‌دان
    </h4>

    @include('admin.includes.alerts',['class' => 'mb-3'])

    <div class="card">
        <div class="card-header d-flex flex">
            <div class="d-flex align-items-center">
                <form action="{{route('tickets.search.trash')}}">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input type="text" class="form-control" placeholder="جستجو ..." aria-label="Search..." name="query" @if(isset($query)) value="{{$query}}" @endif>
                    </div>
                </form>
                @if(isset($query))
                    <a href="{{route('tickets.trash')}}" class="btn btn-sm btn-secondary ms-3"><i class="bx bx-x"></i></a>
                @endif
            </div>
            <div class="ms-auto text-end primary-font pt-3 pt-md-0">
                <a href="{{route('tickets.index')}}" class="btn btn-primary"><span><i class="bx bx-arrow-from-left me-sm-2"></i> <span class="d-none d-sm-inline-block">بازگشت به تیکت ها</span></span></a>
                <form action="{{route('tickets.trash.empty')}}" method="post" class="d-inline-block">
                    @csrf
                    <span class="btn btn-warning" id="btn-empty-trash"><span><i class="bx bx-trash-alt me-sm-2"></i> <span class="d-none d-sm-inline-block">خالی کردن سطل زبانه</span></span></span>
                </form>
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
                            <form action="{{route('tickets.delete.force')}}" method="post" class="d-inline-block">
                                @csrf
                                <input type="hidden" name="id" value="{{$ticket->id}}">
                                <span class="btn btn-danger btn-sm btn-fore-delete" data-alert-message="این تیکت برای همیشه پاک خواهد شد!">حذف</span>
                            </form>
                            <form action="{{route('tickets.restore',$ticket->id)}}" method="post" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-label-success btn-sm">بازگردانی</button>
                            </form>
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
