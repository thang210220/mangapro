@extends('../layout')

@section('content')
<nav aria-label="breadcrumb" style="background: white">
    <style>
        .breadcrumb a{text-decoration: none; color: blue;}
    </style>
    <ol class="breadcrumb" style="margin-left: 10px">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{url('danh-muc/'.$truyen_breadcrumb->danhmuctruyen->slug_danhmuc)}}">{{$truyen_breadcrumb->danhmuctruyen->tendanhmuc}}</a></li>
        <li class="breadcrumb-item"><a href="{{url('xem-truyen/'.$truyen_breadcrumb->slug_truyen)}}">{{$truyen_breadcrumb->tentruyen}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$chapter->tieude}}</li>
    </ol>
    <h4 style="margin-left: 10px">{{$chapter->truyen->tentruyen}}<small class="text-muted">  (Cập nhật lúc: {{$chapter->updated_at->diffForHumans()}})</small></h4>
</nav>

<center>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5" style="background: white; margin-top: 10px; width: 1296px">
                <style type="text/css">
                    .isDisabled {
                        color: currentColor;
                        pointer-events: none;
                        opacity: 0.5;
                        text-decoration: none;
                    }
                </style>
                <div class="form-group">
                    <a href="{{url('xem-chapter/'.$previous_chapter)}}" class="btn btn-primary {{$chapter->id==$min_id->id ? 'isDisabled' : ''}}">Chap trước</a>
                    <select name="select-chapter" class="custom-select select-chapter">
                        @foreach($all_chapter as $key => $chap)
                        <option value="{{url('xem-chapter/'.$chap->slug_chapter)}}">{{$chap->tieude}}</option>
                        @endforeach
                    </select>
                    <a href="{{url('xem-chapter/'.$next_chapter)}}" class="btn btn-primary {{$chapter->id==$max_id->id ? 'isDisabled' : ''}}">Chap sau</a>
                </div>
            </div><br>
            <div class="noidungchuong" style="background: white">
                <br>
                {!! $chapter->noidung !!}
            </div>
            <div class="col-md-5" style="background: white; margin-top: 10px; width: 1296px">
                <div class="form-group">
                    <a href="{{url('xem-chapter/'.$previous_chapter)}}" class="btn btn-primary {{$chapter->id==$min_id->id ? 'isDisabled' : ''}}">Chap trước</a>
                    <select name="select-chapter" class="custom-select select-chapter">
                        @foreach($all_chapter as $key => $chap)
                        <option value="{{url('xem-chapter/'.$chap->slug_chapter)}}">{{$chap->tieude}}</option>
                        @endforeach
                    </select>
                    <a href="{{url('xem-chapter/'.$next_chapter)}}" class="btn btn-primary {{$chapter->id==$max_id->id ? 'isDisabled' : ''}}">Chap sau</a>
                </div>
            </div>
        </div>
    </div>
</center>

@endsection