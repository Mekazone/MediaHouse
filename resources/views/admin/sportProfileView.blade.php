@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Sports Profile</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="{{ action('Admin\SportsProfileController@edit', $result->id) }}" class="btn btn-primary btn-sm">Edit</a><br /><br />
                    
                    @if($news > 0)
                        <div>{{ date('M d, Y', $result->date) }}</div> 
                        <div><h4>{{ $result->title }}</h4></div>
                        
                        @if($topImage)
                            @foreach($topImage as $attachment)
                                    @if($attachment->fileCategoryId == 1)
                                        <div class="results"><img class="img-thumbnail" src="/{{ $attachment->name }}" /></div>
                                        @if($attachment->caption)
                                            <div class="caption">{{ $attachment->caption }}</div>
                                        @endif
                                    @endif   
                            @endforeach
                        @endif
                        
                        <div class="postBody">{!! $result->body !!}</div>
                        
                        @if($bottomAttachments)
                            @foreach($bottomAttachments as $attachment)
                                    @if($attachment->fileCategoryId == 1)
                                        <span class="results"><img class="img-thumbnail" src="/{{ $attachment->name }}" /></span>
                                        @if($attachment->caption)
                                            <div class="caption">{{ $attachment->caption }}</div>
                                        @endif
                                    @elseif($attachment->fileCategoryId == 2)
                                        @if($attachment->caption)
                                            <div class="results"><a href="/{{ $attachment->name }}">{{ $attachment->caption }}</div>
                                        @else
                                            <div class="results"><a href="/{{ $attachment->name }}">Click to view document</a></div>
                                        @endif
                                        
                                    @endif   
                            @endforeach  
                       @endif             
                    @endif                                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
