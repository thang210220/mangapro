@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm thể loại truyện</div>

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
                    
                    <form method="post" action="{{ route('theloai.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thể loại</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{old('tentheloai')}}" onkeyup="ChangeToSlug();" name="tentheloai" id="slug" aria-describedby="emailHelp" placeholder="Tên thể loại ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Slug danh mục</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{old('slug_theloai')}}" name="slug_theloai" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug thể loại ...">
                        </div>
                        
                        <button style="margin-top:10px" type="submit" name="themtheloai" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
