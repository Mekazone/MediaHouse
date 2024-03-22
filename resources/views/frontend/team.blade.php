@extends('layouts.content2')

@section('content')
<div class="row">
    <div class="col-lg-8" id="leftCol">
        @if($about > 0)
        <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3"></div>
            </div>
            @if($topImages)
                @foreach($topImages as $attachment)
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
        @endif

    </div>
@endsection