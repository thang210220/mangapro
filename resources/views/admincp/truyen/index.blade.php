@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($list_truyen);
                @endphp
                <div class="card-header">Danh sách truyện: {{$count}}</div>

                <style>
                    .title_truyen {margin-left: 10px}
                    .kytu {margin-left: 10px}
                    .kytu a {color: black; padding: 5px 13px; background: #FFCC66; cursor: pointer; font-weight: bold;}
                    .kytu a:hover {color: blue; margin-left: 10px}
                </style>
                <div class="row">
                    <h3 class="title_truyen">Lọc A - Z</h3>
                    <table class="kytu">
                        <tr>
                        @foreach(range('A', 'Z') as $char)
                            <th><a href="{{url('/kytu/'.$char)}}">{{$char}}</a></th>
                        @endforeach
                        </tr>
                    </table>
                </div>

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
                                <th width="30px">#</th>
                                <th width="100px">Tên truyện</th>
                                <th width="80px">Ảnh</th>
                                <th width="100px">Tác giả</th>
                                <th width="100px">Slug truyện</th>
                                <th width="700px">Tóm tắt</th>
                                <th width="50px">Danh mục</th>
                                <th width="50px">Thể loại</th>
                                <th width="150px">Ngày tạo</th>
                                <th width="200px">Ngày cập nhật</th>
                                <th>Trạng thái</th>
                                <th>Kiểu</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list_truyen as $key => $truyen)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $truyen->tentruyen }}</td>
                                <td><img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" height="250" width="180"></td>
                                <td>{{ $truyen->tacgia }}</td>
                                <td>{{ $truyen->slug_truyen }}</td>
                                <td>{{ $truyen->tomtat }}</td>
                                <td>{{ $truyen->danhmuctruyen->tendanhmuc }}</td>
                                <td>{{ $truyen->theloai->tentheloai }}</td>
                                <td>{{$truyen->created_at}} <br><p>{{$truyen->created_at->diffForHumans()}}</p></td>
                                <td>{{$truyen->updated_at}} <br><p>{{$truyen->updated_at->diffForHumans()}}</p></td>
                                <td>
                                    @if($truyen->trangthai==0)
                                        <span class="text text-success">Hoàn thành</span>
                                    @else
                                        <span class="text text-primary">Đang tiến hành</span>
                                    @endif
                                </td>
                                <td>
                                    @if($truyen->truyen_noibat == 0)
                                        <form>
                                            @csrf
                                            <select name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="custom-select truyennoibat">
                                                <option selected value="0">Truyện hay</option>
                                                <option value="1">Truyện nổi bật</option>
                                                <option value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @elseif($truyen->truyen_noibat == 1)
                                        <form>
                                            @csrf
                                            <select name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="custom-select truyennoibat">
                                                <option value="0">Truyện hay</option>
                                                <option selected value="1">Truyện nổi bật</option>
                                                <option value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @else($truyen->truyen_noibat == 2)
                                        <form>
                                            @csrf
                                            <select name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="custom-select truyennoibat">
                                                <option value="0">Truyện hay</option>
                                                <option value="1">Truyện nổi bật</option>
                                                <option selected value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('truyen.edit',[$truyen->id])}}" class="btn btn-primary">Edit</a><br><br>
                                    <form action="{{route('truyen.destroy',[$truyen->id])}}" method="post">
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
