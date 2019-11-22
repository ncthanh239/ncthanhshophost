<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ncthanh shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script type="application/x-javascript"> addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <meta charset utf="8">
    <!--fonts-->
    <link href='//fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>


    <!--fonts-->
    <!--form-css-->

    <link href="{{asset('css/form.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!--bootstrap-->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <!--coustom css-->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="shortcut icon" type="image/png" href="{{asset('images/favicon.png')}}"/>
    <!--shop-kart-js-->
    <script src="{{asset('js/simpleCart.min.js')}}"></script>
    <!--default-js-->
    <script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
    <!--bootstrap-js-->
    <script src="{{asset('js/bootstrap1.min.js')}}"></script>
    <!--script-->
    <!-- FlexSlider -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{asset('js/imagezoom.js')}}"></script>
    <script defer src="{{asset('js/jquery.flexslider.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}" type="text/css" media="screen" />
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
            // Can also be used with $(document).ready()
            $(window).load(function() {
              $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
          });
      </script>
      <!-- //FlexSlider-->
  </head>
  <body>
    <div class="header">
        <div class="container">
            <div class="header-top">
                <div class="logo">
                    <a href="{{asset('')}}">Nct - Shop</a>
                </div>
                <div class="login-bars">
                   
                   <div >
                    <a class="btn btn-default log-bar" href="{{ asset('') }}cart" >Cart</a>
                       @if (Auth::user()==null)
                       <a class="btn btn-default log-bar" href="{{ asset('') }}login" >Đăng nhập</a>
                       @endif
                       @if (Auth::user()!==null)
                       <a  class="btn btn-default log-bar" href="{{ asset('') }}myaccount" title="">&nbsp;{{Auth::user()->name}}
                        
                             <a  class="btn btn-default log-bar" href="{{ asset('') }}logout"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Đăng xuất') }}
                            </a>

                            <form id="logout-form" action="{{ asset('') }}logout" method="POST" >
                                @csrf
                            </form>
                       
                    </a>
                    @endif
                </div>


               
            </div>
            <div class="clearfix"></div>
        </div>
        <!---menu-----bar--->
        <div class="header-botom">
            <div class="content white">
                <nav class="navbar navbar-default nav-menu" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!--/.navbar-header-->

                    <div class="collapse navbar-collapse collapse-pdng" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav nav-font">
                            <li class="dropdown">
                                <a href="#" >Shop</a>
                            </li>
                            <li class="dropdown">
                                <a href="#">Men</a>
                                
                            </li>
                            <li class="dropdown">
                                <a href="#" >Women</a>
                                
                            </li>
                            <li class="dropdown">
                                <a href="https://www.facebook.com/Hieu239">About Me</a>
                            </li>

                            <div class="clearfix"></div>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!--/.navbar-collapse-->
                    <div class="clearfix"></div>
                </nav>
                <!--/.navbar-->   
                <div class="clearfix"></div>
            </div>
            <!--/.content--->
        </div>
        <!--header-bottom-->
    </div>
</div>
<div class="head-bread">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">PRODUCTS</li>
        </ol>
    </div>
</div>


@yield('noidung')

<div class="footer-grid">
    <div class="container">
        <div class="col-md-2 re-ft-grd">
            <h3>Categories</h3>
            <ul class="categories">
                @if(@isset ($categories))
                @foreach ($categories as $category)
                <li><a href="#">{{$category->name}}</a></li>
                @endforeach
                @endif

            </ul>
        </div>
        <div class="col-md-2 re-ft-grd">
            <h3>Short links</h3>
            <ul class="shot-links">
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Support</a></li>
                <li><a href="#">Delivery</a></li>
                <li><a href="#">Return Policy</a></li>
                <li><a href="#">Terms & conditions</a></li>
                <li><a href="">Sitemap</a></li>
            </ul>
        </div>
        <div class="col-md-6 re-ft-grd">
            <h3>Social</h3>
            <ul class="social">
                <li><a href="https://www.facebook.com/Hieu239" class="fb">facebook</a></li>
                <li><a href="https://www.instagram.com/_ncthanh_/" class="twt">instagram</a></li>
                <li><a href="#" class="gpls">g+ plus</a></li>
                <div class="clearfix"></div>
            </ul>
        </div>
        <div class="col-md-2 re-ft-grd">
            <div class="bt-logo">
                <div class="logo">
                    <a href="index.html" class="ft-log">NCT</a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="copy-rt">
        <div class="container">
            <p>&copy;   2019 Ncthanh All Rights Reserved</p>
        </div>
    </div>
</div>
@yield('css')
@yield('foot')
</body>
</html>