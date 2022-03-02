@extends('../layout')
@section('slide')
    @include('pages.slide')
@endsection
@section('content')

<div class="container">
<div class="row" style="background: white;">
    <div class="col-9">
        <div class="row" style="margin-top: 10px; border-top:2px solid #32CD32"><h3>TRUYỆN MỚI CẬP NHẬT</h3></div>
        <div class="row">
            @foreach ($truyen as $key => $value)
            <style type="text/css">
                .col-3{text-align: center;}
                .col-3 img:hover {border: 10px solid #DCDCDC;}
                .col-3 a{text-decoration: none; color: black;}
                .col-3 a:hover {color: blue;}
            </style>
            <div class="col-3">
                <div class="card-body">
                    <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">
                        <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" style="width: 190px;height: 250px">
                        <br><br><h6><b>{{$value->tentruyen}}</b></h6>
                    </a>
                    <small class="text-muted"><i class="fas fa-eye"></i>4654561</small>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <a href="{{url('xem-tatca')}}" class="btn btn-success">Xem tất cả</a>
        </div>
    </div>
    <div class="col-3">
        <div class="row" style="margin-top: 10px; border-top:2px solid #32CD32">
            <h3>FANPAGE</h3>
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FMangaprocom-101305011774420%2F&tabs=timeline&width=280&height=600&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="280" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
        </div>
        <div class="row">
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
</div>
<br>

@endsection