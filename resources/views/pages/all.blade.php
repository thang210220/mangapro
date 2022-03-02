@extends('../layout')

@section('content')

<nav aria-label="breadcrumb" style="background: white">
    <style>
        .breadcrumb a{text-decoration: none; color: blue;}
    </style>
    <ol class="breadcrumb" style="margin-left: 10px">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Xem tất cả</li>
    </ol>
    <h3 style="margin-left: 10px">Xem tất cả</h3>
</nav>

<div class="album py-5">
    <div class="container">
        <div class="row" style="background: white;">
            @foreach ($xemtatca as $key => $value)
            <style type="text/css">
                .col-md-3{text-align: center;}
                .col-md-3 img{width: 210px; height: 300px;}
                .col-md-3 img:hover {border: 10px solid #DCDCDC;}
                .col-md-3 a{text-decoration: none; color: black;}
                .col-md-3 a:hover {color: blue;}
            </style>
            <div class="col-md-3">
                <div class="card-body">
                    <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">
                        <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" >
                        <br><br><h4><b>{{$value->tentruyen}}</b></h4>
                        <small class="text-muted"><i class="fas fa-eye"></i>4654561</small>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection