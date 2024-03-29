<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mangapro</title>
    <link rel="shortcut icon" href="{{asset('public/uploads/truyen/icon.png')}}"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="logo" href="{{ route('home')}}"><img src="{{asset('public/uploads/truyen/logo.png')}}" style="margin-left: 30px; width:180px;"></a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                <!-- {{ route('register') }} -->
                                    <a class="nav-link" href="#">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $('#keywords2').keyup( function(){
            var keywords2 = $(this).val();
            if(keywords2 != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('timkiem-ajax2')}}",
                    method:"POST",
                    data:{keywords2:keywords2, _token:_token},
                    success:function(data){
                        $('#search_ajax').fadeIn();
                            $('#search_ajax').html(data);
                    }
                });
            }else{
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click', '.li_timkiem_ajax2', function(){
            $('#keywords2').val( $(this).text() );
            $('#search_ajax').fadeOut();
        });
    </script>
    <script type="text/javascript">
        $('#keywords3').keyup( function(){
            var keywords3 = $(this).val();
            if(keywords3 != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('timkiem-ajax3')}}",
                    method:"POST",
                    data:{keywords3:keywords3, _token:_token},
                    success:function(data){
                        $('#search_ajax3').fadeIn();
                            $('#search_ajax3').html(data);
                    }
                });
            }else{
                $('#search_ajax3').fadeOut();
            }
        });
        $(document).on('click', '.li_timkiem_ajax3', function(){
            $('#keywords3').val( $(this).text() );
            $('#search_ajax3').fadeOut();
        });
    </script>
    <script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('noidung_chapter',{
            filebrowserImageUploadUrl : "{{ url('uploads-ckeditor?_token='.csrf_token()) }}",
            filebrowserBrowserUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
            filebrowserUploadMethod :'form'
        });
    </script>
    <script type="text/javascript">
        function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>
    <script type="text/javascript">
        $('.truyennoibat').change(function(){
            const truyennoibat = $(this).val();
            
            const truyen_id = $(this).data('truyen_id');
            var _token = $('input[name="_token"]').val();
            
            if(truyennoibat==0){
                var thongbao = 'Thay đổi truyện mới thành công';
            }else if(truyennoibat==1){
                var thongbao = 'Thay đổi truyện nổi bật thành công';
            }else{
                var thongbao = 'Thay đổi truyện xem nhiều thành công';
            }
            $.ajax({
                url:"{{url('/truyennoibat')}}",
                method:"POST",
                data:{truyennoibat:truyennoibat, truyen_id:truyen_id, _token:_token},
                success:function(data)
                    {
                        // $('#thongbao').html('<span class="text text-alert">'+thongbao+'</span>');
                        alert(thongbao);
                    }
            });
        })
    </script>
</body>
</html>
