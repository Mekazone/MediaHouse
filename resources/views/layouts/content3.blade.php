<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('frontend_assets/images/logo.jpg') }}" type="image/x-icon">
    <meta name="description" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend_assets/font-awesome-4.7.0/css/font-awesome.min.css') }}" />
    <title>FIDES Communications</title>

    <!-- Styles -->
    <link href="{{ asset('frontend_assets/css/app.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fondamento" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
    <link href="{{ asset('frontend_assets/css/menu.css') }}" rel="stylesheet" />
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" id="logo" href="{{ url('/') }}">FIDES</a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">News &amp; Events <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/news') }}">News</a></li>
                                    <li><a href="{{ url('/vaticannews') }}">Vatican News</a></li>
                                    <li><a href="{{ url('/parishesnews') }}">News &amp; Events Around the Parishes</a></li>
                                    <li><a href="{{ url('/christendom') }}">News Around Christendom</a></li>
                                    <li><a href="{{ url('/photonews') }}">Photo News</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="/politics">Politics</a></li>
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Features <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/churchdocs') }}">Church Documents</a></li>
                                    <li><a href="{{ url('/inspirational') }}">Inspirational Personalities</a></li>
                                    <li><a href="{{ url('/sundaytonic') }}">Sunday Tonic</a></li>
                                    <li><a href="{{ url('/wits') }}">Wits Corner</a></li>
                                    <li><a href="{{ url('/youngpeople') }}">Young People's Corner with Amarachi</a></li>
                                    <li><a href="{{ url('/asiseeit') }}">As I See It with Jude Atupulazi</a></li>
                                    <li><a href="{{ url('/franktalk') }}">Frank Talk with Uche Amunike</a></li>
                                    <li><a href="{{ url('/odogwu') }}">Odogwu's Desk</a></li>
                                    <li><a href="{{ url('/videos') }}">Videos</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="/editorial">Editorial</a></li>
                            <li><a href="/opinion">Opinion</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Sports <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/sports') }}">Sports News</a></li>
                                    <li><a href="{{ url('/sportsprofile') }}">Sports Profile</a></li>
                                    <li><a href="{{ url('/dosadinfo') }}">DOSAD Info &amp; Notifications</a></li>
                                </ul>
                            </li>
                            <li><a href="/advertorial">Advertorial</a></li>
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Notifs <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/bishopsdesk') }}">Bishop's Desk</a></li>
                                    <li><a href="{{ url('/fidesinfo') }}">FIDES Information Desk</a></li>
                                    <li><a href="{{ url('/diocesannotifs') }}">Diocesan Secretariat Notifications</a></li>
                                    <li><a href="{{ url('/vaticannotifs') }}">Vatican Notifications</a></li>
                                </ul>
                            </li>
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Services <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/services/printing') }}">Printing</a></li>
                                    <li><a href="{{ url('/services/publishing') }}">Publishing</a></li>
                                    <li><a href="{{ url('/services/audiovisuals') }}">Audio/Video Services</a></li>
                                    <li><a href="{{ url('/services/bookshop') }}">Bookshop</a></li>
                                    <li><a href="{{ url('/services/library') }}">Library Services</a></li>
                                    <li><a href="{{ url('/services/catering') }}">Catering Services</a></li>
                                    <li><a href="{{ url('/services/internet') }}">Internet Services</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/aboutus/advertise') }}">Advertise</a></li>
                            <li data-toggle="modal" data-target="#subscription"><a href="#">Subscribe</a></li>
                            <!--<li><a href="#">Shop Now</a></li> -->                           
                            <li data-toggle="modal" data-target="#myModal"><a href="#"><span class="fa fa-search"></span></a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
    
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-search" aria-hidden="true"></i> Search</h4>
      </div>
      <div class="modal-body">
        <form method="get" action="/results">
        <input type="text" class="form-control" id="search" name="search" placeholder="Enter search keywords" required="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
      </div>
      
    </div>
    
    </div>  
</div> 

