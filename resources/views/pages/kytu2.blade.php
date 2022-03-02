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
                <div class="card-header">Danh sách chapter: {{$count}}</div>

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
                            @foreach($chapter as $key => $tr)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $tr->tieude }}</td>
                                <td>{{ $tr->truyen->tentruyen }}</td>
                                <td>{{ $tr->slug_chapter }}</td>
                                <td>{{$tr->created_at}} <br><p>{{$tr->created_at->diffForHumans()}}</p></td>
                                <td>{{$tr->updated_at}} <br><p>{{$tr->updated_at->diffForHumans()}}</p></td>
                                <td>
                                    <a href="{{route('chapter.edit',[$tr->id])}}" class="btn btn-primary">Edit</a><br><br>
                                    <form action="{{route('chapter.destroy',[$tr->id])}}" method="post">
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
