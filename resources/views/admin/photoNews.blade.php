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
                    
                    <form action="{{action('Admin\PhotoNewsAlbumController@store')}}" method="post">
                        <input name="slug" type="hidden" value="">
                        {{ csrf_field() }}
                        <div class="form-group">
                        <div class="col-md-8"><input type="text" required="" class="form-control col-lg-6" name="album_name" id="album_name" placeholder="Enter album name"></div>
                        <input type="submit" name="submit_album" value="Create new album" class="btn btn-primary" />
                        </div>
                    </form><hr />
                    
                    @if($photoNews > 0)
                        <table class="table table-bordered table-condensed table-hover">
                        <tr><th>Album</th></tr>
                        @foreach($results as $result)
                            <tr><td><a href="photonews/{{ $result->id }}">{{ $result->title }}</a></td>
                                <td>{{ Form::open(['method' => 'delete', 'route' => ['photoalbum.destroy', $result->id]])}} {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("Deleting this album will also delete the photos within it. Are you sure you want to delete?")']) }} {{Form::close() }}</td>
                            </tr>
                        @endforeach() 
                        </table>
                        <div class="paginate">{{ $results->links() }}</div>    
                    @endif                                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
