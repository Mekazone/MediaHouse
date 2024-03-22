@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Vatican Notifications</div>

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
                    
                    <a href="{{ action('Admin\VaticanNotifsController@create') }}" class="btn btn-primary btn-sm">New</a><hr />
                    
                    @if($news > 0)
                        @foreach($results as $result)
                        <div>{{ date('M d, Y', $result->date) }}</div>
                        <div><h4>{{ $result->title }}</h4></div>
                        
                        <div>{!! substr($result->body, 0, 500) !!} ...</div>
                        
                        
                        <a href="/admin/{{ $result->category }}/{{ $result->date }}/{{ $result->slug }}" class="btn btn-success btn-sm">More</a><hr />
                        @endforeach() 
                        
                        <div class="paginate">{{ $results->links() }}</div>  
                    @endif                                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
