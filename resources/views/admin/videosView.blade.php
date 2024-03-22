@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Videos</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="news_links">
                        <tr><td><a href="{{ action('Admin\VideosController@edit', $result->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
                        <td>{{ Form::open(['method' => 'delete', 'route' => ['videos.destroy', $result->id]])}} {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete?")']) }} {{Form::close() }}</td></tr>
                    </table><br />
                    
                    @if($videos > 0)
                        <div>{{ date('M d, Y', $result->date) }}</div> 
                        <div><h4>{{ $result->title }}</h4></div>
                        
                        <div class="video-container"><iframe width="500" height="280" src="{{ urldecode($result->link) }}" frameborder="0" allowfullscreen></iframe></div>             
                    @endif                                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
