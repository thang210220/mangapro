@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm Chapter</div>

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
                    
                    <form method="post" action="{{ route('chapter.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Chapter</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{old('tieude')}}" onkeyup="ChangeToSlug();" name="tieude" id="slug" aria-describedby="emailHelp" placeholder="Tiêu đề ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Slug CHapter</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{old('slug_chapter')}}" name="slug_chapter" id="convert_slug" aria-describedby="emailHelp" placeholder="Tên slug ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Nội dung</label>
                            <textarea style="margin-top:10px; resize: none;" name="noidung" id="noidung_chapter" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Thuộc truyện</label>
                            <select style="margin-top:10px; width:100%" name="truyen_id" class="custom-select">
                                @foreach($truyen as $key => $value)
                                <option value="{{$value->id}}">{{$value->tentruyen}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button style="margin-top:10px" type="submit" name="themdanhmuc" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
