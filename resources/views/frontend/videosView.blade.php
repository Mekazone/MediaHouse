@extends('layouts.content2')

@section('content')
<div class="row">
    <div class="col-lg-8" id="leftCol">
        @if($videos > 0)
            <div class="row">
                <div class="col-md-9">
                    @if (\Session::has('success'))
                      <div class="alert alert-success">
                          <p>{{ \Session::get('success') }}</p>
                      </div><br />
                    @endif
                    
                    <h3>{{ $result->title }}</h3>
                    <h4 class="date">{{ date('M d, Y', $result->date) }}</h4>
                    
                    <!--link to share on social media-->
                    <div class='share'>
                        @php
                            $uri = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                        @endphp
                        <a href='http://www.facebook.com/sharer.php?u={{ $uri }}&t={{ $result->title }}'><img src='/frontend_assets/social_icons/Facebook.png' alt='Share on Facebook'/></a> 
                        <a href='http://www.twitter.com/share?u={{ $uri }}&text={{ $result->title }}&size=large'><img src='/frontend_assets/social_icons/Twitter.png' alt='Share on Twitter'/></a> 
                        <a href='http://www.plus.google.com/share?u={{ $uri }}'><img src='/frontend_assets/social_icons/Google.png' alt='Share on Google+'/></a> 
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            
            <div class="row">
                <div class="video-container"><iframe width="500" height="280" src="{{ urldecode($result->link) }}" frameborder="0" allowfullscreen></iframe></div>
                <div class="col-md-1"></div>
            </div>
            
            <!-- similar Videos -->
            @if(count($similarVideos) > 0)
                <hr />
                <div class="row">
                    <h5 class="similar_news_heading">Similar videos</h5>
                    @foreach($similarVideos as $similar)
                    
                        <div class="col-sm-12 col-md-4">
                        <iframe class="img-thumbnail" width="300" height="200" src="{{ urldecode($similar->link) }}" frameborder="0" allowfullscreen></iframe>
                        <p class="similar_news_body"><a href="/videos/{{ $similar->date }}/{{ $similar->slug }}">{{ $similar->title }}</a></p>
                        </div>                 
                    @endforeach
                </div>
            @endif
                  
        @endif

    </div>
@endsection