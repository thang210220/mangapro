<div class="container">
    <div class="row" style="background: white;">
        <h3>TRUYỆN Nổi BẬT</h3>
        <div class="owl-carousel owl-theme">
            @foreach($truyennoibat as $key =>$noibat)
                <div class="item">
                    <style>
                        .sli{margin-top: 10px; width: 250px; height: 340px;}
                        .sli:hover {border: 10px solid #DCDCDC;}
                        .sli-a{text-decoration: none; color: black; text-align: center;}
                    </style>
                    <a href="{{url('xem-truyen/'.$noibat->slug_truyen)}}" class="sli-a">
                        <img src="{{asset('public/uploads/truyen/'.$noibat->hinhanh)}}" class="sli">
                        <br><h5><b>{{$noibat->tentruyen}}</b></h5>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<br>
