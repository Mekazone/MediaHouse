@extends('layouts.content')

@section('content')
<div class="row">
        <div class="col-lg-8" id="leftCol">
            @if($news > 0)
                @foreach($posts as $post)
                    <div class="row">
                        @if($post->image)
                        <div class="col-lg-8">
                            <h3><a href="/{{ $post->category }}/{{ $post->date }}/{{ $post->slug }}">{{ $post->title }}</a></h3>
                            <p>{!! strip_tags(substr($post->body, 0, 200)) !!} ...</p>
                            <h4 class="date">{{ date('M d, Y', $post->date) }}</h4>
                        </div>
                        <div class="col-lg-4">
                            <a href="/{{ $post->category }}/{{ $post->date }}/{{ $post->slug }}"><img src="/{{ $post->image }}" class="img-responsive img-thumbnail" /></a>
                        </div>
                        @else
                        <div class="col-lg-12">
                            <h3><a href="/{{ $post->category }}/{{ $post->date }}/{{ $post->slug }}">{{ $post->title }}</a></h3>
                            <p>{!! strip_tags(substr($post->body, 0, 200)) !!} ...</p>
                            <h4 class="date">{{ date('M d, Y', $post->date) }}</h4>
                        </div>
                        @endif
                    </div>
                    <hr />
                @endforeach() 
                        
                    <div class="paginate">{{ $results->links("pagination::bootstrap-4") }}</div>
            @endif                       
            
        </div>
@endsection