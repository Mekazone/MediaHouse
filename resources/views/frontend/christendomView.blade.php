@extends('layouts.content2')

@section('content')
<div class="row">
    <div class="col-lg-8" id="leftCol">
        @if($news)
            <div class="row">
                <!-- top ad -->
                    @if(count($centreTopAds) > 0)
                @foreach($centreTopAds as $ad)                    
                    @if(count($ad->url)>0)
                        <div class="col-lg-10 news_ad"><a href="{{ $ad->url }}" target="_blank"><img src="/{{ $ad->image_name }}" class="img img-responsive img-thumbnail" /></a></div>
                    @else
                        <div class="col-lg-10 news_ad"><a href="{{ $ad->url }}" target="_blank"><img src="/{{ $ad->image_name }}" class="img img-responsive img-thumbnail" /></a></div>
                    @endif                    
                @endforeach
                @else
                    <div class="col-lg-10 news_ad"><a href="aboutus/advertise" target="_blank"><img src="{{ asset('frontend_assets/ad-images/ad1.jpg') }}" class="img img-responsive img-thumbnail" /></a></div>                   
                @endif
                
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
            @if($topImage)
                @foreach($topImage as $attachment)
                    @if($attachment->fileCategoryId == 1)
                    <div class="row">
                        <div class="col-md-10">
                            <div class="postImages"><img class="img-thumbnail" src="/{{ $attachment->name }}" /></div>
                            @if($attachment->caption)
                                <div class="caption">{{ $attachment->caption }}</div>
                            @endif
                        </div>
                        <div class="col-md-2"></div>
                    </div>    
                    @endif   
                @endforeach    
            @endif
            
            <div class="row">
                <div class="col-md-11"><div class="postBody">{!! $result->body !!}</div></div>
                <div class="col-md-1"></div>
            </div>
    
            @if($bottomAttachments)
                @foreach($bottomAttachments as $attachment)
                <div class="row">
                    <div class="col-md-10">
                        @if($attachment->fileCategoryId == 1)
                        <div class="postImages"><img class="img-thumbnail" src="/{{ $attachment->name }}" /></div>
                            @if($attachment->caption)
                                <div class="caption">{{ $attachment->caption }}</div>
                            @endif
                            @elseif($attachment->fileCategoryId == 2)
                            @if($attachment->caption)
                                <div class="postDoc"><a href="/{{ $attachment->name }}">{{ $attachment->caption }}</a></div>
                            @else
                            <div class="postDoc"><a href="/{{ $attachment->name }}">Click to view document</a></div>
                            @endif
        
                        @endif 
                    </div>
                    <div class="col-md-2"></div>
                </div> 
                @endforeach  
            @endif
            
            <!--link to share on social media-->
            <div class='share'>
                @php
                    $uri = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                @endphp
                <a href='http://www.facebook.com/sharer.php?u={{ $uri }}&t={{ $result->title }}'><img src='/frontend_assets/social_icons/Facebook.png' alt='Share on Facebook'/></a> 
                <a href='http://www.twitter.com/share?u={{ $uri }}&text={{ $result->title }}&size=large'><img src='/frontend_assets/social_icons/Twitter.png' alt='Share on Twitter'/></a> 
                <a href='http://www.plus.google.com/share?u={{ $uri }}'><img src='/frontend_assets/social_icons/Google.png' alt='Share on Google+'/></a> 
            </div>
            
            <!-- centre ad -->
                    @if(count($centreCentreAds) > 0)
                <div class="row">
                @foreach($centreCentreAds as $ad)                    
                    @if(count($ad->url)>0)
                        <div class="col-lg-10 news_ad"><a href="{{ $ad->url }}" target="_blank"><img src="/{{ $ad->image_name }}" class="img img-responsive img-thumbnail" /></a></div>
                    @else
                        <div class="col-lg-10 news_ad"><a href="{{ $ad->url }}" target="_blank"><img src="/{{ $ad->image_name }}" class="img img-responsive img-thumbnail" /></a></div>
                    @endif                    
                @endforeach
                </div>
                @else
                    <div class="row">
                    <div class="col-lg-10 news_ad"><a href="aboutus/advertise" target="_blank"><img src="{{ asset('frontend_assets/ad-images/ad1.jpg') }}" class="img img-responsive img-thumbnail" /></a></div>
                    </div>                   
                @endif
            
            <!-- similar news -->
            @if(count($similarNews) > 0)
                <hr />
                <div class="row">
                    <h5 class="similar_news_heading">Similar news</h5>
                    @foreach($similarNews as $similar)
                    
                        <div class="col-sm-12 col-md-4">
                        <a href="/{{ $similar->category }}/{{ $similar->date }}/{{ $similar->slug }}"><img class="img-thumbnail" src="/{{ $similar->name }}" /></a>
                        <p class="similar_news_body"><a href="/{{ $similar->category }}/{{ $similar->date }}/{{ $similar->slug }}">{{ $similar->title }}</a></p>
                        </div>                 
                    @endforeach
                </div>
            @endif
            
            <!-- bottom ad -->
                    @if(count($centreBottomAds) > 0)
                <div class="row">
                @foreach($centreBottomAds as $ad)                    
                    @if(count($ad->url)>0)
                        <div class="col-lg-10 news_ad"><a href="{{ $ad->url }}" target="_blank"><img src="/{{ $ad->image_name }}" class="img img-responsive img-thumbnail" /></a></div>
                    @else
                        <div class="col-lg-10 news_ad"><a href="{{ $ad->url }}" target="_blank"><img src="/{{ $ad->image_name }}" class="img img-responsive img-thumbnail" /></a></div>
                    @endif                    
                @endforeach
                </div>
                @else
                    <div class="row">
                    <div class="col-lg-10 news_ad"><a href="aboutus/advertise" target="_blank"><img src="{{ asset('frontend_assets/ad-images/ad1.jpg') }}" class="img img-responsive img-thumbnail" /></a></div>
                    </div>                   
                @endif
            
            <!-- news comment -->
            <hr />
            <div class="col-lg-11 comments">
                    <div class="comment-heading">Comments</div> 
                    
                    @if($comments)
                        @foreach($comments as $comment)
                        <div class="comment col-lg-11">
                            <div class="alert alert-success" role="alert">
                                <div class="comment-name">{{ $comment->name }}</div>
                                <div class="comment-content">{{ $comment->comment }}</div>  
                            </div> 
                        </div>
                        @endforeach
                    @endif
                    
                    <form action="{{action('Frontend\ChristendomController@store')}}" method="post" class="col-lg-8">
                        {{ csrf_field() }}
                        <input type="hidden" name="postId" value="{{ $result->id }}">
                        <input type="hidden" name="returnUrl" value="{{ url()->full() }}">
                        <div class="form-group input-gp">
                            <label class="form-control-label" for="contacts5-5-name">Name
                                <span class="glyphicon glyphicon-asterisk"></span>
                            </label>
                            <input type="top-text" class="form-control input-inverse input-sm" name="name" required="" data-form-field="Name" id="contacts5-5-name">
                        </div>
                        <div class="form-group input-gp">
                            <label class="form-control-label" for="contacts5-5-message">Comment</label>
                                <span class="glyphicon glyphicon-asterisk"></span>
                            <textarea class="form-control input-inverse input-sm" name="comment" data-form-field="Message" rows="5" id="contacts5-5-message" required=""></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
            </div>                     
        @endif

    </div>
@endsection