@extends('layouts.content3')

@section('content')
<div class="row">
        <div class="col-lg-8" id="leftCol">
            @if(count($query) > 0)
                @foreach($query as $result)
                    <div class="row">
                        <div class="col-lg-12">
                            <h3><a href="/{{ $result->category }}/{{ $result->date }}/{{ $result->slug }}">{{ $result->title }}</a></h3>
                            <p>{!! strip_tags(substr($result->body, 0, 200)) !!} ...</p>
                            <h4 class="date">{{ date('M d, Y', $result->date) }}</h4>

                        </div>
   
                    </div>
                    <hr />
                    @endforeach() 
            @else
                <h4>No results found, try refining your search.</h4> 
            @endif                       
            
        </div>
@endsection
