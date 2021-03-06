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
         
            //L???y text t??? th??? input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //?????i k?? t??? c?? d???u th??nh kh??ng d???u
                slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
                slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
                slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
                slug = slug.replace(/??|???|???|???|???/gi, 'y');
                slug = slug.replace(/??/gi, 'd');
                //X??a c??c k?? t??? ?????t bi???t
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
                slug = slug.replace(/ /gi, "-");
                //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
                //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox c?? id ???slug???
            document.getElementById('convert_slug').value = slug;
        }
    </script>
    <script type="text/javascript">
        $('.truyennoibat').change(function(){
            const truyennoibat = $(this).val();
            
            const truyen_id = $(this).data('truyen_id');
            var _token = $('input[name="_token"]').val();
            
            if(truyennoibat==0){
                var thongbao = 'Thay ?????i truy???n m???i th??nh c??ng';
            }else if(truyennoibat==1){
                var thongbao = 'Thay ?????i truy???n n???i b???t th??nh c??ng';
            }else{
                var thongbao = 'Thay ?????i truy???n xem nhi???u th??nh c??ng';
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
