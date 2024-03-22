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
                    
                    @if (\Session::has('success'))
                      <div class="alert alert-success">
                          <p>{{ \Session::get('success') }}</p>
                      </div><br />
                      @endif
                    
                    <a href="{{ action('Admin\VideosController@create') }}" class="btn btn-primary btn-sm">New</a><hr />
                    
                    @if($videos > 0)
                        @foreach($results as $result)
                        <div><h4><a href="/admin/{{ $result->category }}/{{ $result->date }}/{{ $result->slug }}">{{ $result->title }}</a></h4></div>
                        <div>{{ date('M d, Y', $result->date) }}</div>
                        <iframe width="500" height="280" src="{{ urldecode($result->link) }}" frameborder="0" allowfullscreen></iframe>
                        <hr />
                        @endforeach() 
                        
                        <div class="paginate">{{ $results->links() }}</div>  
                    @endif                                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
