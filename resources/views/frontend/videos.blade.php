@extends('layouts.content')

@section('content')
<div class="row">
        <div class="col-lg-8" id="leftCol">
            @if($videos > 0)
                @foreach($posts as $post)
                    <div class="row">
                        <div class="col-lg-12">
                            <h3><a href="/{{ $post->category }}/{{ $post->date }}/{{ $post->slug }}">{{ $post->title }}</a></h3>                                                   
                            <div class="video-container"><iframe width="500" height="300" src="{{ urldecode($post->link) }}" frameborder="0" allowfullscreen></iframe></div>
                            @if($post->comments)
                                @if($post->comments > 1)
                                    <div class="post_comments">{{ $post->comments }} comments</div>
                                @else
                                    <div class="post_comments">{{ $post->comments }} comment</div>
                                @endif
                            @endif
                            <div class="date">{{ date('M d, Y', $post->date) }}</div>
                        </div>
                    </div>
                    <hr />
                @endforeach() 
                        
                    <div class="paginate">{{ $results->links("pagination::bootstrap-4") }}</div>
            @endif                       
            
        </div>
@endsection
