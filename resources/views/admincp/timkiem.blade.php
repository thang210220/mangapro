@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($truyen);
                @endphp
                <div class="card-header">Danh sách truyện: {{$count}}</div>

                <div id="thongbao"></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên truyện</th>
                                <th>Ảnh</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($truyen as $key => $tr)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $tr->tentruyen }}</td>
                                <td><img src="{{asset('public/uploads/truyen/'.$tr->hinhanh)}}" height="250" width="180"></td>
                                <td>{{$tr->created_at}} <br><p>{{$tr->created_at->diffForHumans()}}</p></td>
                                <td>{{$tr->updated_at}} <br><p>{{$tr->updated_at->diffForHumans()}}</p></td>
                                <td>
                                    <a href="{{route('truyen.edit',[$tr->id])}}" class="btn btn-primary">Edit</a><br><br>
                                    <form action="{{route('truyen.destroy',[$tr->id])}}" method="post">
                                        @method ('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
