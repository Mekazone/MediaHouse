<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FIDES') }}</title>

    <!-- Styles -->
    <link href="{{ asset('frontend_assets/css/app.css') }}" rel="stylesheet">
      <script>
  tinymce.init({
    selector: '#mytextarea',
    theme: 'modern',
    width: 700,
    height: 250,
    //file_browser_callback: 'myFileBrowser',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    media_live_embeds: true,
    //menubar: false,
    menubar: 'insert',
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | code insert'
  });
  </script>
  <style>
  .postImage {
    margin-bottom: 10px;
  }
  .post {
    margin: 10px 0;
  }
  .results {
    margin-top: 15px;
  }
  .caption {
    font-style: italic;
  }
  .postBody {
    margin: 20px 0;
  }
  .paginate {
    text-align: center;
  }
  .fileType {
    margin-top: 10px;
  }
  .fileTypeValues {
    margin-right: 40px;
  }
  .glyphicon-asterisk {
    color: red;
  }
  #topImages, #bottomImages {
    background: #efefef;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
  }
  .dropdown hr {
    margin: 0;
  }
  .news_links td {
    padding-right: 10px;
  }
  #video_notif {
    color: red;
  }
  .video-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px; height: 0; overflow: hidden;
    }
    
    .video-container iframe,
    .video-container object,
    .video-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    }
  </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                        {{ config('app.name', 'Catholic Diocese of Nnewi') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <!--<li><a href="{{ route('register') }}">Register</a></li>-->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">News &amp; Events <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/admin/news') }}">News</a></li>
                                    <li><a href="{{ url('/admin/vaticannews') }}">Vatican News</a></li>
                                    <li><a href="{{ url('/admin/parishesnews') }}">News &amp; Events Around the Parishes</a></li>
                                    <li><a href="{{ url('/admin/christendom') }}">News Around Christendom</a></li>
                                    <li><a href="{{ url('/admin/photonews') }}">Photo News</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="/admin/politics">Politics</a></li>
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Features <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/admin/churchdocs') }}">Church Documents</a></li>
                                    <li><a href="{{ url('/admin/inspirational') }}">Inspirational Personalities</a></li>
                                    <li><a href="{{ url('/admin/sundaytonic') }}">Sunday Tonic</a></li>
                                    <li><a href="{{ url('/admin/wits') }}">Wits Corner</a></li>
                                    <li><a href="{{ url('/admin/youngpeople') }}">Young People's Corner with Amarachi</a></li>
                                    <li><a href="{{ url('/admin/asiseeit') }}">As I See It with Jude Atupulazi</a></li>
                                    <li><a href="{{ url('/admin/franktalk') }}">Frank Talk with Uche Amunike</a></li>
                                    <li><a href="{{ url('/admin/odogwu') }}">Odogwu's Desk</a></li>
                                    <li><a href="{{ url('/admin/videos') }}">Videos</a></li><hr />
                                    <li><a href="{{ url('/admin/aboutus/words') }}">About Us - A Few Words</a></li>
                                    <li><a href="{{ url('/admin/aboutus/services') }}">About Us - What We Offer</a></li>
                                    <li><a href="{{ url('/admin/aboutus/team') }}">About Us - Our Team</a></li>
                                    <li><a href="{{ url('/admin/aboutus/advertise') }}">Advertise with us</a></li>
                                    <li><a href="{{ url('/admin/contact/contactinfo') }}">Contact Info</a></li>
                                    <li><a href="{{ url('/admin/contact/parishes') }}">Parishes address book</a></li><hr />
                                    <li><a href="{{ url('/admin/services/printing') }}">Services - Printing</a></li>
                                    <li><a href="{{ url('/admin/services/publishing') }}">Services - Publishing</a></li>
                                    <li><a href="{{ url('/admin/services/audiovisuals') }}">Services - Audio/Video Services</a></li>
                                    <li><a href="{{ url('/admin/services/bookshop') }}">Services - Bookshop</a></li>
                                    <li><a href="{{ url('/admin/services/library') }}">Services - Library Services</a></li>
                                    <li><a href="{{ url('/admin/services/catering') }}">Services - Catering Services</a></li>
                                    <li><a href="{{ url('/admin/services/internet') }}">Services - Internet Services</a></li><hr />
                                    <li><a href="{{ url('/admin/comments') }}">Pending Comments</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="/admin/editorial">Editorial</a></li>
                            <li><a href="/admin/opinion">Opinion</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Sports <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/admin/sports') }}">Sports News</a></li>
                                    <li><a href="{{ url('/admin/sportsprofile') }}">Sports Profile</a></li>
                                    <li><a href="{{ url('/admin/dosadinfo') }}">DOSAD Info &amp; Notifications</a></li>
                                </ul>
                            </li>
                            <li><a href="/admin/advertorial">Advertorial</a></li>
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Notifs <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/admin/bishopsdesk') }}">Bishop's Desk</a></li>
                                    <li><a href="{{ url('/admin/fidesinfo') }}">FIDES Information Desk</a></li>
                                    <li><a href="{{ url('/admin/diocesannotifs') }}">Diocesan Secretariat Notifications</a></li>
                                    <li><a href="{{ url('/admin/vaticannotifs') }}">Vatican Notifications</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/admin/ads') }}">Adverts</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('frontend_assets/js/app.js') }}"></script>
    <script>
    $(document).ready(function(){
        $('#extraUpload').hide();
        /*
        $('#extraUpload').click(function(){
            $('#topImages:last').clone().appendTo('#topImagesContainer');
        });
        */
        $('#extraUpload2').click(function(){
            $('#bottomImages:last').clone().appendTo('#bottomImagesContainer');
        });
        
        //send mail to subscribers after each post
        $('#post_form').submit(function(){
            $('.status').text('Pls wait...');
        });
    });
    </script>
</body>
</html>