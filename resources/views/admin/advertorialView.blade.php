@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Advertorial</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="news_links">
                    <tr><td><a href="{{ action('Admin\AdvertorialController@edit', $result->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
                    <td>{{ Form::open(['method' => 'delete', 'route' => ['advertorial.destroy', $result->id]])}} {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete?")']) }} {{Form::close() }}</td>
                    
                    @if($topImage)
                            @if($featureCount > 0)
                                @if($featured == 'yes')
                                <td><a href="/admin/feature/{{$result->category}}/{{$result->id}}/{{$result->date}}/{{$result->title}}/{{ str_replace('/','-',$topImage->name) }}/{{$result->slug}}" class="btn btn-success btn-sm">Remove from featured news</a></td>
                                @else
                                <td><a href="/admin/feature/{{$result->category}}/{{$result->id}}/{{$result->date}}/{{$result->title}}/{{ str_replace('/','-',$topImage->name) }}/{{$result->slug}}" class="btn btn-success btn-sm">Add to featured news</a></td>
                                @endif
                            @else
                                <td><a href="/admin/feature/{{$result->category}}/{{$result->id}}/{{$result->date}}/{{$result->title}}/{{ str_replace('/','-',$topImage->name) }}/{{$result->slug}}" class="btn btn-success btn-sm">Add to featured news</a></td>
                            @endif
                        @endif</tr>
                    </table>
                    <br /><br />
                    
                    @if($news > 0)
                        <div>{{ date('M d, Y', $result->date) }}</div> 
                        <div><h4>{{ $result->title }}</h4></div>
                        
                        @if($topImage)
                                    @if($topImage->fileCategoryId == 1)
                                        <div class="results"><img class="img-thumbnail" src="/{{ $topImage->name }}" /></div>
                                        @if($topImage->caption)
                                            <div class="caption">{{ $topImage->caption }}</div>
                                        @endif
                                    @endif   
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
