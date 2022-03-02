@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @php
                    $count = count($theloai);
                @endphp
                <div class="card-header">Danh sách thể loại: {{$count}}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên thể loại</th>
                                <th scope="col">Slug thể loại</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($theloai as $key => $value)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $value->tentheloai }}</td>
                                <td>{{ $value->slug_theloai }}</td>
                                <td>
                                    <a href="{{route('theloai.edit',[$value->id])}}" class="btn btn-primary">Edit</a><br><br>
                                    <form action="{{route('theloai.destroy',[$value->id])}}" method="post">
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
