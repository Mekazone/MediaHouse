@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Photo News</div>

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
                    
                    <a href="/admin/photonews/create/{{$id}}" class="btn btn-primary btn-sm">New Photo</a><hr />
                    <h4>{{$albumTitle->title}}</h4>
                    
                    @if(count($results) > 0)
                        <table class="table table-bordered table-condensed table-hover">
                        <tr><th>Date</th><th>Photo</th><th>Edit</th><th>Delete</th></tr>
                        @foreach($results as $result)
                            @php
                                $date = date("Y/m/d", $result->date);
                            @endphp
                            <tr><td>{{ $date }}</td>
                                <td><a href="/{{ $result->name }}">{{ $result->caption }}</a></td>
                                <td><a href="{{ action('Admin\PhotoNewsController@edit', $result->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
                                <td>{{ Form::open(['method' => 'delete', 'route' => ['photonews.destroy', $result->id]])}} {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete?")']) }} {{Form::close() }}</td>
                            </tr>
                        @endforeach() 
                        </table>
                          
                    @endif                                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
