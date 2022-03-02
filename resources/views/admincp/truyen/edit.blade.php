@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật truyện</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="post" action="{{ route('truyen.update',[$truyen->id])}}" enctype='multipart/form-data'>
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên truyện</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{$truyen->tentruyen}}" onkeyup="ChangeToSlug();" name="tentruyen" id="slug" aria-describedby="emailHelp" placeholder="Tên truyện ...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tác giả</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{$truyen->tacgia}}" name="tacgia" aria-describedby="emailHelp" placeholder="Tác giả ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Slug truyện</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{$truyen->slug_truyen}}" name="slug_truyen" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug truyện ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Tóm tắt truyện</label>
                            <textarea style="margin-top:10px; resize: none;" name="tomtat" class="form-control" rows="5">{{$truyen->tomtat}}</textarea>
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Danh mục truyện</label><br>
                            <select style="margin-top:10px; width:100%" name="danhmuc" class="custom-select">
                                @foreach($danhmuc as $key => $muc)
                                <option {{ $muc->id==$truyen->danhmuc_id ? 'selected' : '' }} value="{{$muc->id}}">{{$muc->tendanhmuc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Thể loại truyện</label><br>
                            <select style="margin-top:10px; width:100%" name="theloai" class="custom-select">
                                @foreach($theloai as $key => $the)
                                <option {{ $the->id==$truyen->theloai_id ? 'selected' : '' }} value="{{$the->id}}">{{$the->tentheloai}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Ảnh</label><br>
                            <input style="margin-top:10px" type="file" class="form-control-file" name="hinhanh">
                            <img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" height="250" width="180">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Trạng thái</label><br>
                            <select style="margin-top:10px; width:100%" name="trangthai" class="custom-select">
                                @if($truyen->trangthai==0)
                                <option selected value="0">Hoàn thành</option>
                                <option value="1">Đang tiến hành</option>
                                @else
                                <option value="0">Hoàn thành</option>
                                <option selected value="1">Đang tiến hành</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Kiểu</label><br>
                            <select style="margin-top:10px; width:100%" name="truyennoibat" class="custom-select">
                                @if($truyen->truyen_noibat == 0)
                                <option selected value="0">Truyện hay</option>
                                <option value="1">Truyện nổi bật</option>
                                <option value="2">Truyện xem nhiều</option>
                                @elseif($truyen->truyen_noibat == 1)
                                <option value="0">Truyện hay</option>
                                <option selected value="1">Truyện nổi bật</option>
                                <option value="2">Truyện xem nhiều</option>
                                @else
                                <option value="0">Truyện hay</option>
                                <option value="1">Truyện nổi bật</option>
                                <option selected value="2">Truyện xem nhiều</option>
                                @endif
                            </select>
                        </div>

                        <button style="margin-top:10px" type="submit" name="themtruyen" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
