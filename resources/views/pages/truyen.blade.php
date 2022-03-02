@extends('../layout')

@section('content')

<div class="container">
<div class="row" style="background: white;">
    <nav aria-label="breadcrumb">
        <style>
            .breadcrumb a{text-decoration: none; color: blue;}
        </style>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{url('danh-muc/'.$truyen->danhmuctruyen->slug_danhmuc)}}">{{$truyen->danhmuctruyen->tendanhmuc}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$truyen->tentruyen}}</li>
        </ol>
    </nav>
    <div class="col-md-9">
        <center><h2><b>{{$truyen->tentruyen}}</b></h2></center><br>
        <div class="row">
            <div class="col-3">
                <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}">
            </div>
            <div class="col-md-9">
                <style type="text/css">
                    .infotruyen{list-style: none;}
                    .infotruyen a{text-decoration: none;}
                    .infotruyen a:hover{color: purple;}
                </style>
                @php
                    $mucluc = count($chapter);
                @endphp
                <ul class="infotruyen">
                    <h5><i class="fa fa-plus"></i> Tên truyện: {{$truyen->tentruyen}}</h5><br>
                    <h5><i class="fa fa-user"></i> Tác giả: {{$truyen->tacgia}}</h5><br>
                    <h5>
                        <i class="fa fa-rss"></i> Trạng thái: 
                        @if($truyen->trangthai==0)
                            <span class="text text-primary">Hoàn thành</span>
                        @else
                            <span class="text text-primary">Đang tiến hành</span>
                        @endif
                    </h5><br>
                    <h5><i class="fa fa-tags"></i> Thể loại: <a href="{{url('the-loai/'.$truyen->theloai->slug_theloai)}}"><b>{{$truyen->theloai->tentheloai}}</b></a></h5><br>
                    <h5><i class="fas fa-flag"></i> Số chapter: {{$mucluc}}</h5><br>
                    <h5><i class="fas fa-eye"></i> Lượt xem: Chưa làm</h5><br>
                    @if ($chapter_dau)
                    <a href="{{url('xem-chapter/'.$chapter_dau->slug_chapter)}}" class="btn btn-primary"><i class="fas fa-book-open"></i>  Đọc ngay</a>
                    <a href="{{url('xem-chapter/'.$chapter_moinhat->slug_chapter)}}" class="btn btn-primary"><i class="fas fa-book-open"></i>  Chương mới nhất</a>
                    @else
                    <a class="btn btn-danger">Đang cập nhật</a>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <br><b style="color: blue"><i class="far fa-file-alt"></i>  NỘI DUNG</b><hr>
            <p>{{$truyen->tomtat}}</p>
        </div>
        <div class="col-md-12">
            <b style="color: blue"><i class="fas fa-list"></i>  DANH SÁCH CHAP</b><hr>
            <style>
                .mucluctruyen li{list-style: none;}
                .mucluctruyen a{text-decoration: none; color: black}
                .mucluctruyen a:hover{color: blue;}
                ul.mucluctruyen li{padding: 5px 15px;}
                ul.mucluctruyen li:hover{background: #FFCC66;}
                .timeupdate li{list-style: none;}
                ul.timeupdate li{padding: 5px 15px;}
                .my-custom-scrollbar {position: relative; width: 950px; height: 400px; overflow: auto;}
            </style>
            @if($mucluc>0)
            <div class="my-custom-scrollbar my-custom-scrollbar-primary">
                <table class="table table-striped" border="1">
                    <thead>
                        <tr>
                            <th width="790px"><h5><b style="margin-left: 95px;">Chapter</b></h5></th>
                            <th><h5><b style="margin-left: 60px;">Ngày cập nhật</b></h5></th>
                        </tr>
                    </thead>
                    <tbody style="height: 10px">
                        <tr>
                            <th>
                                <ul class="mucluctruyen">
                                    @foreach($chapter as $key => $chap)
                                    <a href="{{url('xem-chapter/'.$chap->slug_chapter)}}">
                                        <li>
                                            {{$chap->tieude}}
                                        </li>
                                    </a>
                                    @endforeach
                                </ul>
                            </th>
                            <th width="270px">
                                <ul class="timeupdate">
                                    @foreach($chapter as $key => $chap)
                                    <li>
                                        {{$chap->updated_at}}
                                    </li>
                                    @endforeach
                                </ul>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            @else
                <ul><li>Hiện tại chưa cập nhật!</li></ul>
            @endif
        </div>

        <b style="color: blue"><i class="fas fa-bookmark"></i>  TRUYỆN CÙNG DANH MỤC</b><hr>
        <div class="row">
            @foreach ($cungdanhmuc as $key => $value)
            <style type="text/css">
                .col-md-3{background: white; text-align: center;}
                .col-md-3 img{width: 210px; height: 300px;}
                .col-md-3 img:hover {border: 10px solid #DCDCDC;}
                .col-md-3 a{text-decoration: none; color: black;}
                .col-md-3 a:hover {color: blue;}
            </style>
            <div class="col-md-3">
                <div class="card-body">
                    <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">
                        <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}">
                        <br><br><h5><b>{{$value->tentruyen}}</b></h5>
                        <small class="text-muted"><i class="fas fa-eye"></i>4654561</small>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-3">
        <h3 style="margin-top: 10px; border-top:2px solid #32CD32">Truyện nổi bật</h3>
        @foreach($truyennoibat as $key =>$noibat)
        <div class="row mt-2">
            <style>
                .col-4 img {width: 100%;}
                .col-4 img:hover {border: 5px solid #DCDCDC;}
                .col-8 a {text-decoration: none; color: black;}
                .col-8 a:hover {color: blue;}
            </style>
            <div class="col-4">
                <a href="{{url('xem-truyen/'.$noibat->slug_truyen)}}">
                    <img src="{{asset('public/uploads/truyen/'.$noibat->hinhanh)}}" alt="{{$noibat->tentruyen}}">
                </a>
            </div>
            <div class="col-8">
                <a href="{{url('xem-truyen/'.$noibat->slug_truyen)}}">
                    <p>{{$noibat->tentruyen}}</p>
                </a>
                <small class="text-muted"><i class="fas fa-eye"></i>4654561</small>
            </div>
        </div>
        @endforeach
        <h3 style="margin-top: 10px; border-top:2px solid #32CD32">Truyện xem nhiều</h3>
        @foreach($truyenxemnhieu as $key =>$xemnhieu)
        <div class="row mt-2">
            <style>
                .col-4 img {width: 100%;}
                .col-4 img:hover {border: 5px solid #DCDCDC;}
                .col-8 a {text-decoration: none; color: black;}
                .col-8 a:hover {color: blue;}
            </style>
            <div class="col-4">
                <a href="{{url('xem-truyen/'.$xemnhieu->slug_truyen)}}">
                    <img src="{{asset('public/uploads/truyen/'.$xemnhieu->hinhanh)}}" alt="{{$xemnhieu->tentruyen}}">
                </a>
            </div>
            <div class="col-8">
                <a href="{{url('xem-truyen/'.$xemnhieu->slug_truyen)}}">
                    <p>{{$xemnhieu->tentruyen}}</p>
                </a>
                <small class="text-muted"><i class="fas fa-eye"></i>4654561</small>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
<br>

@endsection