<!-- Modal -->
<div id="subscription" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Subscribe</h4>
      </div>
      <div class="modal-body">
        <!--
        <form method="post" action="#" id="formx">  
        <span id="status_report" style="color: red;"></span>    
        <input type="email" class="form-control" id="subscribe" name="subscribe" placeholder="Enter your e-mail address to receive notifications on posts" required="">
        -->
        
        <!-- Begin Mailchimp Signup Form -->
        <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
        <style type="text/css">
        	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
        	/* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
        	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
        </style>
        <div id="mc_embed_signup">
        <form action="https://gmail.us20.list-manage.com/subscribe/post?u=e3a55e488b5a27411ff1242c7&amp;id=9e858e02ff" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
        <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
        <div class="mc-field-group">
        	<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
        </label>
        	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
        </div>
        <div class="mc-field-group">
        	<label for="mce-FNAME">First Name </label>
        	<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
        </div>
        <div class="mc-field-group size1of2">
        	<label for="mce-PHONE">Phone Number  <span class="asterisk">*</span>
        </label>
        	<input type="text" name="PHONE" class="required" value="" id="mce-PHONE">
        </div>
        	<div id="mce-responses" class="clear">
        		<div class="response" id="mce-error-response" style="display:none"></div>
        		<div class="response" id="mce-success-response" style="display:none"></div>
        	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_e3a55e488b5a27411ff1242c7_9e858e02ff" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
        </form>
        </div>
        <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
        <!--End mc_embed_signup-->
      </div>
      <!--
      <div class="modal-footer">
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
        </form>        
      </div>
      -->
    </div>
    
    </div>  
</div>
    
    <div class="container">
    <div class="page-header">
        <div class="row">
            <div class="col-md-8"><h2>{{ $title }}</h2></div>
            <div class="col-md-4">
                <div class="btn-group" role="group" aria-label="..." id="social">
                <a href="https://www.facebook.com/fidesnigeria" class="btn btn-default btn-lg" target=""><span class="fa fa-facebook"></span></a>
                <a href="https://www.twitter.com/fidesawka" class="btn btn-default btn-lg" target="_blank"><span class="fa fa-twitter"></a>
                <a href="https://plus.google.com/u/2/?pageId=none" class="btn btn-default btn-lg" target="_blank"><span class="fa fa-google-plus"></a>
                <a href="https://www.youtube.com/channel/UCL0irEaAOROKVGOAEOl-IEQ" class="btn btn-default btn-lg" target="_blank"><span class="fa fa-youtube"></span></a>
                </div>
            </div>
        </div>
        
        
        
    </div>
    
    @yield('content')
    <div class="col-lg-4" id="rightCol">
        <h3>Ads</h3>
        @if($ads)
            @foreach($ads as $ad)
                @if(count($ad->url)>0)
                    <div><a href="{{ $ad->url }}"><img src="/{{ $ad->image_name }}" class="img-responsive img-thumbnail ads" /></a></div>
                @else
                    <div><img src="/{{ $ad->image_name }}" class="img-responsive img-thumbnail ads" /></div>
                @endif
            @endforeach
        @endif
    </div>
    </div><hr /> 
    
    <div class="row">
        <div class="col-lg-8">&copy;2018 FIDES Communications</div>
        <div class="col-lg-4">
            <!--
            <div class="btn-group" role="group" aria-label="..." id="subscribeSignIn">
              <button type="button" class="btn btn-default">Subscribe</button>
              <button type="button" class="btn btn-default">Sign In</button>
            </div>
            -->
            <a href="/admin" class="btn btn-default" id="subscribeSignIn" target="_blank">Sign In</a>
        </div>
    </div><hr />
    
    <footer>
    <div class="col-lg-4" id="footer">
        <p><b>About Us</b></p>
        <p><a href="/aboutus/words">A few words</a></p>
        <p><a href="/aboutus/services">What we offer</a></p>
        <p><a href="/aboutus/team">Out team</a></p>
        <p><a href="/aboutus/advertise">Advertise with us</a></p><br />
        <p>Website developed by <b><a href="http://hanjors.com.ng" target="_blank" style="color: red;">Hanjors Global Ltd</a></b></p>
    </div>
    <div class="col-lg-4" id="footer">
        <p><b>Contact Us</b></p>
        <p><a href="/contact/contactinfo">Contact info</a></p>
        <p><a href="/contact/parishes">Parishes address book</a></p>
        <p><a href="/feedback">Feedback form</a></p>
    </div>
    <div class="col-lg-4"><iframe style="margin-bottom: 15px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2118259734716!2d7.071196314203266!3d6.235785728172512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10438260fa7ed62f%3A0x1100e42c2f90763e!2sFIDES+COMMUNICATIONS!5e0!3m2!1sen!2sng!4v1522655706727" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe></div></div>
    </div>

    </footer>
    <!-- Scripts -->
    <script src="{{ asset('frontend_assets/js/app.js') }}"></script>
    <script>
    //function for e-mail validation
    function validateEmail($email) {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      return emailReg.test( $email );
    }
    $(document).ready(function(){
        $('#formx').submit(function(e){
            e.preventDefault();
            $('#submit').text('Pls wait...');
            var email = $('#subscribe').val();
            //ensure email is entered correctly
            if(validateEmail(email)){
                $.get('/subscribe',
                {
                    email: email.trim()
                },
                function(data, status){
                    $('#subscribe').val('');
                    $('#submit').text('Submit');
                    $('#status_report').text(data);
                });
            }
            else{
                $('#status_report').text('* Ensure your e-mail address is entered correctly.');
            }
        });
    });
    </script> 
</body>
</html>
