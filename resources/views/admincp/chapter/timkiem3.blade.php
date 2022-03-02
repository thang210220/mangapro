@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($chapter);
                @endphp
                <div class="card-header">
                    Danh sách chapter: {{$count}}
                    <form autocomplete="off" action="{{url('tim-kiem3')}}" class="form-inline my-2 my-lg-0" style="margin-left: 180px" method="GET">
                        @csrf
                        <table>
                            <tr>
                                <td>
                                    <input class="form-control mr-sm-2" type="search" id="keywords3" name="tukhoa3" placeholder="Tìm kiếm" aria-label="Search" style="background: white">
                                    
                                </td>
                                <td>
                                    <button class="btn btn-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                                </td>
                            </tr>
                            <tr>
                                <style>
                                    .dropdown-menu{margin-top: 40px;}
                                    ul.dropdown-menu li{padding: 5px 15px;}
                                    ul.dropdown-menu li a{color: black; text-decoration: none}
                                </style>
                                <div id="search_ajax3"></div>
                            </tr>
                        </table>
                    </form>
                </div>

                <style>
                    .title_truyen2 {margin-left: 10px}
                    .kytu2 {margin-left: 10px}
                    .kytu2 a {color: black; padding: 5px 13px; background: #FFCC66; cursor: pointer; font-weight: bold;}
                    .kytu2 a:hover {color: blue; margin-left: 10px}
                </style>
                <div class="row">
                    <h3 class="title_truyen2">Lọc A - Z</h3>
                    <table class="kytu2">
                        <tr>
                        @foreach(range('A', 'Z') as $char)
                            <th><a href="{{url('/kytu2/'.$char)}}">{{$char}}</a></th>
                        @endforeach
                        </tr>
                    </table>
                </div>

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
                                <th width="300px">Tên Chapter</th>
                                <th width="300px">Thuộc truyện</th>
                                <th width="100px">Slug Chapter</th>
                                <th width="150px">Ngày tạo</th>
                                <th width="200px">Ngày cập nhật</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chapter as $key => $chap)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $chap->tieude }}</td>
                                <td>{{ $chap->truyen->tentruyen }}</td>
                                <td>{{ $chap->slug_chapter }}</td>
                                <td>{{$chap->created_at}} <br><p>{{$chap->created_at->diffForHumans()}}</p></td>
                                <td>{{$chap->updated_at}} <br><p>{{$chap->updated_at->diffForHumans()}}</p></td>
                                <td>
                                    <a href="{{route('chapter.edit',[$chap->id])}}" class="btn btn-primary">Edit</a><br><br>
                                    <form action="{{route('chapter.destroy',[$chap->id])}}" method="post">
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
