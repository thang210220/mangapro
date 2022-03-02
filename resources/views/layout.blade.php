<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mangapro</title>
        <link rel="shortcut icon" href="{{asset('public/uploads/truyen/icon.png')}}"/>
        
        <!-- style -->
        <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" style="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <!---------------------------------- menu ---------------------------------->
            <nav class="navbar navbar-expand navbar-light bg-white">
                <a class="logo" href="{{url('/')}}"><img src="{{asset('public/uploads/truyen/logo.png')}}" style="margin-left: 30px; width:180px;"></a>
                <div class="navbar-collapse">
                    <form autocomplete="off" class="search" action="{{url('tim-kiem')}}" method="POST">
                        @csrf
                        <div class="input-group" style="margin-left: 50px; width: 700px">
                            <input type="search" id="keywords" name="tukhoa" class="form-control" placeholder="Tìm kiếm tác giả, truyện...">
                            <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                        <style>
                            .dropdown-menu{margin-left: 50px; width: 740px;}
                            ul.dropdown-menu li{padding: 5px 15px;}
                            ul.dropdown-menu li a{color: black; text-decoration: none}
                        </style>
                        <div id="search_ajax"></div>
                    </form>
                    <i class="fas fa-toggle-on" id="switch_color" style="font-size: 50px; margin-left: 10px"></i>
                    <div class="input-group-btn" style="margin-left: 20px">
                        <a href="#">
                            <button class="btn btn-info" type="submit">
                                <i class="fas fa-user-plus">  Đăng ký</i>
                            </button>
                        </a>
                        <a href="{{url('dang-nhap')}}">
                            <button class="btn btn-danger" type="submit">
                                <i class="fas fa-sign-in-alt">  Đăng nhập</i>
                            </button>
                        </a>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-expand navbar-light" style="background: #FF9900">
                <style>
                    .navbar-collapse {margin-left: 10px;}
                    .navbar-collapse ul li:hover {background: #FFCC66;}
                </style>
                <div class="navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{url('/')}}"><b>Trang chủ</b></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b>Danh mục truyện</b>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($danhmuc as $key => $danh)
                                <a class="dropdown-item" href="{{url('danh-muc/'.$danh->slug_danhmuc)}}">{{$danh->tendanhmuc}}</a>
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b>Thể loại</b>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="row" style="width: 800px">
                                    @foreach($theloai as $key => $the)
                                    <div class="col-2" style="margin: 0px 5px">
                                        <a class="dropdown-item" href="{{url('the-loai/'.$the->slug_theloai)}}">{{$the->tentheloai}}</a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav><br>
            <!---------------------------------- slide ---------------------------------->
            @yield('slide')
            <!---------------------------------- Truyện mới ---------------------------------->
            @yield('content')
            <footer>
                <div class="container" style="background: white">
                    <div class="row">
                        <div class="col-3">
                            <a class="logo" href="{{url('/')}}"><img src="{{asset('public/uploads/truyen/logo.png')}}" style="width:180px;"></a>
                        </div>
                        <div class="col-9">
                            <a href="#" style="margin-left: 1000px">
                                <i class="fas fa-arrow-circle-up" style="font-size:44px"></i>
                            </a>
                            <p style="margin-left: -320px">
                                <br>Chúc bạn đọc truyện vui vẻ!<br>
                                Copyright © 2022 - Mangapro - All Rights Reserved. Phiên bản thử nghiệm đang chờ xin giấy phép bộ TT & TT
                            </p>
                            
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script type="text/javascript">
            var myCustomScrollbar = document.querySelector('.my-custom-scrollbar');
            var ps = new PerfectScrollbar(myCustomScrollbar);

            var scrollbarY = myCustomScrollbar.querySelector('.ps__rail-y');

            myCustomScrollbar.onscroll = function () {
            scrollbarY.style.cssText = `top: ${this.scrollTop}px!important; height: 400px; right: ${-this.scrollLeft}px`;
            }
        </script>
        <script type="text/javascript">
            $('#keywords').keyup( function(){
                var keywords = $(this).val();
                if(keywords != '')
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{url('timkiem-ajax')}}",
                        method:"POST",
                        data:{keywords:keywords, _token:_token},
                        success:function(data){
                            $('#search_ajax').fadeIn();
                                $('#search_ajax').html(data);
                        }
                    });
                }else{
                    $('#search_ajax').fadeOut();
                }
            });
            $(document).on('click', '.li_timkiem_ajax', function(){
                $('#keywords').val( $(this).text() );
                $('#search_ajax').fadeOut();
            });
        </script>
        <script type="text/javascript">
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                dot:true,
                // nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:5
                    }
                }
            })
        </script>
        <script type="text/javascript">
            $('.select-chapter').on('change',function(){
                var url = $(this).val();
                if(url){
                    window.location = url;
                }
                return false;
            });

            current_chapter();

            function current_chapter(){
                var url = window.location.href;
                $('.select-chapter').find('option[value="'+url+'"]').attr("selected",true);
            }
        </script>
        
    </body>
</html>
